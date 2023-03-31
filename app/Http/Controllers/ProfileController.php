<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ProfileController extends Controller
{

   public function ProfileView(){
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('user.view_profile',compact('user'));
   }

   public function PasswordUpdate()
   {
      
   }
    
}
