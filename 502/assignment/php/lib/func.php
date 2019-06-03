<?php

function PasswordMD5($password)
{
    return md5($password . "sphinx");
}

function checkpassword($password)
{
    if (strlen($password) < 8 || strlen($password) > 12) {
        //if the password is under 6 and over 8 characters
        return "The password must be 6-8 characters";
    } elseif (!preg_match("#[0-9]+#", $password)) {
        //if the password does not include any number
        return "Password must include at least one number!";
    } elseif (!preg_match("#[a-z]+#", $password)) {
        //if the password does not include any letter
        return "Password must include at least one letter!";
    } elseif (!preg_match("#[A-Z]+#", $password)) {
        //if the password does not include any uppercase letter
        return "Password must include at least one uppercase letter!";
    } elseif (!preg_match("#[~!@\#]+#", $password)) {
        //if the password does not include special character "~!@#"
        return "Password must include at least one special character from ~!@#!";
    } else {
        return "correct!";
    }
}