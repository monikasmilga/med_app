<?php namespace App\Models;

class MAUsersRolesConnections extends CoreModel {

    protected $table = 'ma_users_roles_connections';

    protected $fillable = ['user_id', 'role_id'];

}
