<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\KegiatanRequest;
use App\Interfaces\DetailKegiatanInterface;
use App\Models\DetailKegiatanModel;
use App\Models\KegiatanModel;
use App\Models\PegawaiModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function __construct(DetailKegiatanInterface $detailKegiatanRepo)
    {
        $this->detailKegiatanRepo = $detailKegiatanRepo;
    }

    public function getAllKegiatan()
    {
        try {
            $dbResult = array(
                'kegiatan' => KegiatanModel::with('kegiatanRole')->get(),
                'pegawai' => PegawaiModel::all(),
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

    public function createKegiatan(KegiatanRequest $request)
    {
        try {
            $detailKegiatan = $request->only([
                'tempat',
                'pakaian',
                'penyelenggara',
                'penjabat_menghadiri',
                'protokol',
                'kopim',
                'dokpim'
            ]);

            $detailKegiatanId = $this->detailKegiatanRepo->createData($detailKegiatan);
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

            return response()->json($kegiatan, $kegiatan['code']);
        }

        try {

            if ($detailKegiatanId['code'] == 404 or $detailKegiatanId['code'] == 500) {
                return $detailKegiatanId;
            } else {

                $kegiatanDetail = array(
                    'detail_kegiatan' => $detailKegiatanId['data'],
                    'nama_kegiatan' => $request->nama_kegiatan,
                    'tgl_mulai' => $request->tgl_mulai,
                    'tgl_berakhir' => $request->tgl_berakhir,
                    'keterangan' => $request->keterangan
                );
                $dbResult = KegiatanModel::create($kegiatanDetail);
                $kegiatan = array(
                    'data' => $dbResult,
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Tersimpan',
                        'message' => 'Data berhasil disimpan',
                    ),
                    'code' => 201
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

        return response()->json($kegiatan, $kegiatan['code']);
    }

    public function getKegiatanById($kegiatan_id)
    {
        try {
            $dbResult = KegiatanModel::whereId($kegiatan_id)->with('kegiatanRole')->first();
            $dbResult->tgl_mulai = date('Y-m-d\\TH:i', strtotime($dbResult->tgl_mulai));
            $dbResult->tgl_berakhir = date('Y-m-d\\TH:i', strtotime($dbResult->tgl_berakhir));
            if ($dbResult) {
                $kegiatan = array(
                    'data' => $dbResult,
                    'code' => 200
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

        return response()->json($kegiatan, $kegiatan['code']);
    }

    public function updateKegiatan($kegiatan_id, Request $request)
    {
        $date = Carbon::now();
        $request->updated_at = $date;

        $idDetail = $request->detail_kegiatan;
        $detailKegiatan = $request->only([
            'tempat',
            'pakaian',
            'penyelenggara',
            'penjabat_menghadiri',
            'protokol',
            'kopim',
            'dokpim'
        ]);

        $detailKegiatanId = $this->detailKegiatanRepo->updateData($idDetail, $detailKegiatan);
        try {
            $dbCon = KegiatanModel::whereId($kegiatan_id);
            $findId = $dbCon->first();

            if ($detailKegiatanId['code'] == 404 or $detailKegiatanId['code'] == 500) {
                return $detailKegiatanId;
            }
            $kegiatanDetail = $request->only([
                'tgl_mulai',
                'tgl_berakhir',
                'nama_kegiatan',
                'keterangan',
            ]);

            if ($findId) {
                $kegiatan = array(
                    'data' => $dbCon->update($kegiatanDetail),
                    'response' => array(
                        'icon' => 'success',
                        'title' => 'Tersimpan',
                        'message' => 'Data berhasil disimpan',
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

        return response()->json($kegiatan, $kegiatan['code']);
    }

    public function deleteKegiatan($kegiatan_id, $idDetail)
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

        $deleteDetail = $this->detailKegiatanRepo->deleteData($idDetail);
        if ($deleteDetail['code'] == 404 or $deleteDetail['code'] == 500) {
            return $deleteDetail;
        }

        return response()->json($kegiatan, $kegiatan['code']);
    }
}
