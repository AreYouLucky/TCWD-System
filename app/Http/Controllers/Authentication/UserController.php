<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\BadgeEarned;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginHistory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            'img' => ['required','string'],
            'username' => ['required', 'string', 'unique:users,username'],
            'password' => 'required|confirmed|min:4',
            'region' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'fname' => 'required|string|max:255',
            'school' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $request->fname,
            'password' => Hash::make($request->password),
            'school_name' => $request->school,
            'region' => $request->region,
            'province' => $request->province,
            'city' => $request->city,
            'username' => $request->username,
            'img' => $request->img,
            'role' => 'PARTICIPANTS'
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            LoginHistory::create([
                'user_id' => Auth::user()->user_id
            ]);
            return Auth::user();
        }
    }
    
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if(Storage::exists('public/avatars/' .$user->img)) {
            Storage::delete('public/avatars/' . $user->img);
        }

        User::destroy($id);
        
        return response()->json([
            'status' => 'Account Successfully Deleted'
        ]);
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            LoginHistory::create([
                'user_id' => Auth::user()->user_id
            ]);
            return Auth::user();
        }
        return response()->json([
            'errors' => [
                'logs' => 'Invalid Credentials!',
            ]
        ], 422);
    }

    public function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect('/');
    }

    public function currentUser(){
        return DB::table('users')
        ->select(
            'users.user_id',
            'users.name',
            'users.username',
            'users.img',
            'users.role',
            'users.school_name',
            'table_region.region_name',
            'table_province.province_name',
            'table_municipality.municipality_name',
        )
        ->leftJoin('table_region', 'table_region.region_id', '=', 'users.region')
        ->leftJoin('table_province', 'table_province.province_id', '=', 'users.province')
        ->leftJoin('table_municipality', 'table_municipality.municipality_id', '=', 'users.city')
        ->where('users.user_id',Auth::user()->user_id)
        ->first();
    }

    public function userStatus(){
     return Auth::user();
    }
    public function earnedBadges(){
        return BadgeEarned::select('badge_earned.img','badges.description')->leftJoin('badges','badges.badge_id','badge_earned.badge_id')->where('badge_earned.user_id',Auth::id())->get();
    }
}
