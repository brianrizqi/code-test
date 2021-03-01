<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('created_at')->get();
        return api_response(1, 'Api', $users);
    }

    public function store(Request $request)
    {
        $user = $this->create($request->all());

        UserPosition::create([
            'user_id' => $user->id,
            'status' => 'active',
            'position' => 'User'
        ]);

        return api_response(1, 'User created successfully', $user);
    }

    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return api_response(1, 'User created successfully', $user);
        }
        return api_response(0, 'User not found', '', 404);
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        $user = User::find($id);
        if (!$user) {
            return api_response(0, 'User not found', '', 404);
        }
        $user->position->update([
            'status' => $request->status,
            'position' => $request->position
        ]);

        if (!is_null($request->password)) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
        }
        return api_response(1, 'User updated successfully', $user);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return api_response(0, 'User not found', '', 404);
        }
        $user->position->delete();
        $user->delete();
        return api_response(1, 'User deleted successfully');
    }
}
