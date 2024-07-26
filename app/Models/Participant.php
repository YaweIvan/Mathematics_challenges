<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $primaryKey = 'Username';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'Username', 'image', 'firstName', 'lastName', 'participantEmail', 'dateOfBirth', 'schoolRegistrationNumber'
    ];
}
