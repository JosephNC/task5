<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Creates a user
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
        ]);

        // Validate request
        if ($validator->fails()) {
            // Failed
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ]);
        }

        // Get or Create the user
        $email = $request->input('email');
        $user = User::firstOrCreate(compact('email'));

        // Response
        return response()->json([
            'success' => true,
            'id' => $user->id,
        ]);
    }
}
