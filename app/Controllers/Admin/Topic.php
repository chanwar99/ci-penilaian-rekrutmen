<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;

class Topic extends AdminBaseController
{
	public function __construct()
	{
		$this->data['title'] = 'Sistem Penilaian - Kelola Topik';
		$this->data['js'] = 'topic';
	}

	public function index()
	{

		return view('pages/admin/topic/view_topic', $this->data);
	}

	public function call()
	{
		if ($this->request->isAJAX()) {
			$limit = $this->request->getPost('length');
			$offset = $this->request->getPost('start');
			$filter = [
				'filter_topic_title' => $this->request->getPost('filter_topic_title'),
			];
			$topic = $this->topicModel->getAllTopic($limit, $offset, $filter);

			$data = [];
			$no = $offset;
			foreach ($topic as $topic) {
				$row = [];
				$row[] = ++$no;
				$row[] = $topic['judul_topik'] . '
				<div class="table-links">
					<a href="#" data-toggle="modal" data-target="#topicModal" data-backdrop="static" data-modal-type="edit" data-id="' . $topic['id_topik'] . '">Edit</a>
					<div class="bullet"></div>
					<a href="#" class="text-danger" data-toggle="modal" data-target="#topicModal" data-backdrop="static" data-modal-type="delete" data-id="' . $topic['id_topik'] . '">Hapus</a>
			  	</div>';
				$row[] = $topic['jmlh_topik_soal'] ? $topic['jmlh_topik_soal'] : 'Belum ada soal';
				$data[] = $row;
			}

			$output = array(
				'draw' => $this->request->getPost('draw'),
				'recordsTotal' => $this->topicModel->getTopicCount(),
				'recordsFiltered' => $this->topicModel->getTopicFilterCount($filter),
				'data' => $data
			);

			return json_encode($output);
		}
	}

	public function modal()
	{
		if ($this->request->isAJAX()) {
			$modalType = $this->request->getPost('modal_type');
			switch ($modalType) {
				case 'edit':
					$id = $this->request->getPost('id');
					$value = $this->topicModel->getSingleTopic($id);
					$title = 'Edit Data Topik';
					$html = view('pages/admin/topic/view_topic_form');
					break;
				case 'add':
					$value = '';
					$title = 'Tambah Data Topik';
					$html = view('pages/admin/topic/view_topic_form');
					break;
				case 'delete':
					$value = '';
					$title = 'Hapus Data Topik';
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

			$topic = [
				'id_topik' => $post['topic_id'],
				'judul_topik' => $post['topic_title'],
			];

			$output = [
				'save' => $this->topicModel->saveTopic($topic),
				'message' => 'Data berhasil disimpan'
			];
			return json_encode($output);
		}
	}

	public function delete()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getPost('id');

			$question_count = $this->topicModel->getSingleTopic($id)['jmlh_topik_soal'];
			$topicInTest = $this->testTopicModel->topicInTest($id);

			if ($topicInTest) {
				$delete = false;
				$message = 'Data gagal dihapus! Topik ini digunakan dalam tes';
			} else {
				if ($question_count == 0) {
					$delete = $this->topicModel->deleteTopic($id);
					$message = 'Data berhasil dihapus';
				} else {
					$delete = false;
					$message = 'Data gagal dihapus! Topik ini memiliki soal';
				}
				
			}

			$output = [
				'delete' => $delete,
				'message' => $message
			];

			return json_encode($output);
		}
	}
}
