<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phonebook extends Model
{
    //
    protected $table = "phonebook";
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
