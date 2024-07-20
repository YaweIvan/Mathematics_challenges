<?php

namespace App\Imports;

use App\Models\Answer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class ImportAnswers implements ToModel, WithHeadingRow
{
    public function model(array $row)
{
    // Log the row data to see what keys are available

    return new Answer([
        'challengeID' => $row['challengeid'], // Ensure the header in Excel is 'challengeID'
        'Answer_ID' => $row['answer_id'],     // Ensure the header in Excel is 'Answer_ID'
        'Answer' => $row['answer'],           // Ensure the header in Excel is 'Answer'
    ]);
}

}
