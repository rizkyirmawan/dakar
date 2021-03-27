<?php

namespace App\Models\Karyawan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlipGaji extends Model
{
    use HasFactory;

    protected $table = 'slip_gaji';

    protected $guarded = [];

    public function karyawan()
    {
    	return $this->belongsTo(\App\Models\Karyawan\Karyawan::class);
    }
}
