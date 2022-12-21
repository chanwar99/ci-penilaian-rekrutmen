<?php

namespace App\Models\Admin;

use CodeIgniter\Model;
use phpDocumentor\Reflection\Types\Null_;

class TopicModel extends Model
{
    protected $table         = 'tb_topik';
    protected $primaryKey    = 'id_topik';
    protected $returnType    = 'array';
    protected $allowedFields = ['id_topik', 'judul_topik', 'deskripsi_topik', 'jmlh_topik_soal'];

    public function getTopicFilter($filter)
    {

        if ($filter['filter_topic_title']) {
            $this->like('judul_topik', $filter['filter_topic_title']);
        }
    }

    public function getAllTopic($limit, $offset, $filter)
    {
        $this->getTopicFilter($filter);
        return $this->orderBy('id_topik', 'DESC')->findAll($limit, $offset);
    }


    public function getTopicCount()
    {
        return count($this->findAll());
    }

    public function getTopicFilterCount($filter)
    {
        $this->getTopicFilter($filter);
        return count($this->findAll());
    }

    public function saveTopic($data)
    {
        return $this->save($data);
    }

    public function deleteTopic($id)
    {
        return $this->delete($id);
    }

    public function getSingleTopic($id)
    {
        return $this->find($id);
    }

    public function getTopics()
    {
        return $this->findAll();
    }

    public function updateTopicQuestion($id, $data)
    {
        return $this->update($id, $data);
    }

    public function topicWithoutQuestions()
    {
        $arr = [];
        foreach ($this->where('jmlh_topik_soal', NULL)->findAll() as $topic) {
            $arr[] = $topic['id_topik'];
        }
        return $arr;
    }
}
