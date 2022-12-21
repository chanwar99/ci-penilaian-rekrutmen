<?php

namespace App\Controllers\Auth;

use CodeIgniter\Controller;
use App\Models\Admin\TestApplicantModel;

class TestLogin extends Controller
{
	private $data;
	private $testApplicantModel;

	public function __construct()
	{
		$this->testApplicantModel = new TestApplicantModel();

		$this->data['title'] = 'Sistem Penilaian - Login Tes';
		$this->data['js'] = 'test_login';
	}

	public function index()
	{
		if (session()->get('test_logged_in')) {
			$this->data['message'] = 'Anda sudah masuk pada tes <strong>' . session()->get('test_code') . '</strong>, untuk mengganti ke tes lain harap <strong class="text-primary">keluar</strong> terlebih dahulu.';
			$this->data['urlLogout'] = site_url('tes/login/keluar');
			$this->data['urlBack'] = site_url('tes/detail');
			return view('pages/auth/view_logged_in_info', $this->data);
		}

		return view('pages/auth/test_login/view_test_login', $this->data);
	}

	public function process()
	{
		if ($this->request->isAJAX()) {
			$testCode = $this->request->getPost('test_code');
			$userApplicant = $this->testApplicantModel->getSingleTestApplicant($testCode);
			if ($userApplicant) {
				$sess = [
					'test_code' => $userApplicant['kode_tes'],
					'test_logged_in' => true,
					// 'test_sess_msg' => 'Selamat datang di Halaman Tes Penilaian Rekrutmen'
				];
				session()->set($sess);
				// session()->markAsFlashdata('test_sess_msg');
				if ($userApplicant['status'] == 'Tidak Aktif') {
					$this->testApplicantModel->updateTestApplicantStatus($userApplicant['id_tes_pelamar'], [
						'status' => 'Aktif'
					]);
				}
				return json_encode([
					'success' => true,
					'url' => site_url('tes/detail')
				]);
			} else {
				return json_encode([
					'success' => false,
					'message' => 'Kode Tes salah'
				]);
			}
		}
	}

	public function logout()
	{
		// if (session()->get('logged_in')) {
		$sess = ['test_code', 'test_logged_in',  'test_start'];
		session()->remove($sess);
		return redirect()->route('tes/login');
		// }
	}
}
