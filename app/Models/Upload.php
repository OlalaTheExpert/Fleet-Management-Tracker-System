<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_name',
        'Comment',
        'uploaded_by',
        'station_id',
        'approved_by',
        'status'
    ];
}
