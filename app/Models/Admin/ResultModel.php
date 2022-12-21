<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ResultModel extends Model
{
    protected $table         = 'tb_hasil';
    protected $primaryKey    = 'id_hasil';
    protected $returnType    = 'array';
    protected $allowedFields = ['id_tes_pelamar', 'nilai_akhir', 'nilai_maks', 'nilai_persentase', 'keterangan'];

    public function getResultFilter($filter)
    {

        if ($filter['filter_test']) {
            $this->where('tb_tes.id_tes', $filter['filter_test']);
        }
    }

    public function getAllResult($limit, $offset, $filter)
    {
        $this->getResultFilter($filter);
        return $this->orderBy('id_hasil', 'DESC')
            ->join('tb_tes_pelamar', 'tb_tes_pelamar.id_tes_pelamar = tb_hasil.id_tes_pelamar')
            ->join('tb_tes', 'tb_tes.id_tes = tb_tes_pelamar.id_tes')
            ->join('tb_pelamar', 'tb_pelamar.id_pelamar = tb_tes_pelamar.id_pelamar')
            ->findAll($limit, $offset);
    }


    public function getResultCount()
    {
        return count($this->findAll());
    }

    public function getResultFilterCount($filter)
    {
        $this->getResultFilter($filter);
        return count($this->join('tb_tes_pelamar', 'tb_tes_pelamar.id_tes_pelamar = tb_hasil.id_tes_pelamar')
            ->join('tb_tes', 'tb_tes.id_tes = tb_tes_pelamar.id_tes')
            ->join('tb_pelamar', 'tb_pelamar.id_pelamar = tb_tes_pelamar.id_pelamar')
            ->findAll());
    }

    public function saveResult($data)
    {
        return $this->insert($data);
    }

    public function getSingleResultApplicant($id)
    {
        return $this->where('id_tes_pelamar', $id)->first();
    }

    public function getPassTestApplicant($id)
    {
        return $this->orderBy('nilai_persentase', 'DESC')
            ->join('tb_tes_pelamar', 'tb_tes_pelamar.id_tes_pelamar = tb_hasil.id_tes_pelamar')
            ->join('tb_tes', 'tb_tes.id_tes = tb_tes_pelamar.id_tes')
            ->join('tb_pelamar', 'tb_pelamar.id_pelamar = tb_tes_pelamar.id_pelamar')
            ->where('tb_tes.id_tes', $id)
            ->where('keterangan', 'Lulus')
            ->findAll();
    }
}
