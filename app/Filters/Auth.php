<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\Auth\LoginModel;

class Auth implements FilterInterface
{
    private $loginModel;

    public function before(RequestInterface $request, $arguments = null)
    {
        $this->loginModel = new LoginModel();
        // Do something here
        if (!session()->get('logged_in')) {
            return redirect()->route('login');
        }

        // Do something here
        if (session()->get('logged_in') && session()->get('username') && session()->get('password')) {
            $user = $this->loginModel->getSingleUser(session()->get('username'));
            if ($user) {
                if (session()->get('password') != $user['kata_sandi']) {
                    return redirect()->route('login/keluar');
                }
            } else {
                return redirect()->route('login/keluar');
            }
        } else {
            return redirect()->route('login');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
