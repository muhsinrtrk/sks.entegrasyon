<?php

namespace App\Service;


use App\Models\Facility;

class FacilityService
{
    public function getFacilities($input)
    {
        $result = Facility::all();
        $result = FilterService::filterFacilityStatus($result);
        return $result;

    }
    public function getFacility($input)
    {
        $result = Facility::find($input);
        //$result = FilterService::filterFacilityStatus($result,$input);
        return $result;
    }
    public function addFacility($input)
    {
        $facility = new Facility([
            'name' => $input->name,
            'facilityName' => $input->facilityName,
            'status' => $input->status,
            'price' => $input->price
        ]);

        $result = $facility->save();
        return $result;
    }
    public function setFacility($input,$id)
    {
        $facility = Facility::find($id);

        if (!$facility instanceof Facility) {
            return $id . " id'li tesis bulunamad─▒.";
        }

        $facility['name'] = !empty($input->name) ? $input->name : $facility['name'];
        $facility['status'] = !is_null($input->status) ? $input->status : $facility['status'];
        $facility['price'] = !empty($input->price) ? $input->price : $facility['price'];

        $result = $facility->save();
        return $result;
    }
    public function deleteFacility($input)
    {
        $facility = Facility::find($input);

        if (!$facility instanceof Facility) {
            return $input . " id'li topluluk bulunamad─▒.";
        }

        $result = $facility->delete();
        return $result;
    }
}
