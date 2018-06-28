<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProfileController extends Controller
{
    public function index($slug)
    {
      return view('profile.index')->with('data',Auth::user()->profile);
    }
    public function uploadPhoto(Request $request)
    {
      $file = $request->file('pic');
      $filename = $file->getClientOriginalName();

      $path = 'img';

      $file->move($path,$filename);
      $user_id = Auth::user()->id;
      DB::table('users')
            ->where('id', $user_id)
            ->update(['pic' => $filename]);

      return back();
    }
    public function editProfileForm()
    {
          return view('profile.editProfile')->with('data',Auth::user()->profile);

    }
}
