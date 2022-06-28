<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetailKegiatanRequest;
use App\Models\DetailKegiatanModel;
use App\Models\PegawaiModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DetailKegiatanController extends Controller
{
    public function getAllDetail()
    {
        try {
            $dbResult = array (
                'detail' => DetailKegiatanModel::with('protokolRole', 'kopimRole', 'dokpimRole')->get(),
                'pegawai' =>PegawaiModel::all(),
            );
            $detail = array(
                'data' => $dbResult,
                'message' => 'success'
            );
        } catch (\Throwable $th) {
            $detail = array(
                'data' => null,
                'message' => $th->getMessage()
            );
        }
        return view('page.DetailKegiatan')->with('data', $detail);
    }

    public function getAllData()
    {
        $data = array (
            'detail' =>DetailKegiatanModel::all(),
            'pegawai' =>PegawaiModel::all(),
        );
        return response()->json($data, 200);
    }

    public function createDetail(DetailKegiatanRequest $request)
    {
        try {
            $dbResult = DetailKegiatanModel::create($request->all());
            $detail = array(
                'data' => $dbResult,
                'response' => array(
                    'icon' => 'success',
                    'title' => 'Tersimpan',
                    'message' => 'Data berhasil disimpan',
                ),
                'code' => 201
            );
        } catch (\Throwable $th) {
            $detail = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }
        return response()->json($detail, $detail['code']);
    }

    public function getDetailById($detail_id)
    {
        try {
            $dbResult = DetailKegiatanModel::whereId($detail_id)->first();
            if ($dbResult) {
                $detail = array(
                    'data' => $dbResult,
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Ditemukan',
                        'message' => 'Data berhasil ditemukan',
                    ),
                    'code' => 201
                );
            } else {
                $detail = array(
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
            $detail = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return $detail;
    }

    public function updateDetail($detail_id, Request $request)
    {

        $date = Carbon::now();
        $detailDetails = $request->all();
        $detailDetails['updated_at'] = $date;

        try {
            $dbResult = DetailKegiatanModel::whereId($detail_id);
            $findId = $dbResult->first();
            if ($findId) {
                $detail = array(
                    'data' => $dbResult->update($detailDetails),
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Tersimpan',
                        'message' => 'Data berhasil diperbaharui',
                    ),
                    'code' => 201
                );
            } else {
                $detail = array(
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
            $detail = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return $detail;
    }

    public function deleteDetail($detail_id)
    {
        try {
            $dbResult = DetailKegiatanModel::whereId($detail_id);
            $findId = $dbResult->first();
            if ($findId) {
                $detail = array(
                    'data' => $dbResult->delete(),
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Terhapus',
                        'message' => 'Data berhasil dihapus',
                    ),
                    'code' => 201
                );
            } else {
                $detail = array(
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
            $detail = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return $detail;
    }
}
