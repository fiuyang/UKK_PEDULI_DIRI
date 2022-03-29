<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perjalanan extends Model
{
    use HasFactory;
    protected $table = "perjalanans";
    protected $fillable = ['users_id','tanggal', 'jam', 'lokasi', 'suhu_tubuh'];

    public function view_users() {
        return $this->belongsTo(User::class, 'users_id');
    }
}
