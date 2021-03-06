<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [

        'apartment_id',
        'msg_title',
        'sender_name',
        'sender_mail',
        'message',
    ];

    // Relation
    public function apartment() {
        return $this->belongsTo('App\Apartment');
    }
}
