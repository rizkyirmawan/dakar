<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    use HasFactory;

    protected $table = 'bagian';

    protected $guarded = [];

    public $timestamps = false;

    public function karyawan()
    {
    	return $this->hasMany(\App\Models\Karyawan\Karyawan::class);
    }
}
