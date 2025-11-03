<?php
function numberCard($card) :int
{
    $pattern = '/^(?=.*\d).{16,}$/';
    return preg_match($pattern, $card);
}

function dateExpiry($date) :int
{
    $pattern = '/^(?=.*\d).{4,}$/';
    return preg_match($pattern, $date);
}

function passwordStrong($mdp) :int
{
    $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/';
    return preg_match($pattern, $mdp);
}