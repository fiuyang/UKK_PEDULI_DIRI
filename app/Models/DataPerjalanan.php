<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPerjalanan extends Model
{
    use HasFactory;
    protected $table = "data_perjalanan";
    protected $fillable = ['tanggal', 'jam', 'lokasi', 'suhu_tubuh'. 'created_at', 'updated_at'];
}
