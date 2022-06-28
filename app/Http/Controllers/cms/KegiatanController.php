<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\KegiatanRequest;
use App\Models\DetailKegiatanModel;
use App\Models\KegiatanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function getAllKegiatan()
    {
        try {
            $dbResult = array (
                'kegiatan' => KegiatanModel::with('kegiatanRole')->get(),
                'detail' =>DetailKegiatanModel::all(),
            );
            $kegiatan = array(
                'data' => $dbResult,
                'message' => 'success'
            );
        } catch (\Throwable $th) {
            $kegiatan = array(
                'data' => null,
                'message' => $th->getMessage()
            );
        }
        return view('page.Kegiatan')->with('data', $kegiatan);
    }

    public function getAllData()
    {
        $data = array (
            'detail' =>KegiatanModel::all(),
            'detail' =>DetailKegiatanModel::all(),
        );
        return response()->json($data, 200);
    }

    public function createKegiatan(KegiatanRequest $request)
    {
        try {
            $dbResult = KegiatanModel::create($request->all());
            $kegiatan = array(
                'data' => $dbResult,
                'response' => array(
                    'icon' => 'success',
                    'title' => 'Tersimpan',
                    'message' => 'Data berhasil disimpan',
                ),
                'code' => 201
            );
        } catch (\Throwable $th) {
            $kegiatan = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }
        return response()->json($kegiatan, $kegiatan['code']);
    }

    public function getKegiatanById($kegiatan_id)
    {
        try {
            $dbResult = KegiatanModel::whereId($kegiatan_id)->first();
            $dbResult->tgl = Carbon::createFromFormat('Y-m-d H:i:s', $dbResult->tgl)->format('Y-m-d\\TH:i');
            if ($dbResult) {
                $kegiatan = array(
                    'data' => $dbResult,
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Ditemukan',
                        'message' => 'Data berhasil ditemukan',
                    ),
                    'code' => 201
                );
            } else {
                $kegiatan = array(
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
            $kegiatan = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return $kegiatan;
    }

    public function updateKegiatan($kegiatan_id, Request $request)
    {

        $date = Carbon::now();
        $kegiatanDetails = $request->all();
        $kegiatanDetails['updated_at'] = $date;

        try {
            $dbResult = KegiatanModel::whereId($kegiatan_id);
            $findId = $dbResult->first();
            if ($findId) {
                $kegiatan = array(
                    'data' => $dbResult->update($kegiatanDetails),
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Tersimpan',
                        'message' => 'Data berhasil diperbaharui',
                    ),
                    'code' => 201
                );
            } else {
                $kegiatan = array(
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
            $kegiatan = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return $kegiatan;
    }

    public function deleteKegiatan($kegiatan_id)
    {
        try {
            $dbResult = KegiatanModel::whereId($kegiatan_id);
            $findId = $dbResult->first();
            if ($findId) {
                $kegiatan = array(
                    'data' => $dbResult->delete(),
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Terhapus',
                        'message' => 'Data berhasil dihapus',
                    ),
                    'code' => 201
                );
            } else {
                $kegiatan = array(
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
            $kegiatan = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return $kegiatan;
    }
}
