<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPosition;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:25'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['required']
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $user = $this->create($request->all());

                UserPosition::create([
                    'user_id' => $user->id,
                    'status' => 'active',
                    'position' => 'User'
                ]);

                DB::commit();
                return redirect('login')->with('success', "You've succesfully register");
            } catch (\Exception $e) {
                DB::rollBack();
                dd($e);
            }
        } else {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    }


    public function showRegistrationForm()
    {
        return view('register');
    }
}
