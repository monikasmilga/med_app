<?php namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class MAUsers extends Authenticatable {

    protected $table = 'ma_users';

    use Notifiable;

//    protected $fillable = ['id', 'role_id', 'avatar_id', 'first_name', 'last_name', 'position', 'email', 'show_in_front'];
    protected $fillable = ['email', 'password'];

    protected $hidden = ['password', 'remember_token'];
}
