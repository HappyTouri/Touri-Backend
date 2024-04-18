<?php

namespace App\Traits;

trait JSONResponses
{

    protected $jsonResponses = [
        100 => "Continue",
        200 => "Success",
        201 => "the request was successfully fulfilled",
        403 => "Authorizatoin faild",
        404 => "Not Found",

    ];

    function create_response(bool $success, string $message = '', $data = "", $status = 200)
    {
        return response()->json(
            [
                'success' => $success,
                'message' => $message,
                'data' => $data,
                'status' => $status,
                'status Message' => $this->jsonResponses[$status] ?? 'Something went wrong, please reload the page and try again',
            ],
            $status
        );
    }
}
