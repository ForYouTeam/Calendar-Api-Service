<?php

namespace App\Repositories;

use App\Interfaces\DetailKegiatanInterface;
use App\Models\DetailKegiatanModel;
use Carbon\Carbon;

class DetailKegiatanRepo implements DetailKegiatanInterface
{
    public function getById($id)
    {
        try {
            $dbResult = DetailKegiatanModel::whereId($id)->first();
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

    public function createData(array $newDetail)
    {
        try {
            $dbResult = DetailKegiatanModel::create($newDetail);
            $detail = array(
                'data' => $dbResult,
                'message' => 'Data berhasil disimpan',
                'code' => 201
            );
        } catch (\Throwable $th) {
            $detail = array(
                'data' => null,
                'message' => $th->getMessage(),
                'code' => 500
            );
        }
        return $detail;
    }

    public function updateData($id, array $newDetail)
    {
        $date = Carbon::now();;
        $newDetail['updated_at'] = $date;

        try {
            $dbResult = DetailKegiatanModel::whereId($id);
            $findId = $dbResult->first();
            if ($findId) {
                $detail = array(
                    'data' => $dbResult->update($newDetail),
                    'message' => 'Data berhasil diperbaharui',
                    'code' => 201
                );
            } else {
                $detail = array(
                    'data' => null,
                    'message' => 'Data tidak tersedia',
                    'code' => 404
                );
            }
        } catch (\Throwable $th) {
            $detail = array(
                'data' => null,
                'message' => $th->getMessage(),
                'code' => 500
            );
        }

        return $detail;
    }

    public function deleteData($id)
    {
        try {
            $dbResult = DetailKegiatanModel::whereId($id);
            $findId = $dbResult->first();
            if ($findId) {
                $detail = array(
                    'data' => $dbResult->delete(),
                    'message' => 'Data berhasil dihapus',
                    'code' => 201
                );
            } else {
                $detail = array(
                    'data' => null,
                    'message' => 'Data tidak tersedia',
                    'code' => 404
                );
            }
        } catch (\Throwable $th) {
            $detail = array(
                'data' => null,
                'message' => $th->getMessage(),
                'code' => 500
            );
        }

        return $detail;
    }
}
