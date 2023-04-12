<?php

namespace App\Repositories\URL;

use App\Repositories\URL\iUrlRepository;
use App\Models\CustomField;

class UrlRepository implements iUrlRepository{

    public function baseURL(){
        return CustomField::where('shortcode', 'BASE_URL')->first();
    }

    public function UrlProfile(){
        $baseUrl = $this->baseURL();
        $profile_pic = CustomField::where('shortcode', 'PROFILE_PIC')->first();
        $profile_pic = 'http://localhost/skilledtalk2/storage/app/public/images/users/profile/';

        return $profile_pic;
        return $baseUrl->description . $profile_pic->description;
    }

    public function UrlPost(){
        $baseUrl = $this->baseURL();
        $profile_pic = CustomField::where('shortcode', 'POST_FILES')->first();
        return  $profile_pic->description;
        return $baseUrl->description . $profile_pic->description;
    }

}
