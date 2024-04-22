<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = User::with('country')->get();
            return $this->create_response(true, 'ok', $data);
        } catch (\Exception $e) {
            return $this->create_response(false, 'Something went wrong, please reload the page and try again', 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = new User([
                "name" => $request->name,
                "mobile" => $request->mobile,
                "email" => $request->email,
                "role" => $request->role ?? "customer",
                "password" => $request->password ?? "happytouri",
                "country_id" => $request->country_id,
            ]);
            $user->save();

            return $this->create_response(true, 'ok', $request->all());

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update([
                "name" => $request->name,
                "email" => $request->email,
                "mobile" => $request->mobile,
                "country_id" => $request->country_id,
                "role" => $request->role,
            ]);
            return $this->create_response(true, 'ok', $user);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return $this->create_response(true, 'ok', $user, 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 404);
        }


    }
}
