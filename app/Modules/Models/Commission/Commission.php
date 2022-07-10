<?php

namespace App\Modules\Models\Commission;

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
}
