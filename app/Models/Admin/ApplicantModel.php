<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class ApplicantModel extends Model
{
    protected $table         = 'tb_pelamar';
    protected $primaryKey    = 'id_pelamar';
    protected $returnType    = 'array';
    protected $allowedFields = ['id_pelamar', 'nama_pelamar', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat_email'];

    public function getApplicantFilter($filter)
    {

        if ($filter['filter_applicant_name']) {
            $this->like('nama_pelamar', $filter['filter_applicant_name']);
        }
    }

    public function getAllApplicant($limit, $offset, $filter)
    {
        $this->getApplicantFilter($filter);
        return $this->orderBy('id_pelamar', 'DESC')->findAll($limit, $offset);
    }

    public function getApplicantCount()
    {
        return count($this->findAll());
    }

    public function getApplicantFilterCount($filter)
    {
        $this->getApplicantFilter($filter);
        return count($this->findAll());
    }

    public function saveApplicant($data)
    {
        return $this->save($data);
    }

    public function deleteApplicant($id)
    {
        return $this->delete($id);
    }

    public function getSingleApplicant($id)
    {
        return $this->find($id);
    }

    public function getApplicantEmailCount($email)
    {
        return count($this->where('alamat_email', $email)->findAll());
    }

    public function getApplicants()
    {
        return $this->findAll();
    }
}
