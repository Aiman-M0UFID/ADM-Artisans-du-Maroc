<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Front\Admin\Categorie;
use App\Models\Front\Artisan\Service;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::all();
        $services = Service::all();
        $users = User::all();

        // dd($categories);
        return view('Front.home',compact('categories','services','users'));
    }

    public function search_services(Request $request)
  {

    $categories = Categorie::all();

    $ville = $request->input('ville');
    $categorie = $request->input('categorie');

    if(empty($ville)){
      $users = User::all();
    }else{
      $users = User::where('ville',$ville)->get();
    }
    
    if(empty($categorie)){
      $services = Service::all();
    }else{
      $services = Service::where('categorie_id',$categorie)->get();
    }

      /* Do something with data */
    
    

    //  dd($users);

     return view('Front.home',compact('categories','services','users'));
  }
}
