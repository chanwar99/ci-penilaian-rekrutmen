<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminBaseController;


class Result extends AdminBaseController
{
    public function __construct()
    {
        $this->data['title'] = 'Sistem Penilaian - Hasil';
        $this->data['js'] = 'result';
    }

    public function index()
    {
        $this->data['tests'] = $this->testModel->getTests();
        return view('pages/admin/result/view_result', $this->data);
    }

    private function badge($info)
    {
        switch ($info) {
            case 'Lulus':
                return '<div class="badge badge-success">' . $info . '</div>';
                break;
            case 'Tidak Lulus':
                return '<div class="badge badge-danger">' . $info . '</div>';
                break;
        }
    }

    public function call()
    {

        if ($this->request->isAJAX()) {
            $limit = $this->request->getPost('length');
            $offset = $this->request->getPost('start');
            $filter = [
                'filter_test' => $this->request->getPost('filter_test'),
            ];
            $result = $this->resultModel->getAllResult($limit, $offset, $filter);

            $data = [];
            $no = $offset;
            foreach ($result as $result) {
                $row = [];
                $row[] = ++$no;
                $row[] = $result['judul_tes'];
                $row[] = $result['nama_pelamar'];
                $score = $result['nilai_akhir'] . ' / ' . $result['nilai_maks'];
                $row[] = $score . ' atau ' . $result['nilai_persentase'] . '
                <div class="progress" style="height: 20px;">
                    <div class="progress-bar" style="width:' . $result['nilai_persentase'] . '%"></div>
                </div>';
                $row[] = $this->badge($result['keterangan']);
                $data[] = $row;
            }

            $output = array(
                'draw' => $this->request->getPost('draw'),
                'recordsTotal' => $this->resultModel->getResultCount(),
                'recordsFiltered' => $this->resultModel->getResultFilterCount($filter),
                'data' => $data
            );

            return json_encode($output);
        }
    }

    
}
