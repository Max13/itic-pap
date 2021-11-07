<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Retrieve the user for the given ID.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        // Fake login
        if ($request->username == $request->password) {
            return [
                'id' => random_int(1, 10),
                'username' => $request->username,
                'firstname' => ucfirst($request->username),
                'lastname' => strtoupper($request->username),
                'current_points' => random_int(0, 12),
                'max_points' => 12,
            ];
        }

        return response('Invalid credentials', 401);
    }
}
