<?php
namespace App\Imports;
use App\Models\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class QuestionsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Question([
            'challengeID' => $row['challengeid'],
            'Question_ID' => $row['question_id'],
            'Question' => $row['question']
        ]);
    }
}

