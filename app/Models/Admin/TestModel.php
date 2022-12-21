<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class TestModel extends Model
{
    protected $table         = 'tb_tes';
    protected $primaryKey    = 'id_tes';
    protected $returnType    = 'array';
    protected $allowedFields = ['id_tes', 'judul_tes', 'deskripsi_tes', 'nilai_min_lulus', 'durasi_tes'];

    public function getTestFilter($filter)
    {

        if ($filter['filter_test_title']) {
            $this->like('judul_tes', $filter['filter_test_title']);
        }
    }

    public function getAllTest($limit, $offset, $filter)
    {
        $this->getTestFilter($filter);
        return $this->orderBy('id_tes', 'DESC')->findAll($limit, $offset);
    }


    public function getTestCount()
    {
        return count($this->findAll());
    }

    public function getTestFilterCount($filter)
    {
        $this->getTestFilter($filter);
        return count($this->findAll());
    }

    public function saveTest($data)
    {
        return $this->save($data);
    }

    public function deleteTest($id)
    {
        return $this->delete($id);
    }

    public function getSingleTest($id)
    {
        return $this
            ->join('tb_tes_pelamar', 'tb_tes_pelamar.id_tes = tb_tes.id_tes')
            ->join('tb_tes_topik', 'tb_tes_topik.id_tes = tb_tes.id_tes')
            ->select('tb_tes.*, GROUP_CONCAT(DISTINCT tb_tes_pelamar.id_pelamar) as id_pelamar, GROUP_CONCAT(DISTINCT tb_tes_topik.id_topik) as id_topik')
            ->groupBy('tb_tes.id_tes')
            ->find($id);
    }

    public function getTests()
    {
        return $this->findAll();
    }

    public function updateTestQuestion($id, $data)
    {
        return $this->update($id, $data);
    }
}
