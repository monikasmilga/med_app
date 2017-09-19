<?php

namespace App\Http\Controllers;

use App\Models\MARoles;
use App\Models\MAUsers;
use App\Models\MAUsersRolesConnections;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class MAUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = JWTAuth::parseToken()->toUser();
        // when we are certain that the user is connected

        $users = MAUsers::all();
//        $users['role_id'] = MARoles::

        // formating data to response angular/json
        $response = [
            'users' => $users,
            'user' => $user,
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
        //front-end only
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new MAUsers();

        $user->id = Uuid::uuid4();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->position = $request->position;
//        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);
        $user->remember_token = 0;

        if ($user->save()) {
            $roles = new MAUsersRolesConnections();
            $dataSet = [];
            foreach ($request->roles as $id) {
                $dataSet[] = [
                    'user_id' => $user->id,
                    'role_id' => $id
                ];
            }
            $roles->insert($dataSet);
            return response()->json(['user' => $user], 201);
        } else {
            return response()->json(['error' => 'New user not saved!'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = MAUsers::find($id);
        $roles = MARoles::all();

        if ($user) {
            return response()->json(['user' => $user, 'roles' => $roles], 200);
        } else {
            return response()->json(['error' => 'User not found!'], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //front-end only
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = MAUsers::find($id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->position = $request->position;
//        $user->role_id = $request->role_id;

        if ($user->save()) {

            MAUsersRolesConnections::where('user_id', $id)->delete();
            $roles = new MAUsersRolesConnections();
            $dataSet = [];
            foreach ($request->roles as $id) {
                $dataSet[] = [
                    'user_id' => $user->id,
                    'role_id' => $id
                ];
            }
            $roles->insert($dataSet);
            return response()->json(['user' => $user], 200);
        }
        return response()->json(['error' => 'User not updated!'], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MAUsersRolesConnections::where('user_id', $id)->delete();
        $user = MAUsers::where('id', $id)->delete();
        return response()->json([
            'success' => $user
        ], 200);
    }


    public function signIn(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid Credentials!'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token!'], 500);
        }
        return response()->json(['token' => $token], 200);
    }
}
