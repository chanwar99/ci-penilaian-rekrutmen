<?php

namespace App\Controllers\Test;

use App\Controllers\Test\TestBaseController;
use App\Models\Admin\TestModel;
use App\Models\Admin\TestApplicantModel;
use App\Models\Admin\TestTopicModel;
use App\Models\Admin\ApplicantModel;
use App\Models\Admin\TopicModel;

class TestDetails extends TestBaseController
{
    public function __construct()
    {
        $this->data['title'] = 'Sistem Penilaian - Detail Tes';
        $this->data['js'] = 'test_details';
    }

    public function index()
    {
        $this->data['topics'] = $this->testTopicModel->getAllTestTopic($this->data['userApplicant']['id_tes']);
        $this->data['questionCount'] = $this->testTopicModel->getQuestionCount($this->data['userApplicant']['id_tes']);
        return view('pages/test/view_test_details', $this->data);
    }

    public function start()
    {
        session()->set([
            'test_start' => 1
        ]);

        $this->testApplicantModel->updateTestApplicantStatus($this->data['userApplicant']['id_tes_pelamar'], [
            'status' => 'Mulai'
        ]);

        return redirect()->route('tes');
    }
}
