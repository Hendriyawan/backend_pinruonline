<?php

use Illuminate\Support\Facades\Auth;
use App\Models\User;

function idApi(){
    if(auth('api')->check()){
        return auth('api')->user()->id;
    }
}
?>