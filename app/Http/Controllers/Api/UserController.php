<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    // USER REGISTER API - POST
    public function register(Request $request)
    {
        // create user data + save
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        // send response
        return response()->json([
            "status" => 1,
            "message" => "User registered successfully"
        ], 200);
    }

    // USER LOGIN API - POST
    public function login(Request $request)
    {
        // validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        // verify user + token
        if (!$token = auth()->attempt(["email" => $request->email, "password" => $request->password])) {
            return response()->json([
                "status" => 0,
                "message" => "Invalid credentials"
            ]);
        }

        // send response
        return response()->json([
            "status" => 1,
            "message" => "Logged in successfully",
            "access_token" => $token
        ]);
    }

    // USER PROFILE API - GET
    public function profile()
    {
        $user_data = auth()->user();
        return response()->json([
            "status" => 1,
            "message" => "User profile data",
            "data" => $user_data
        ]);
    }

    // USER LOGOUT API - GET
    public function logout()
    {
        auth()->logout();
        return response()->json([
            "status" => 1,
            "message" => "User logged out"
        ]);
    }
}
