<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // menampilkan data dari table post
        $posts = Post::latest()->get();

        // membuat response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Post',
            'data' => $posts
        ], 200);
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
        //Set Validation
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'address' => 'required'
        ]);

        // Responses error Validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Save to Databases
        $post = Post::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'gender' => $request->gender,
            'address' => $request->address
        ]);

        // Success Save to Databases
        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Post Created',
                'data' => $post
            ], 201);
        }

        // Failed Save to Databases
        return response()->json([
            'success' => false,
            'message' => 'Post Failed to Save'
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Find post by ID
        $post = Post::findOrfail($id);

        // membuat response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data' => $post
        ], 200);
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
    public function update(Request $request, Post $post)
    {
        //Set Validation
        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'address' => 'required'
        ]);

        // Responses error Validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Find post by ID
        $post = Post::findOrfail($post->id);

        if ($post) {

            // Update post
            $post->update([
                'nik' => $request->nik,
                'name' => $request->name,
                'gender' => $request->gender,
                'address' => $request->address
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Post Updated',
                'data' => $post
            ], 200);
        }

        // Data post not Found
        return response()->json([
            'success' => false,
            'message' => 'Post not Found'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find post by ID
        $post = Post::findOrfail($id);

        if ($post) {

            // Delete post
            $post->delete();

            return response()->json([
                'success' => true,
                'message' => 'Post Deleted'
            ], 200);
        }

        // Data post not Found
        return response()->json([
            'success' => false,
            'message' => 'Post not Found'
        ], 404);
    }
}
