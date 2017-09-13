<?php namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class MAUsers extends Authenticatable {

    protected $table = 'ma_users';

    public $incrementing = false;

    use Notifiable;

    protected $fillable = ['id', 'first_name', 'last_name', 'email', 'position', 'role_id', 'avatar_id',  'password', 'show_in_front'];

    protected $hidden = ['password', 'remember_token'];
}
