<?php

namespace App\Controllers\Test;

use App\Controllers\Test\TestBaseController;


class TestStart extends TestBaseController
{
    public function __construct()
    {
        $this->data['title'] = 'Sistem Penilaian - Tes';
		$this->data['js'] = 'test_start';
    }

    public function index()
    {
        $topics = $this->testTopicModel->getRandomTestTopics($this->data['userApplicant']['id_tes']);
        $arr = [];
        foreach ($topics as $topic) {
            $questions = $this->questionModel->getRandomQuestions($topic['id_topik']);
            $arr[] = $questions;
        }

        $this->data['testTopics'] = $arr;

        $singleTest = $this->data['singleTest'];
        $this->data['testDuration'] = strtotime($singleTest['durasi_tes']) - strtotime('TODAY');
        return view('pages/test/view_test_start', $this->data);
    }

    public function rate()
    {
        if ($this->request->isAJAX()) {
            $testApplicant = $this->data['userApplicant'];
            $test = $this->data['singleTest'];
            $userChoices = $this->request->getPost('user_choice');
            $questionId = $this->request->getPost('question_id');

            $finalScore = 0;
            $maxScore = 0;

            for ($i = 0; $i < count($questionId); $i++) {
                $question = $this->questionModel->getSingleQuestion($questionId[$i]);
                $maxScore += $question['poin'];
                if ($userChoices[$i] == $question['kun_jaw']) {
                    $finalScore += $question['poin'];
                }
            }

            $percentageScore = floatval(round(($finalScore / $maxScore) * 100, 2));
            if ($percentageScore >= $test['nilai_min_lulus']) {
                $info = 'Lulus';
            } else {
                $info = 'Tidak Lulus';
            }

            $data = [
                'id_tes_pelamar' => $testApplicant['id_tes_pelamar'],
                'nilai_akhir' => $finalScore,
                'nilai_maks' => $maxScore,
                'nilai_persentase' => $percentageScore,
                'keterangan' => $info
            ];

            if ($save = $this->resultModel->saveResult($data)) {
                $this->testApplicantModel->updateTestApplicantStatus($this->data['userApplicant']['id_tes_pelamar'], [
                    'status' => 'Selesai'
                ]);
                session()->remove('test_start');
            }

            return json_encode([
                'success' => $save,
                'url' => site_url('tes/hasil')
            ]);
        }
    }
}
