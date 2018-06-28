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
    public function updateProfile(Request $request)
    {
      $about = $request->input('about');
      $user_id = Auth::user()->id;
      DB::table('users')
            ->where('id', $user_id)
            ->update(['about' => $about]);
      return back();
    }
    public function findFriends()
    {
      $uid = Auth::user()->id;
        $allUsers = DB::table('users')->where('id','!=' ,$uid)->get();

        return view('profile.findFriends',compact('allUsers'));
    }
    public function sendRequest($id)
    {

      Auth::user()->addFriend($id);
      return back();
    }
    public function requests()
    {
      $uid = Auth::user()->id;

      $FriendRequests = DB::table('friendships')
                      ->rightJoin('users','users.id','=','friendships.requester')
                      ->where('status',NULL)
                      ->where('friendships.user_requested','=',$uid)->get();
      return view('profile.requests',compact('FriendRequests'));
    }
    public function accept($name,$id)
    {
      $uid = Auth::user()->id;
      $checkRequest = DB::table('friendships')->where('requester',$id)
                      ->where('user_requested',$uid)
                      ->first();
      if ($checkRequest) {
        $updateFriendship = DB::table('friendships')
            ->where('user_requested', $uid)
            ->where('requester',$id)
            ->update(['status' => 1]);

            if ($updateFriendship) {
              return back()->with('msg','You are now friends with '.$name);
            }

      }else {
        return back()->with('msg','Lamba Lolo');
      }
    }
    public function friends()
    {
      $uid = Auth::user()->id;

      //who send me requests
      $friends1 = DB::table('friendships')
                  ->leftJoin('users','users.id','friendships.user_requested')
                  ->where('status',1)
                  ->where('requester',$uid)
                  ->get();

      //who I send requests to
      $friends2 = DB::table('friendships')
                  ->leftJoin('users','users.id','friendships.requester')
                  ->where('status',1)
                  ->where('user_requested',$uid)
                  ->get();
      $friends = array_merge($friends1->toArray(),$friends2->toArray());


      return view('profile.friends',compact('friends'));
    }

    public function requestRemove($id)
    {
      DB::table('friendships')
          ->where('user_requested',Auth::user()->id)
          ->where('requester',$id)
          ->delete();
      return back()->with('msg','Request cancelled');
    }
}
