<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class TestStart implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Do something here
        if (session()->get('test_logged_in') && !session()->get('test_start')) {
            // throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            return redirect()->route('tes/detail');
        } else if (!session()->get('test_logged_in')) {
            return redirect()->route('tes/login');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
