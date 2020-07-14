<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat_message extends Model
{

    protected $fillable = ['status', 'message', 'to_user_id', 'from_user_id'];
    public function to_user()
    {
        return $this->belongsTo(User::class);
    }

    public function from_user()
    {
        $this->belongsTo(User::class);
    }
}
