<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CalendarServiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'calendar_id' => 'required',
            'sentUpdate' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'name' => 'required',
            'location' => 'required',
            'status' => 'required',
            'description' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'response' => array(
                'icon' => 'error',
                'title' => 'Validasi Gagal',
                'message' => 'Data yang di input tidak tervalidasi',
            ),
            'errors' => array(
                'length' => count($validator->errors()),
                'data' => $validator->errors()
            ),
        ], 422));
    }
}
