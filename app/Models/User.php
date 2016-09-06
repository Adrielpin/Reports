<?php

namespace Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    protected $fillable = [
        'name', 'email', 'password','costumer_id', 'type_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
