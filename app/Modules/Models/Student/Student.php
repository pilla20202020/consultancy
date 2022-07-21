<?php

namespace App\Modules\Models\Student;

use App\Modules\Models\Admission\Admission;
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
        'intake_year',
        'intake_month',
    ];

    public function admission(){
        return $this->belongsTo(Admission::class,'students_id','student_id');
    }


}
