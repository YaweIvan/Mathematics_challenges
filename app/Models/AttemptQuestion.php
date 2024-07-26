<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttemptQuestion extends Model
{
    use HasFactory;

    protected $table = 'attempt_questions'; // Ensure the table name is correct

    protected $primaryKey = 'attempt_question_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'attempt_question_id', 'attemptID', 'Question_ID', 'image', 'challengeID', 'selected_answer', 'correct_answer', 'marks'
    ];

    // Define relationships if necessary
    public function challenge()
    {
        return $this->belongsTo(Challenge::class, 'challengeID');
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participantID'); // Adjust 'participantID' if needed
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'Question_ID');
    }
}
