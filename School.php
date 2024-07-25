<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $primaryKey = 'schoolRegistrationNumber';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'schoolRegistrationNumber', 'schoolName', 'district', 'repName', 'repEmail',
    ];
}
