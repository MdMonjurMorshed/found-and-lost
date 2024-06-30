<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class MessageSent extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'topic',
        'claim_id',
        'report_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
