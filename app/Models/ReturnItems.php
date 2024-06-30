<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'image',
        'place',
        'description',
        'category',
        'return_to',
        'return_by',
        'claim_id',
        'report_id'
    ];
}
