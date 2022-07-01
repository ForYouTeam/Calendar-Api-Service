<?php

namespace App\Repositories;

use App\Interfaces\GServiceInterface;
use App\Models\CalendarServiceModel;
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event;

class GServiceRepository implements GServiceInterface

{
    public function createData(array $detailStaff)
    {
        try {
            $newScheduile = array(
                'name' => $detailStaff['nama_kegiatan'],
                'startDateTime' => new Carbon($detailStaff['tgl_mulai']),
                'endDateTime' => new Carbon($detailStaff['tgl_berakhir']),
                'location' => $detailStaff['tempat'],
                'description' => $detailStaff['keterangan'],
                'sendUpdate' => true,
                'status' => 'confirmed',
            );
            $event = Event::create($newScheduile);
            $result = $event->save();

            $newScheduile['calendar_id'] = $result->googleEvent->id;

            CalendarServiceModel::create($newScheduile);
            $calendar = array(
                'response' => array(
                    'icon' => 'success',
                    'title' => 'Berhasil',
                    'message' => 'Data berhasil dibuat',
                ),
                'code' => 201
            );
        } catch (\Throwable $th) {
            $calendar = array(
                'data' => null,
                'response' => array(
                    'icon' => 'error',
                    'title' => 'Gagal',
                    'message' => $th->getMessage(),
                ),
                'code' => 500
            );
        }

        return $calendar;
    }

    public function getById($idStaff)
    {
    }

    public function updateData($idStaff, array $detailStaff)
    {
    }

    public function deleteData($idStaff)
    {
    }
}
