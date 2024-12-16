<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;
    protected $table = 'fasilitas';
    protected $fillable = [
        'name',
        'description',
        'fund_source',
        'longitude',
        'latitude',
        'image',
        'status',
        'latitude',
        'longitude',
        'dinas_id',
        'luasan'
    ];

    // Define the many-to-many relationship with Report
    public function reports()
    {
        return $this->belongsToMany(Report::class, 'report_fasilitas', 'fasilitas_id', 'report_id')
            ->withPivot('report_id', 'fasilitas_id');  // Pivot keys
    }
    // Define the many-to-many relationship with Kategori
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'fasilitas_has_category', 'fasilitas_id', 'category_id')
            ->withPivot('fasilitas_id', 'category_id'); // Pivot keys
    }
    public function dinas()
    {
        return $this->belongsTo(Dinas::class, 'dinas_id');
    }
}
