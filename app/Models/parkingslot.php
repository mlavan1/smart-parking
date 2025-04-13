<?php

namespace App\Models\parkingslot;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parkingslot extends Model
{
    use HasFactory;
    protected $fillable = [
        'slot_name', 'location', 'date', 'time', 'status'
    ];
}
