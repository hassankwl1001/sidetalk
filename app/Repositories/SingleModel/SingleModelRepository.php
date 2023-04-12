<?php

namespace App\Repositories\SingleModel;
use App\Repositories\SingleModel\iSingleModelRepository;
use App\Models\EmployeeTypes;
use App\Models\JobTypes;
use App\Models\Company;
use App\Models\IndustryTypes;
use App\Models\PostType;
use App\Models\Reflection;
use App\Models\PostPrivacy;
use App\Models\User;

class SingleModelRepository implements iSingleModelRepository{

    public $employeeTypes;
    public $postType;
    public $postPrivacy;
    public $reflections;
    public $users;
    public $industryTypes;
    public $jobTypes;
    public $company;

    public function __construct(EmployeeTypes $employeeTypes, PostType $postType, PostPrivacy $postPrivacy, Reflection $reflections, User $user, IndustryTypes $industryTypes, JobTypes $jobTypes, Company $company)
    {
        $this->employeeTypes = $employeeTypes;
        $this->postType = $postType;
        $this->postPrivacy = $postPrivacy;
        $this->reflections = $reflections;
        $this->users=$user;
        $this->industryTypes=$industryTypes;
        $this->jobTypes=$jobTypes;
        $this->company=$company;
    }

}