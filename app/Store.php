<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /**
     * The users that belong to the store.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'users_to_stores');
    }
}
