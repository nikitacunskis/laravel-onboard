<?php

if (!function_exists('canDo')) {
    function canDo(array $check)
    {
        $user = auth()->user();

        if (!$user) {
            $allowed = ['home', 'register', 'login'];
        } else {
            $allowed = $user->group->permissions;
        }

        foreach ($check as $permission) {
            if (!in_array($permission, $allowed)) {
                return false;
            }
        }

        return true;
    }
}
