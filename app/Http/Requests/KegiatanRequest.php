<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class KegiatanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tgl_mulai' => 'required',
            'tgl_berakhir' => 'required',
            'nama_kegiatan' => 'required|min:5',
            'keterangan' => 'required|min:5',
            'tempat' => 'required|min:5',
            'pakaian' => 'required|min:3',
            'penyelenggara' => 'required|min:3',
            'penjabat_menghadiri' => 'required|min:3',
            'protokol' => 'required|integer',
            'kopim' => 'required|integer',
            'dokpim' => 'required|integer',
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
