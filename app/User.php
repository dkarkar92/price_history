<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \App\Store;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The stores that belong to the user.
     */
    public function stores()
    {
        return $this->belongsToMany('App\Store', 'users_to_stores');
    }

    public function findUsersByStore($store_id)
    {
        $query = \DB::table('users')
            ->join('users_to_stores', 'users.id', '=', 'users_to_stores.user_id')
            ->join('stores', 'stores.id', '=', 'users_to_stores.store_id')
            ->select('users.name', 'users.email', 'stores.name as store_name')
            ->where('stores.id', $store_id)
            ->where('stores.active_flg', true)
            ->where('users_to_stores.active_flg', true)
            ->get();

        return $query;
    }
}
