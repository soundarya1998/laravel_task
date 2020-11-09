<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\login;

class AuthController extends Controller
{
    public function login(){
        return view('/login');
    }

    public function loginsubmit(Request $request){
        $uname=$request->get('username');
        $pass=$request->get('password');
        
        $records=login::select('*')
        ->where('username','=',$uname)
        ->where('password','=',$pass)
        ->get();
        $cnt=$records->count();
        if($cnt>0)
        { 
            
         foreach($records as $ses)
         {
             session(['uid'=>$ses->id]);
         }
         echo "<script>alert('Welcome')</script>";
         return redirect('index');
        }
        else{
          echo "<script>alert('Wrong')</script>";
          return redirect('/login');
        }
    }

    function logoutsubmit()
    {
      session(['uid'=>null]);
      return view('/login');
    }
}
