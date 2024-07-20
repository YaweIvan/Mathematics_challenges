<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $table = 'challenge';
    protected $primaryKey = 'challengeID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'challengeID',
        'openingDate',
        'closingDate',
        'duration',
        'number_of_questions'
    ];
}
