<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('created_at')->get();
        return view('dashboard', compact('users'));
    }

    public function editProfile(Request $request)
    {
        $user = Auth::user();
        try {
            DB::beginTransaction();
            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            $user->position->update([
                'status' => $request->status,
                'position' => $request->position
            ]);

            if (!is_null($request->password)) {
                $user->update([
                    'password' => bcrypt($request->password)
                ]);
            }
            DB::commit();
            return redirect()->back()->with('success', 'Data has been updated');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }
}
