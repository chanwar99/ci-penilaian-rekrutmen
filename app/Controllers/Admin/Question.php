<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;

class Question extends AdminBaseController
{
    public function __construct()
    {
        $this->data['title'] = 'Sistem Penilaian - Kelola Soal';
        $this->data['js'] = 'question';
    }

    public function index()
    {
        $this->data['topics'] = $this->topicModel->getTopics();
        return view('pages/admin/question/view_question', $this->data);
    }

    public function call()
    {
        if ($this->request->isAJAX()) {
            $limit = $this->request->getPost('length');
            $offset = $this->request->getPost('start');
            $filter = [
                'filter_topic' => $this->request->getPost('filter_topic'),
            ];
            $question = $this->questionModel->getAllquestion($limit, $offset, $filter);

            $data = [];
            $no = $offset;
            foreach ($question as $question) {
                $row = [];
                $row[] = ++$no;
                $row[] = $question['judul_topik'] . '
				<div class="table-links">
					<a href="#" data-toggle="modal" data-target="#questionModal" data-backdrop="static" data-modal-type="edit" data-id="' . $question['id_soal'] . '">Edit</a>
					<div class="bullet"></div>
					<a href="#" class="text-danger" data-toggle="modal" data-target="#questionModal" data-backdrop="static" data-modal-type="delete" data-id="' . $question['id_soal'] . '">Hapus</a>
			  	</div>';
                $row[] = '<p class="mb-0" style="white-space: pre-wrap;">' . esc($question['teks_soal']) . '</p>';
                $html = '<ul>';
                for ($i = 1; $i <= 4; $i++) {
                    $pil = 'pil_' . $i;
                    $html .= '<li class="' . ($pil == $question['kun_jaw'] ? 'text-success font-weight-bold' : '') . '">' . esc($question[$pil]) . '</li>';
                }
                $html .= '</ul>';
                $row[] = $html;
                $row[] = $question['poin'];
                $data[] = $row;
            }

            $output = array(
                'draw' => $this->request->getPost('draw'),
                'recordsTotal' => $this->questionModel->getquestionCount(),
                'recordsFiltered' => $this->questionModel->getquestionFilterCount($filter),
                'data' => $data
            );

            return json_encode($output);
        }
    }

    public function modal()
    {
        if ($this->request->isAJAX()) {
            $modalType = $this->request->getPost('modal_type');
            $this->data['topics'] = $this->topicModel->getTopics();
            switch ($modalType) {
                case 'edit':
                    $id = $this->request->getPost('id');
                    $value = $this->questionModel->getSingleQuestion($id);
                    $title = 'Edit Data Soal';
                    $html = view('pages/admin/question/view_question_form', $this->data);
                    break;
                case 'add':
                    $value = '';
                    $title = 'Tambah Data Soal';
                    $html = view('pages/admin/question/view_question_form', $this->data);
                    break;
                case 'delete':
                    $value = '';
                    $title = 'Hapus Data Soal';
                    $html = '
					<div class="form-group">
					Yakin untuk menghapus data ini ? 
					</div>
					<div class="form-group text-right">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
					<button type="button" class="btn btn-danger btnDelete">Ya</button>
					</div>';
                    break;
            }

            $output = [
                'title' => $title,
                'html' => $html,
                'value' => $value
            ];

            return json_encode($output);
        }
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $post = $this->request->getPost();

            $question = [
                'id_soal' => $post['question_id'],
                'id_topik' => $post['topic'],
                'teks_soal' => $post['question_text'],
                'pil_1' => $post['choice_1'],
                'pil_2' => $post['choice_2'],
                'pil_3' => $post['choice_3'],
                'pil_4' => $post['choice_4'],
                'kun_jaw' => $post['answer'],
                'poin' => $post['points'],
            ];

            if ($save = $this->questionModel->saveQuestion($question)) {
                $topic = $this->questionModel->generateTopicsValue($post['topic']);
                $this->topicModel->updateTopicQuestion($post['topic'], [
                    'jmlh_topik_soal' => $topic['question_count'],
                ]);

                if ($post['question_id'] && $post['topic'] != $post['topic_old']) {
                    $topic_old = $this->questionModel->generateTopicsValue($post['topic_old']);
                    $this->topicModel->updateTopicQuestion($post['topic_old'], [
                        'jmlh_topik_soal' => $topic_old['question_count'],
                    ]);
                }
            }

            $output = [
                'save' => $save,
                'message' => 'Data berhasil disimpan'
            ];
            return json_encode($output);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');
            $topic_id = $this->questionModel->getSingleQuestion($id)['id_topik'];
            $topicInTest = $this->testTopicModel->topicInTest($topic_id);

            if ($topicInTest) {
                $delete = false;
                $message = 'Data gagal dihapus! Soal ini digunakan dalam tes';
            } else {
                if ($delete = $this->questionModel->deleteQuestion($id)) {
                    $topics = $this->questionModel->generateTopicsValue($topic_id);
                    $this->topicModel->updateTopicQuestion($topic_id, [
                        'jmlh_topik_soal' => $topics['question_count'],
                    ]);
                }
                $message = 'Data berhasil dihapus';
            }

            $output = [
                'delete' => $delete,
                'message' => $message
            ];
            return json_encode($output);
        }
    }
}
