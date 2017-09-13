<?php

namespace App\Http\Controllers;

use App\Models\MAPosts;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\Facades\JWTAuth;

class MAPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = MAPosts::all();

        $response = [
            'posts' => $posts
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new MAPosts();
        $user = JWTAuth::parseToken()->toUser();
        $post->id = Uuid::uuid4();
        $post->user_id = $user->id;
        $post->title = $request->title;
        $post->text = $request->text;

        if ($post->save()) {
            return response()->json(['post' => $post], 201);
        } else {
            return response()->json(['error' => 'New post not saved!'], 400);
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
        $post = MAPosts::find($id);

        if ($post) {
            return response()->json(['post' => $post], 200);
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
        //
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
        $post = MAPosts::find($id);
        $post->title = $request->title;
        $post->text = $request->text;

        if ($post->save()) {
            return response()->json(['post' => $post], 200);
        } else {
            return response()->json(['error' => 'New post not saved!'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = MAPosts::where('id', $id)->delete();
        return response()->json([
            'success' => $post
        ], 200);
    }
}
