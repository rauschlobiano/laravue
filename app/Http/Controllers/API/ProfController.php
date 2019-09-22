<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\ProfileType;
use App\ProfileGroup;
use App\ProfileStatus;

class ProfController extends Controller
{

    public function index()
    {
        return Profile::with('profiletype')
            ->with('profilegroup')
            ->with('profilestatus')
            ->orderBy('updated_at', 'DESC')
            ->paginate(10);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'accountname' => 'required | max:150 | min:3',
            'fname' => 'sometimes',
            'mname' => 'sometimes',
            'lname' => 'sometimes',
            'address' => 'sometimes',
            'bday' => 'date | required',
            'profilegroup_id' => 'required',
            'profiletype_id' => 'required',
            'profilestatus_id' => 'required',
            //'image' => 'sometimes|file|image|max:5000'
        ]);
        return Profile::create([
            'accountname' => $request['accountname'],
            'fname' => $request['fname'],
            'mname' => $request['mname'],
            'lname' => $request['lname'],
            'address' => $request['address'],
            'bday' => $request['bday'],
            'profilegroup_id' => $request['profilegroup_id'],
            'profiletype_id' => $request['profiletype_id'],
            'profilestatus_id' => $request['profilestatus_id'],
        ]);
    }


    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
    public function getValidation()
    {
        return request()->validate([
            'accountname' => 'required | max:150 | min:3',
            'fname' => 'sometimes',
            'mname' => 'sometimes',
            'lname' => 'sometimes',
            'address' => 'sometimes',
            'bday' => 'required',
            'profilegroup_id' => 'required',
            'profiletype_id' => 'required',
            'profilestatus_id' => 'required',
            //'image' => 'sometimes|file|image|max:5000'
        ]);
    }
    public function getProfTypes()
    {
        return ProfileType::all();
    }
    public function getProfGroups()
    {
        return ProfileGroup::all();
    }
    public function getProfStatus()
    {
        return ProfileStatus::all();
    }
}
