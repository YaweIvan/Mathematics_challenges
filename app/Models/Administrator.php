<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    protected $table = 'administrator';
    public $timestamps = false;

    protected $fillable = ['username', 'password'];

    // If you want to automatically hash the password when setting it
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
