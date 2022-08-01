<?php

namespace App\Modules\Models\Student;

use App\Modules\Models\Admission\Admission;
use App\Modules\Models\Country\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $table = 'tbl_students';

    use HasFactory;

    protected $fillable = [
        'applicant',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'material_status',
        'spouse_name',
        'father_name',
        'mother_name',
        'mobile_no',
        'alternate_mobile_no',
        'email',
        'dob',
        'country_id',
        'state_id',
        'source_ref',
        'ref_id',
        'district_id',
        'municipality_name',
        'ward_no',
        'intake_year',
        'intake_month',
        'village_name',
        'full_address',
        'status',
        'created_by',
        'updated_by',
    ];

    public function admission(){
        return $this->belongsTo(Admission::class,'students_id','student_id');
    }

    public function educations()
    {
        return $this->hasMany(StudentEducation::class,'student_id','students_id');
    }

    public function languages()
    {
        return $this->hasMany(StudentLanguage::class,'student_id','students_id');
    }

    public function fields()
    {
        return $this->hasMany(StudentField::class,'student_id','students_id');
    }

}
