<?php

namespace App\Models;
use App\Model\Zanr;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
    protected $table = 'filmovi';
    protected $path = 'images/';
    protected $fillable = [
        'naslov',
        'id_zanra',
        'godina',
        'trajanje',
        'slika',
    ];
    public function zanr() {
        $this->hasOne(Zanr::class, 'id');
    }
    public function getSlikaAttribute($value) {
        return asset($this->path . $value);
    }
    public function getTrajanjeAttribute($value) {
        $d = explode(':', $value);
        return ($d[0] * 60) + ($d[1]) + $d[2] . ' min';
    }
    public static function Alphabet() {
        $alphabet = range('A', 'Z');
        return $alphabet;
    }
}
