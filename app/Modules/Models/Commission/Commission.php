<?php

namespace App\Modules\Models\Commission;

use App\Modules\Models\Admission\Admission;
use App\Modules\Models\Student\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $table = 'tbl_commissions';

    protected $fillable = [
        'student_id',
        'admission_id',
        'title',
        'fees',
        'claim_date',
        'created_by'
    ];

    public function student(){
        return $this->belongsTo(Student::class,'student_id','students_id');
    }

    public function admission(){
        return $this->belongsTo(Admission::class,'admission_id','admissions_id');
    }
}
