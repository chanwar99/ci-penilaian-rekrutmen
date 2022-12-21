<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class TestTopicModel extends Model
{
    protected $table         = 'tb_tes_topik';
    protected $primaryKey    = 'id_tes_topik';
    protected $returnType    = 'array';
    protected $allowedFields = ['id_tes', 'id_topik'];

    public function getAllTestTopic($id)
    {
        return $this->orderBy('id_tes_topik', 'ASC')
            ->join('tb_topik', 'tb_topik.id_topik = tb_tes_topik.id_topik')
            ->where('id_tes', $id)
            ->findAll();
    }


    public function getQuestionCount($id)
    {
        $topics = $this->join('tb_topik', 'tb_topik.id_topik = tb_tes_topik.id_topik')
            ->where('id_tes', $id)
            ->findAll();

        $count = 0;
        foreach ($topics as $topic) {
            $count += $topic['jmlh_topik_soal'];
        }
        return $count;
    }

    public function saveTestTopic($id, $data)
    {
        if ($id) {
            $this->where('id_tes', $id)->delete();
        }
        return $this->insertBatch($data);
    }

    public function deleteTestTopic($id)
    {
        return $this->where('id_tes', $id)->delete();
    }

    public function getRandomTestTopics($id)
    {
        return $this->orderBy('id_tes_topik', 'RANDOM')
            ->where('id_tes', $id)
            ->findAll();
    }

    public function topicInTest($id)
    {
        return $this->where('id_topik', $id)->findAll();
    }
}
