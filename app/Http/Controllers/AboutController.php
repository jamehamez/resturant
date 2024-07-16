<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    function index(){
        $address = "23 กรุงเทพ , ประเทศไทย";
        $tel = "095-6606589";
        $email = "Jameskhim19@gmail.com";
        // return view('about',['address'=>$address,'tel'=>$tel,'email'=>$email]);
        // return view('about',compact('address','tel','email')); //function compact
        return view('about')   //function with
        ->with('address',$address)
        ->with('tel',$tel)
        ->with('email',$email);
    }
    function showData(){
        echo "Hello Laravel8";
    }
}
