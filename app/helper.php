<?php

use App\Models\Log;

function logging($user, $message){

    $formFields = [
        'employeeid' => $user,
        'description' => $message,
    ];

    Log::create($formFields);
}
