<?php

namespace App\Http\Controllers;

use App\Property;
use App\Property_types;
use App\Publication;
use App\Publication_Types;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $request->user()->authorizeRoles(['user', 'admin']);
        if(auth()->user()->hasRole('admin')) { $publications = Publication::all(); }
        else { $publications = Publication::all()->whereNotIn('publisher_id', auth()->user()->id); }
        return view('home', compact('publications'));
    }

    public static function getProperty($id) {
        return Property::all()->where('id', $id)->first();
    }

    public static function getPublicationType($id) {
        return Publication_Types::all()->where('id', $id)->first();
    }

    /*
    public function someAdminStuff(Request $request) {
        $request->user()->authorizaRoles('admin');
        return view('some.view');
    }
    */
}
