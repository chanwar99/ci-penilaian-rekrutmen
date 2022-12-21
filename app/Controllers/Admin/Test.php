<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;

class Test extends AdminBaseController
{
    public function __construct()
    {

        $this->data['title'] = 'Sistem Penilaian - Kelola Tes';
        $this->data['js'] = 'test';
    }

    public function index()
    {
        return view('pages/admin/test/view_test', $this->data);
    }

    public function call()
    {
        if ($this->request->isAJAX()) {
            $limit = $this->request->getPost('length');
            $offset = $this->request->getPost('start');
            $filter = [
                'filter_test_title' => $this->request->getPost('filter_test_title'),
            ];
            $test = $this->testModel->getAllTest($limit, $offset, $filter);

            $data = [];
            $no = $offset;
            foreach ($test as $test) {
                $row = [];
                $row[] = ++$no;
                $button = $this->testApplicantModel->allInactiveStatusCount($test['id_tes']) ? '
                <div class="table-links">
                    <a href="#" data-toggle="modal" data-target="#testModal" data-backdrop="static" data-modal-type="edit" data-id="' . $test['id_tes'] . '">Edit</a>
                    <div class="bullet"></div>
                    <a href="#" class="text-danger" data-toggle="modal" data-target="#testModal" data-backdrop="static" data-modal-type="delete" data-id="' . $test['id_tes'] . '">Hapus</a>
                </div>' : '';
                $row[] = $test['judul_tes'] . $button;
                $row[] = '<p class="mb-0" style="white-space: pre-wrap;">' . $test['deskripsi_tes'] . '</p>';
                $row[] = '<a href="#" data-toggle="modal" data-target="#testModal" data-backdrop="static" data-modal-type="details" data-id="' . $test['id_tes'] . '" data-details="applicant">Lihat Data</a>';
                $row[] = '<a href="#" data-toggle="modal" data-target="#testModal" data-backdrop="static" data-modal-type="details" data-id="' . $test['id_tes'] . '" data-details="topic">Lihat Data</a>';
                $row[] = $test['nilai_min_lulus'];
                $row[] = $test['durasi_tes'];
                $data[] = $row;
            }

            $output = array(
                'draw' => $this->request->getPost('draw'),
                'recordsTotal' => $this->testModel->getTestCount(),
                'recordsFiltered' => $this->testModel->getTestFilterCount($filter),
                'data' => $data
            );

            return json_encode($output);
        }
    }

    public function modal()
    {
        if ($this->request->isAJAX()) {
            $modalType = $this->request->getPost('modal_type');
            $this->data['applicants'] = $this->applicantModel->getApplicants();
            $this->data['topics'] = $this->topicModel->getTopics();
            switch ($modalType) {
                case 'edit':
                    $id = $this->request->getPost('id');
                    $value = $this->testModel->getSingleTest($id);
                    $title = 'Edit Data Tes';
                    $html = view('pages/admin/test/view_test_form', $this->data);
                    break;
                case 'add':
                    $value = '';
                    $title = 'Tambah Data Tes';
                    $html = view('pages/admin/test/view_test_form', $this->data);
                    break;
                case 'delete':
                    $value = '';
                    $title = 'Hapus Data Tes';
                    $html = '
					<div class="form-group">
					Yakin untuk menghapus data ini ? 
					</div>
					<div class="form-group text-right">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
					<button type="button" class="btn btn-danger btnDelete">Ya</button>
					</div>';
                    break;
                case 'details':
                    $value = '';
                    $id = $this->request->getPost('id');
                    $data['testClass'] = $this;
                    $data['details'] = $this->request->getPost('details');
                    $data['testApplicant'] = $this->testApplicantModel->getAllTestApplicant($id);
                    $data['testTopic'] = $this->testTopicModel->getAllTestTopic($id);
                    $data['questionCount'] = $this->testTopicModel->getQuestionCount($id);
                    $title = $data['details'] == 'applicant' ? 'Daftar Pelamar' : 'Topik Tes';
                    $html = view('pages/admin/test/view_test_details', $data);
                    break;
            }

            $output = [
                'title' => $title,
                'html' => $html,
                'value' => $value,
                'disabled' => [
                    // 'applicants' => $this->testApplicantModel->applicantInTest(),
                    'topics' => $this->topicModel->topicWithoutQuestions()
                ]
            ];

            return json_encode($output);
        }
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $post = $this->request->getPost();

            $test = [
                'id_tes' => $post['test_id'],
                'judul_tes' => $post['test_title'],
                'deskripsi_tes' => $post['test_desc'],
                'nilai_min_lulus' => $post['min_pass_grade'],
                'durasi_tes' => $post['test_duration'],
            ];

            if ($save = $this->testModel->saveTest($test)) {
                $testId = $post['test_id'] ? $post['test_id'] : $this->testModel->getInsertID();
                $applicants = [];
                for ($i = 0; $i < count($post['applicants']); $i++) {
                    $testCode = $this->testApplicantModel->getTestCode($testId, $post['applicants'][$i]);
                    $applicants[] = [
                        'id_tes' => $testId,
                        'id_pelamar' => $post['applicants'][$i],
                        'kode_tes' => $testCode ? $testCode : random_string('alnum', 8),
                        'status' => 'Tidak Aktif'
                    ];
                }
                $this->testApplicantModel->saveTestApplicant($post['test_id'], $applicants);

                $topics = [];
                for ($i = 0; $i < count($post['topics']); $i++) {
                    $topics[] = [
                        'id_tes' => $testId,
                        'id_topik' => $post['topics'][$i],
                    ];
                }
                $this->testTopicModel->saveTestTopic($post['test_id'], $topics);
                $message = 'Data berhasil disimpan';
            }

            $output = [
                'save' => $save,
                'message' => $message
            ];
            return json_encode($output);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id');

            $this->testApplicantModel->deleteTestApplicant($id);
            $this->testTopicModel->deleteTestTopic($id);

            $output = [
                'delete' => $this->testModel->deleteTest($id),
                'message' => 'Data berhasil dihapus'
            ];
            return json_encode($output);
        }
    }

    public function badge($status)
    {
        switch ($status) {
            case 'Tidak Aktif':
                return '<div class="badge badge-secondary">' . $status . '</div>';
                break;
            case 'Aktif':
                return '<div class="badge badge-primary">' . $status . '</div>';
                break;
            case 'Mulai':
                return '<div class="badge badge-warning">' . $status . '</div>';
                break;
            case 'Selesai':
                return '<div class="badge badge-success">' . $status . '</div>';
                break;
        }
    }
}
