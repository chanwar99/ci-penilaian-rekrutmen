<?php

namespace App\Controllers\Auth;

use CodeIgniter\Controller;
use App\Models\Auth\LoginModel;

class Login extends Controller
{

	private $data;
	private $loginModel;

	public function __construct()
	{
		$this->loginModel = new LoginModel();

		$this->data['title'] = 'Sistem Penilaian - Login';
		$this->data['js'] = 'login';
	}

	public function index()
	{

		if (session()->get('logged_in')) {
			$this->data['message'] = 'Anda sudah login sebagai <strong>'.session()->get('username').'</strong>, untuk login kembali harap <strong class="text-primary">keluar</strong> akun terlebih dahulu.';
			$this->data['urlLogout'] = site_url('login/keluar');
			$this->data['urlBack'] = site_url();
			return view('pages/auth/view_logged_in_info', $this->data);
		}

		return view('pages/auth/login/view_login', $this->data);
	}

	public function process()
	{
		if ($this->request->isAJAX()) {
			$emailOrUsername = $this->request->getPost('email_or_username');
			$password = $this->request->getPost('password');
			$user = $this->loginModel->getSingleUser($emailOrUsername);
			if ($user) {
				if ($password == $user['kata_sandi']) {
					$sess = [
						'username' => $user['nama_user'],
						'password' => $user['kata_sandi'],
						'logged_in' => true,
						'sess_msg' => 'Selamat datang di sistem alpikasi penilaian rekrutmen'
					];
					session()->set($sess);
					session()->markAsFlashdata('sess_msg');
					return json_encode([
						'success' => true,
						'url' => site_url()
					]);
				} else {
					return json_encode([
						'success' => false,
						'message' => 'Kata Sandi salah'
					]);
				}
			} else {
				return json_encode([
					'success' => false,
					'message' => 'Email atau Nama User salah'
				]);
			}
		}
	}

	public function logout()
	{
		// if (session()->get('logged_in')) {
		$sess = ['username', 'password', 'logged_in'];
		session()->remove($sess);
		return redirect()->route('login');
		// }
	}
}
