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
        'manager',
        'fund_source',
        'location',
        'image',
        'status'
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
}
