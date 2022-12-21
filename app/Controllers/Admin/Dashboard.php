<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;

class Dashboard extends AdminBaseController
{
	public function __construct()
	{
		$this->data['title'] = 'Sistem Penilaian - Dasbor';
		$this->data['js'] = 'dashboard';
	}

	public function index()
	{
		$this->data['tests'] = $this->testModel->getTests();
		return view('pages/admin/dashboard/view_dashboard', $this->data);
	}

	public function test_call()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getPost('id');
			$testApplicants = $this->testApplicantModel->getAllTestApplicant($id);
			$inActiveCount = 0;
			$activeCount = 0;
			$startCount = 0;
			$finishCount = 0;
			$applicantCount = 0;
			foreach ($testApplicants as $testApplicant) {
				if ($testApplicant['status'] == "Tidak Aktif") {
					$inActiveCount++;
				} else if ($testApplicant['status'] == "Aktif") {
					$activeCount++;
				} else if ($testApplicant['status'] == "Mulai") {
					$startCount++;
				} else if ($testApplicant['status'] == "Selesai") {
					$finishCount++;
				}
				$applicantCount++;
			}

			return json_encode([
				'status_count' => [
					'in_active' => $inActiveCount,
					'active' => $activeCount,
					'start' => $startCount,
					'finish' => $finishCount,
				],
				'applicant_count' => $applicantCount
			]);
		}
	}
	public function pass_test_call()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getPost('id');
			$passTestApplicants = $this->resultModel->getPassTestApplicant($id);
			if ($passTestApplicants) {
				$list = [];
				foreach ($passTestApplicants as $testApplicant) {
					$list[] = '<div class="media mb-4">
					<img alt="image" src="' . base_url('assets/img/avatar/avatar-1.png') . '" class="mr-3 rounded" width="55">
					<div class="media-body">
						<div class="media-title">' . $testApplicant['nama_pelamar'] . '</div>
						<div class="mt-1">
							<div class="text-small float-right font-weight-bold text-muted">' . $testApplicant['nilai_akhir'] . ' / ' . $testApplicant['nilai_maks'] . ' atau ' . $testApplicant['nilai_persentase'] . '</div>
							<div class="font-weight-bold mb-1">Nilai</div>
							<div class="progress" style="height: 3px;">
							<div class="progress-bar" role="progressbar" style="width: ' . $testApplicant['nilai_persentase'] . '%;"></div>
							</div>
					</div>
					</div>
					</div>';
				}
			} else {
				$list = '<p class="text-center">Hasil lulus belum ada</p>';
			}

			return json_encode([
				'list' => $list
			]);
		}
	}
}
