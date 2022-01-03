<?php

namespace App\Service;

use App\Models\Guesthouse;

class GuesthouseService
{
    public function getGuesthouses($input)
    {
        return Guesthouse::all();
    }

    public function getGuesthouse($input)
    {
        return Guesthouse::find($input);
    }

    public function addGuesthouses($input)
    {
        $guesthouse = new Guesthouse([
            'roomNumber' => $input->roomNumber,
            'numberOfPeople' => $input->numberOfPeople,
            'status' => $input->status
        ]);

        $result = $guesthouse->save();
        return $result;
    }

    public function setGuesthouses($input,$id)
    {
        $guesthouse = Guesthouse::find($id);

        if (!$guesthouse instanceof Guesthouse) {
            return $id . " id'li misafirhane bulunamadı.";
        }

        $guesthouse['roomNumber'] = !empty($input->roomNumber) ? $input->roomNumber : $guesthouse['roomNumber'];
        $guesthouse['numberOfPeople'] = !empty($input->numberOfPeople) ? $input->numberOfPeople : $guesthouse['numberOfPeople'];
        $guesthouse['status'] = !is_null($input->status) ? $input->status : $guesthouse['status'];

        $result = $guesthouse->save();
        return $result;
    }

    public function deleteGuesthouses($input)
    {
        $guesthouse = Guesthouse::find($input);

        if (!$guesthouse instanceof Guesthouse) {
            return $input . " id'li misafirhane bulunamadı.";
        }

        $result = $guesthouse->delete();
        return $result;
    }
}
