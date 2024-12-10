<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $fillable = [
        'name', 'staffID', 'startdate',
        'enddate', 'resumdate', 'leave_type',
        'initial_leave_bal', 'final_leave_bal',
        'status', 'Reason'
    ];

}
