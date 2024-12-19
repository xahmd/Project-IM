<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'leave';

    // Specify the fillable fields (optional)
    protected $fillable = [
        'user_id', 'start_date', 'end_date', 'reason', 'status', // Adjust these based on your schema
    ];
}
