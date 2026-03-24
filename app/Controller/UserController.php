<?php

namespace Controller;
use Model\User;
use Src\Request;
use Src\View;

class UserController // здесь пишутся методы CRUD
{
    public function profile(): string
    {
        return new View('site.profile_user');
    }
}