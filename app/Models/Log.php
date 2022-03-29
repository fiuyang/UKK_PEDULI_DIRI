<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $table = "log_aktifitas";
    protected $fillable = ['users_id', 'aksi', 'waktu', 'tipe'];

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
