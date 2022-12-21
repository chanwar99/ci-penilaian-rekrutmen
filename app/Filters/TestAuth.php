<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\Admin\TestApplicantModel;

class TestAuth implements FilterInterface
{
    private $testApplicantModel;

    public function before(RequestInterface $request, $arguments = null)
    {
        $this->testApplicantModel = new TestApplicantModel();
        // Do something here
        if (session()->get('test_logged_in') && session()->get('test_code')) {
            $userApplicant = $this->testApplicantModel->getSingleTestApplicant(session()->get('test_code'));
            if (!$userApplicant) {
                return redirect()->route('tes/login/keluar');
            }
        } else {
            return redirect()->route('tes/login');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
