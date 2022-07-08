<?php

namespace App\Modules\Models\Admission;

use App\Modules\Models\Student\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    protected $table = 'tbl_admissions';

    protected $fillable = [
        'student_id',
        'college',
        'fees',
        'admission_date'
    ];

    public function student(){
        return $this->belongsTo(Student::class,'student_id','students_id');
    }


}
