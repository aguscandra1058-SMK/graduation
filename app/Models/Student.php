<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'nis',
        'nisn',
        'name',
        'gender',
        'id_classroom',
        'id_major',
        'status'
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'id_classroom');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'id_major');
    }
}
