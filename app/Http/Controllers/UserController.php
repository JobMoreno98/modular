<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function perfil(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('Doctor.perfil',compact('user'));
    }
}
