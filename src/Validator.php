<?php

namespace App;
class Validator
{
    public function validate($user)
    {
        $errors = [];
        if (empty($user['name'])) {
            $errors['name'] = "Can't be blank";
        }
        
        return $errors;
    }
}