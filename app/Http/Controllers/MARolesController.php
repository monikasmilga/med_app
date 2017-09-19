<?php

namespace App\Http\Controllers;

use App\Models\MARoles;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class MARolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = MARoles::all();

        $response = [
            'roles' => $roles
        ];

        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new MARoles();
        $role->id = Uuid::uuid4();
        $role->name = $request->name;

        if ($role->save()) {
            return response()->json(['role' => $role], 201);
        }else{
            return response()->json(['error' => 'New role not saved!'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = MARoles::find($id);

        if ($role) {
            return response()->json(['role' => $role], 200);
        }else {
            return response()->json(['error' => 'Role not found!'], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = MARoles::find($id);
        $role->name = $request->name;

        if ($role->save()) {
            return response()->json(['role' => $role], 200);
        }else{
            return response()->json(['error' => 'Edited role not saved!'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = MARoles::where('id', $id)->delete();
        return response()->json([
            'success' => $role
        ], 200);
    }
}
