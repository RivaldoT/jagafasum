<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = 'reports';

    protected $fillable = [
        'user_id',
        'description',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the many-to-many relationship with Fasilitas
    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'report_fasilitas', 'report_id', 'fasilitas_id')
            ->withPivot('report_id', 'fasilitas_id');  // No additional fields, just the foreign keys
    }

    public function history()
    {
        return $this->hasMany(HistoryReport::class);
    }
}
