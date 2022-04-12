<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perjalanan extends Model
{
    use HasFactory;
    protected $table = "perjalanans";
    protected $fillable = ['users_id','tanggal', 'jam', 'lokasi', 'suhu_tubuh', 'latitude', 'longitude'];
    public $appends = [
        'coordinate', 'map_popup_content',
    ];

    public function users() {
        return $this->belongsTo(User::class, 'users_id');
    }


    public function getCoordinateAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return $this->latitude . ', ' . $this->longitude;
        }
    }

    public function getMapPopupContentAttribute()
    {
        $mapPopupContent = '';
        $mapPopupContent .= '<div class="my-2"><strong>' . __('outlet.name') . ':</strong><br>' . $this->name_link . '</div>';
        $mapPopupContent .= '<div class="my-2"><strong>' . __('outlet.coordinate') . ':</strong><br>' . $this->coordinate . '</div>';

        return $mapPopupContent;
    }
}
