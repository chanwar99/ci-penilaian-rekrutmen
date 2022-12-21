<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class TestApplicantModel extends Model
{
    protected $table         = 'tb_tes_pelamar';
    protected $primaryKey    = 'id_tes_pelamar';
    protected $returnType    = 'array';
    protected $allowedFields = ['id_tes', 'id_pelamar', 'kode_tes', 'status'];

    public function getAllTestApplicant($id)
    {
        return $this->orderBy('id_tes_pelamar', 'ASC')
            ->join('tb_pelamar', 'tb_pelamar.id_pelamar = tb_tes_pelamar.id_pelamar')
            ->where('id_tes', $id)
            ->findAll();
    }

    // public function applicantInTest()
    // {
    //     $arr = [];
    //     foreach ($this->findAll() as $applicant) {
    //         $arr[] = $applicant['id_pelamar'];
    //     }
    //     return $arr;
    // }

    public function saveTestApplicant($id, $data)
    {
        if ($id) {
            $this->where('id_tes', $id)->delete();
        }
        return $this->insertBatch($data);
    }

    public function deleteTestApplicant($id)
    {
        return $this->where('id_tes', $id)->delete();
    }

    public function allInactiveStatusCount($id)
    {
        $statusCount = count($this->where('id_tes', $id)->findAll());
        $inActiveCount = count($this->where([
            'status' => 'Tidak Aktif',
            'id_tes' => $id
        ])->findAll());

        return $statusCount == $inActiveCount;
    }

    // public function allFinishStatusCount($id)
    // {
    //     $statusCount = count($this->where('id_tes', $id)->findAll());
    //     $finishCount = count($this->where([
    //         'status' => 'Selesai',
    //         'id_tes' => $id
    //     ])->findAll());

    //     return $statusCount == $finishCount;
    // }

    public function updateTestApplicantStatus($id, $data)
    {
        return $this->update($id, $data);
    }

    public function getSingleTestApplicant($test_code)
    {
        return $this->join('tb_pelamar', 'tb_pelamar.id_pelamar = tb_tes_pelamar.id_pelamar')
            ->where('kode_tes', $test_code)
            ->first();
    }

    public function getTestCode($testId, $applicantId)
    {
        return $this->where('id_tes', $testId)
            ->where('id_pelamar', $applicantId)
            ->first()['kode_tes'];
    }

    public function applicantInTest($id)
    {
        return $this->where('id_pelamar', $id)->findAll();
    }
}
