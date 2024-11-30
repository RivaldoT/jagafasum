<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    public $timestamp = false;

    protected $fillable = ['name', 'description'];

    // Define the many-to-many relationship with Fasilitas
    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'fasilitas_has_category', 'category_id', 'fasilitas_id')
            ->withPivot('fasilitas_id', 'category_id');
    }
}
