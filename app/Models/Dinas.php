<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dinas extends Model
{
    use HasFactory;
    protected $table = 'dinas';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'city_id',
        'address'
    ];
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class, 'dinas_id');
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
