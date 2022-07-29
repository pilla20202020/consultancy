<?php

namespace App\Modules\Models\District;

use App\Modules\Models\State\State;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'district_name',
        'country_id',
        'state_id',
        'status',
    ];

    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }

    public static function getDistricts()
    {
        return self::select('id', 'district_name')->where('status', 'Active')->get();
    }

    public static function getDistrictsByProvinceId($state_id)
    {
        return self::select('id', 'district_name')->where('status', 'Active')->where('state_id',$state_id)->get();
    }
}
