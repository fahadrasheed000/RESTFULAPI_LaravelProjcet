<?php
function apiResponse($data, $status, $message, $token = "", $user = null)
{
    $response = [];
    $response['status'] = $status;
    $response['message'] = $message;
    if ($user) {
        $response['current_user'] = $user->only(['name', 'email']);
    }
    $response['data'] = $data;
    if ($token) {
        return  response()->json($response)->header('Authorization', "bearer " . $token);
    } else {
        return  response()->json($response);
    }
}
function dateTimeFormat($date)
{
    return  date('Y-m-d h:i a', strtotime($date));
}

function getPageName()
{
    if (request()->is('students')) {
        return "<i class='fa fa-users'></i>&nbsp;&nbsp;Students";
    }
}

