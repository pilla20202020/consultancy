<?php

namespace App\Modules\Models\FollowUp;

use App\Modules\Models\Commission\Commission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    use HasFactory;

    protected $table = 'tbl_follow_ups';

    protected $fillable = [
        'refrence_id',
        'follow_up_type',
        'next_schedule',
        'follow_up_name',
        'follow_up_by',
        'remarks',
        'status',
        'created_by',
        'last_updated_by'
    ];

    public function commission(){
        return $this->belongsTo(Commission::class,'refrence_id','commissions_id');
    }




}
