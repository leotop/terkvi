<?php namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PageController extends Controller {

    public function index()
    {
        if (Auth::check()) return redirect('dashboard');
        return view('index');
    }

}
