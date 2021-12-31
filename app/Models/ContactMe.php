<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\replyMsg;


class ContactMe extends Model
{
    use HasFactory;
    public $guarded = [];

    public function replyMsg()
    {
        return $this->hasMany(replyMsg::class);
    }

}
