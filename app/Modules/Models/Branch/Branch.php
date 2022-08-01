<?php

namespace App\Modules\Models\Branch;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'tbl_branches';

    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];
}
