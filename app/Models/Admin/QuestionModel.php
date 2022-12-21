<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class QuestionModel extends Model
{
    protected $table         = 'tb_soal';
    protected $primaryKey    = 'id_soal';
    protected $returnType    = 'array';
    protected $allowedFields = ['id_soal', 'id_topik', 'teks_soal', 'pil_1', 'pil_2', 'pil_3', 'pil_4', 'kun_jaw', 'poin'];

    public function getQuestionFilter($filter)
    {

        if ($filter['filter_topic']) {
            $this->where('tb_soal.id_topik', $filter['filter_topic']);
        }
    }

    public function getAllQuestion($limit, $offset, $filter)
    {
        $this->getQuestionFilter($filter);
        return $this->orderBy('id_soal', 'DESC')
            ->join('tb_topik', 'tb_topik.id_topik = tb_soal.id_topik')
            ->findAll($limit, $offset);
    }

    public function getQuestionCount()
    {
        return count($this->findAll());
    }

    public function getQuestionFilterCount($filter)
    {
        $this->getQuestionFilter($filter);
        return count($this->findAll());
    }

    public function saveQuestion($data)
    {
        return $this->save($data);
    }

    public function deleteQuestion($id)
    {
        return $this->delete($id);
    }

    public function getSingleQuestion($id)
    {
        return $this->find($id);
    }

    
    public function generateTopicsValue($id)
    {
        $questions = $this->where('id_topik', $id)->findAll();
        $questionCount = count($questions);
        $value = [
            'question_count' => $questionCount == '0' ? null : $questionCount,
            // 'topic_duration' => $topicDuration == '0' ? null : gmdate('H:i:s', $topicDuration)
        ];
        return $value;
    }

    public function getRandomQuestions($id)
    {
        return $this->orderBy('id_soal', 'RANDOM')
        ->join('tb_topik', 'tb_topik.id_topik = tb_soal.id_topik')
            ->where('tb_topik.id_topik', $id)
            ->findAll();
    }
}
