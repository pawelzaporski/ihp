<?php

function random_string($i_max) {
    $string = '0123456789abcdefghijklmnoprstuwyzABCDEFGHIJKLMNOPRSTUWYZ';
    $random = '';
    
    for ($i = 1; $i <= $i_max; $i++) {
        $random .= $string[rand(0, strlen($string) - 1)];
    }
    
    return $random;
}
