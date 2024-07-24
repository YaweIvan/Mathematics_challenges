<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'report';

    protected $fillable = [
        'Most_Correctly_Answered_Questions',
        'School_Rankings',
        'Perfomance_Over_Time',
        'Question_Repetition_Rate',
        'Worst_Perfoming_School',
        'Best_Perfoming_Schools',
        'Incomplete_Challenges',
        'schoolRegistrationNumber',
        'challengeID',
    ];
}
