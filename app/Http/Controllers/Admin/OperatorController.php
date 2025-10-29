<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Operator;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreOperatorRequest;
use App\Http\Requests\Admin\UpdateOperatorRequest;

class OperatorController extends Controller
{
    public function index()
    {
        return response()->json(Operator::orderBy('nama')->get());
    }

    public function store(StoreOperatorRequest $request)
    {
        $data = $request->validated();
        $op = Operator::create($data);
        return response()->json($op, 201);
    }

    public function show(Operator $operator)
    {
        return response()->json($operator);
    }

    public function update(UpdateOperatorRequest $request, Operator $operator)
    {
        $data = $request->validated();
        $operator->update($data);
        return response()->json($operator);
    }

    public function destroy(Operator $operator)
    {
        $operator->delete();
        return response()->json(['deleted' => true]);
    }
}