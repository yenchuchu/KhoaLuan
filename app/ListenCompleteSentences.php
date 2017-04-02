<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListenCompleteSentences extends Model
{
    protected $fillable = [
        'title', 'point','content_json', 'type_user', 'class_id', 'url', 'created_at', 'updated_at'
    ];
}
