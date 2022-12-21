<?php

namespace App\Controllers\Test;

use App\Controllers\Test\TestBaseController;

class TestResult extends TestBaseController
{
    public function __construct()
    {
        $this->data['title'] = 'Sistem Penilaian - Hasil Tes';
        $this->data['js'] = '';
    }

    public function index()
    {
        $this->data['singleResultApplicant'] = $this->resultModel->getSingleResultApplicant($this->data['userApplicant']['id_tes_pelamar']);
        return view('pages/test/view_test_result', $this->data);
    }

}
