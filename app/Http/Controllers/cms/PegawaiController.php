<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\PegawaiRequest;
use App\Models\PegawaiModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function getAllPegawai()
    {
        try {
            $pegawai = PegawaiModel::all();
        } catch (\Throwable $th) {
            $pegawai = $th->getMessage();
        }

        return view('page.Pegawai')->with('pegawai', $pegawai);
    }

    public function getAllData()
    {
        $pegawai = PegawaiModel::all();
        return response()->json($pegawai, 200);
    }

    public function createPegawai(PegawaiRequest $request)
    {
        try {
            $dbResult = PegawaiModel::create($request->all());
            $pegawai = array(
                'data' => $dbResult,
                'response' => array(
                    'icon' => 'success',
                    'title' => 'Tersimpan',
                    'message' => 'Data berhasil disimpan',
                ),
                'code' => 201
            );
        } catch (\Throwable $th) {
            $pegawai = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }
        return response()->json($pegawai, $pegawai['code']);
    }

    public function getPegawaiById($pegawai_id)
    {
        try {
            $dbResult = PegawaiModel::whereId($pegawai_id)->first();
            if ($dbResult) {
                $pegawai = array(
                    'data' => $dbResult,
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Ditemukan',
                        'message' => 'Data berhasil ditemukan',
                    ),
                    'code' => 201
                );
            } else {
                $pegawai = array(
                    'data' => null,
                    'response' => array(
                        'icon' => 'warning',
                        'title' => 'Not Found',
                        'message' => 'Data tidak tersedia',
                    ),
                    'code' => 404
                );
            }
        } catch (\Throwable $th) {
            $pegawai = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return $pegawai;
    }

    public function updatePegawai($pegawai_id, Request $request)
    {

        $date = Carbon::now();
        $pegawaiDetails = $request->all();
        $pegawaiDetails['updated_at'] = $date;

        try {
            $dbResult = PegawaiModel::whereId($pegawai_id);
            $findId = $dbResult->first();
            if ($findId) {
                $pegawai = array(
                    'data' => $dbResult->update($pegawaiDetails),
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Tersimpan',
                        'message' => 'Data berhasil diperbaharui',
                    ),
                    'code' => 201
                );
            } else {
                $pegawai = array(
                    'data' => null,
                    'response' => array(
                        'icon' => 'warning',
                        'title' => 'Not Found',
                        'message' => 'Data tidak tersedia',
                    ),
                    'code' => 404
                );
            }
        } catch (\Throwable $th) {
            $pegawai = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return $pegawai;
    }

    public function deletePegawai($pegawai_id)
    {
        try {
            $dbResult = PegawaiModel::whereId($pegawai_id);
            $findId = $dbResult->first();
            if ($findId) {
                $pegawai = array(
                    'data' => $dbResult->delete(),
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Terhapus',
                        'message' => 'Data berhasil dihapus',
                    ),
                    'code' => 201
                );
            } else {
                $pegawai = array(
                    'data' => null,
                    'response' => array(
                        'icon' => 'warning',
                        'title' => 'Not Found',
                        'message' => 'Data tidak tersedia',
                    ),
                    'code' => 404
                );
            }
        } catch (\Throwable $th) {
            $pegawai = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return $pegawai;
    }
}
