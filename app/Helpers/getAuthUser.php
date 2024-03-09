<?php

function getUser() {
    $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());
    return $user;
}
