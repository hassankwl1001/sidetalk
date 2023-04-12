<?php

if(!function_exists('is_user_online')){
    function is_user_online($user_id){
        if(Illuminate\Support\Facades\Cache::has('user-is-online-'.$user_id)){
            return 'user-online';
        }else{
            return 'user-offline';
        }
    }
}





