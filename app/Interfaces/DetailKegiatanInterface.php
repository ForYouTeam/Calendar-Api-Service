<?php

namespace App\Interfaces;

interface DetailKegiatanInterface

{
    public function getById($id);
    public function createData(array $newDetail);
    public function updateData($id, array $newDetail);
    public function deleteData($id);
}
