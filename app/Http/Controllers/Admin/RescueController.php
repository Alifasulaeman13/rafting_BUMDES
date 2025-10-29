<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RescueMember;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreRescueMemberRequest;
use App\Http\Requests\Admin\UpdateRescueMemberRequest;

class RescueController extends Controller
{
    public function index()
    {
        return response()->json(RescueMember::orderBy('nama')->get());
    }

    public function store(StoreRescueMemberRequest $request)
    {
        $data = $request->validated();
        $member = RescueMember::create($data);
        return response()->json($member, 201);
    }

    public function show(RescueMember $rescue)
    {
        return response()->json($rescue);
    }

    public function update(UpdateRescueMemberRequest $request, RescueMember $rescue)
    {
        $data = $request->validated();
        $rescue->update($data);
        return response()->json($rescue);
    }

    public function destroy(RescueMember $rescue)
    {
        $rescue->delete();
        return response()->json(['deleted' => true]);
    }
}