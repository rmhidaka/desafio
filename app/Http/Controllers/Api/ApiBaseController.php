<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Response;

class ApiBaseController extends Controller
{

    public function sendResponse($result, $message)
    {
        \Log::info($message);
        return Response::json(self::makeResponse($message, $result));
    }

    public function sendError(Exception $exception, $error, $code = 404)
    {
        \Log::error($exception->getMessage());
        return Response::json(self::makeError($exception, $error), $code);
    }

    /**
     * @return array
     */
    private static function makeResponse($message, $data) : array
    {
        return [
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ];
    }

    /**
     * @return array
     */
    private static function makeError(Exception $exception,  $message, array $data = []) : array
    {
        \Log::error($exception);
        $res = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($data)) {
            $res['data'] = $data;
        }

        return $res;
    }
}
