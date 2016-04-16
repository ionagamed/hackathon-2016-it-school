<?php

namespace App;

class User extends \Eloquent
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "username", "mac", "ip"
    ];
}
