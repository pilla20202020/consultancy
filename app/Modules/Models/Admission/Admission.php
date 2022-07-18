<?php

namespace App\Modules\Models\Admission;

use App\Modules\Models\Student\Student;
use App\Modules\Models\Commission\Commission;
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

    public function commissions()
    {
        return $this->hasMany(Commission::class,'admission_id','admissions_id')->orderBy('commissions_id');
    }

    public function claimCommission()
    {
        return $this->hasMany(Commission::class,'admission_id','admissions_id')->orderBy('claim_date')->where('commissions_status','pending');
    }


}
