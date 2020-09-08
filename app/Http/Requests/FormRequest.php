<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;
abstract class FormRequest extends LaravelFormRequest
{
    protected function failedValidation(Validator $validator)
    {
        if (request()->is('api*')) {
            $data = [
                "success" =>false,
                "message" => $validator->errors()
            ];
            throw new HttpResponseException(response()->json($data, JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
    }
}
