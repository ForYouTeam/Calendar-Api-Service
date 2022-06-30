<?php

namespace App\Interfaces;

interface GServiceInterface
{
    public function createData(array $detailStaff);
    public function getById($idStaff);
    public function updateData($idStaff, array $detailStaff);
    public function deleteData($idStaff);
}
