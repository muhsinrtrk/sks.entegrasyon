<?php

namespace App\Service;


use App\Models\Community;
use App\Models\StudentHasCommunity;
use Illuminate\Support\Facades\Auth;

class CommunityService
{
    public function getCommunities($input)
    {
        return Community::all();
    }

    public function getCommunity($input)
    {
        return Community::find($input);
    }

    public function addCommunity($input)
    {
        $community = new Community([
            'name' => $input->name,
            'info' => $input->info,
            'academicalPersonalId' => $input->academicalPersonalId,
            'presidentStudentId' => $input->presidentStudentId
        ]);

        $result = $community->save();
        return $result;
    }

    public function setCommunity($input, $id)
    {
        $community = Community::find($id);

        if (!$community instanceof Community) {
            return $id . " id'li tesis bulunamadı.";
        }

        $community['name'] = !empty($input->name) ? $input->name : $community['name'];
        $community['info'] = !is_null($input->info) ? $input->info : $community['info'];

        $result = $community->save();
        return $result;
    }

    public function deleteCommunity($input)
    {
        $community = Community::find($input);

        if (!$community instanceof Community) {
            return $input . " id'li topluluk bulunamadı.";
        }

        $result = $community->delete();
        return $result;
    }

    public function joinStudentCommunity($input)
    {
        $studentHasCommunity = new StudentHasCommunity([
            'communityId' => $input->communityId,
            'studentId' => Auth::user()->getAuthIdentifier()
        ]);
        $result = $studentHasCommunity->save();
        return $result;
    }
}
