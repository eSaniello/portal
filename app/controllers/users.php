<?php

namespace Controllers;

use Models\User;

class Users
{
    public static function get_users()
    {
        $users = User::all();
        return $users;
    }

    public static function create_user($fullname, $username, $password, $admin)
    {
        $pw = password_hash($password, PASSWORD_DEFAULT);

        $user = User::create(['fullname' => $fullname, 'username' => $username, 'password' => $pw, 'admin' => $admin]);
        return $user;
    }

    public static function check_if_user_exists($username)
    {
        $num = User::where('username', '=', $username)->count();

        return $num;
    }

    public static function get_user_by_username($username)
    {
        $user = User::where('username', $username)->first();
        return $user;
    }


    public static function get_user_by_id($id)
    {
        $user = User::where('id', $id)->get();
        return $user;
    }


    public static function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return $user;
    }

    public static function update($id, $fullname, $username, $admin)
    {
        $user = User::find((int)$id)->update(['fullname' => $fullname, 'username' => $username, 'admin' => $admin]);

        return $user;
    }
}
