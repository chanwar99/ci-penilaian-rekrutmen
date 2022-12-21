<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;

class Applicant extends AdminBaseController
{
	public function __construct()
	{
		$this->data['title'] = 'Sistem Penilaian - Kelola Pelamar';
		$this->data['js'] = 'applicant';
	}

	public function index()
	{
		return view('pages/admin/applicant/view_applicant', $this->data);
	}

	public function call()
	{
		if ($this->request->isAJAX()) {
			$limit = $this->request->getPost('length');
			$offset = $this->request->getPost('start');
			$filter = [
				'filter_applicant_name' => $this->request->getPost('filter_applicant_name')
			];
			$applicant = $this->applicantModel->getAllApplicant($limit, $offset, $filter);

			// echo '<pre>' . var_export($applicant, true) . '</pre>';
			$data = [];
			$no = $offset;
			foreach ($applicant as $applicant) {
				$row = [];
				$row[] = ++$no;
				$row[] = $applicant['nama_pelamar'] . '
				<div class="table-links">
					<a href="#" data-toggle="modal" data-target="#applicantModal" data-backdrop="static" data-modal-type="edit" data-id="' . $applicant['id_pelamar'] . '">Edit</a>
					<div class="bullet"></div>
					<a href="#" class="text-danger" data-toggle="modal" data-target="#applicantModal" data-backdrop="static" data-modal-type="delete" data-id="' . $applicant['id_pelamar'] . '">Hapus</a>
			  	</div>';
				$row[] = $applicant['jenis_kelamin'];
				$row[] = $applicant['tempat_lahir'] . ', ' . date('d-m-Y', strtotime($applicant['tanggal_lahir']));
				$row[] = $applicant['alamat_email'];
				$data[] = $row;
			}

			$output = array(
				'draw' => $this->request->getPost('draw'),
				'recordsTotal' => $this->applicantModel->getApplicantCount(),
				'recordsFiltered' => $this->applicantModel->getApplicantFilterCount($filter),
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
					$value = $this->applicantModel->getSingleApplicant($id);
					$title = 'Edit Data Pelamar';
					$html = view('pages/admin/applicant/view_applicant_form');
					break;
				case 'add':
					$value = '';
					$title = 'Tambah Data Pelamar';
					$html = view('pages/admin/applicant/view_applicant_form');
					break;
				case 'delete':
					$value = '';
					$title = 'Hapus Data Pelamar';
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
			//cek email
			$email_count = $this->applicantModel->getApplicantEmailCount($post['email']);
			if ($email_count > 0) {
				$single = $this->applicantModel->getSingleApplicant($post['applicant_id']);
				if ($single['alamat_email'] == $post['email']) {
					$save = true;
				} else {
					$save = false;
				}
			} else {
				$save = true;
			}

			$applicant = [
				'id_pelamar' => $post['applicant_id'],
				'nama_pelamar' => $post['applicant_name'],
				'jenis_kelamin' => $post['gender'],
				'tempat_lahir' => $post['place_birth'],
				'tanggal_lahir' => $post['date_birth'],
				'alamat_email' => $post['email']
			];

			if ($save) {
				$save = $this->applicantModel->saveApplicant($applicant);
				$message = 'Data berhasil disimpan';
			} else {
				$message = 'Email sudah terdaftar!';
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
			$applicantInTest = $this->testApplicantModel->applicantInTest($id);

			if($applicantInTest){
				$delete = false;
				$message = 'Data gagal dihapus! Pelamar ini berada dalam tes';
			} else {
				$delete = $this->applicantModel->deleteApplicant($id);
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
