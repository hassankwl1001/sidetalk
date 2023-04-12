<?php

namespace App\Repositories\Users;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use App\Repositories\Users\iUserRepository;

use App\Repositories\Generic\GenericRepository;

class UserRepository extends GenericRepository implements iUserRepository{

    private $user;
    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->user = $user;
    }

    public function validateUser($email){
        return $this->user->where('email', $email)->first();
    }

    public function updateProfile(ProfileUpdateRequest $request){
        $user = $request->store();
        $user = new LoginResource($user);
        return $user;
    }

}
