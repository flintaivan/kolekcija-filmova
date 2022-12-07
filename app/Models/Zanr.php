<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Film;

class Zanr extends Model
{
    use HasFactory;
    protected $table = 'zanr';
    protected $fillable = [
        'naziv',
    ];
    public function film() {
        $this->belongsTo(Film::class, 'id_zanra');
    }
}
