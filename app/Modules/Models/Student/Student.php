<?php

namespace App\Modules\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $table = 'tbl_students';

    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'program',
        'intake',
    ];
}
