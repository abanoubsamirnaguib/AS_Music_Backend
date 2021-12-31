<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ContactMe;


class replyMsg extends Model
{
    use HasFactory;
    protected $table = 'reply_msg';
    public $guarded = [];

    public function ContactMe()
    {
        return $this->belongsTo(ContactMe::class ,'contact_me_id');
    }
}
