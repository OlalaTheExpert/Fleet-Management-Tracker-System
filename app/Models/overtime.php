<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class overtime extends Model
{
    use HasFactory;
    protected $dates = ['start_t', 'current_t'];
}
