<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryReport extends Model
{
    use HasFactory;
    protected $table = 'history_reports';

    protected $fillable = [
        'report_id',
        'updated_by',
        'status',
        'note'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}