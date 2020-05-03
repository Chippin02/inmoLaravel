<?php

namespace App\Http\Controllers;

use App\Property;
use App\Property_types;
use App\User;
use Illuminate\Http\Request;

class PropertyController extends Controller {

    function __construct() {
        //$this->middleware('auth', ['role'=>'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (auth()->user()->hasRole('admin')) { $properties = Property::all(); }
        else { $properties = Property::all()->where('user_id', auth()->user()->id); }
        return view('properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $users = User::all();
        $email = User::all()->where('id', auth()->user()->id)->first();
        $types = Property_types::all();
        return view('properties.create', compact('users', 'email', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if (!is_null($request->file('photo'))) { $path = $request->file('photo')->store('photos', 'public'); }
        else { $path = null; }
        $owner_id = User::all()->where('email', $request->email)->first();
        $type = Property_types::all()->where('name', $request->type)->first();
        Property::create(['name'=>$request->name,
                            'description'=>$request->description,
                            'user_id'=>$owner_id->id,
                            'type'=>$type->id,
                            'city'=>$request->city,
                            'address'=>$request->address,
                            'm2'=>$request->m2,
                            'photo'=>$path
        ]);
        return redirect()->route('properties.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $property = Property::find($id);
        $type = Property_types::all()->where('id', $property->type)->first();
        $owner = User::all()->where('id', $property->user_id)->first();
        return view('properties.show', compact('property', 'type', 'owner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $property=Property::find($id);
        if (auth()->user()->hasRole('admin')) { $users=User::all(); }
        else { $users = User::all()->where('id', auth()->user()->id)->first(); }
        $types = Property_types::all();
        return view('properties.edit', compact('property', 'users', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        if (!is_null($request->file('photo'))) { $path = $request->file('photo')->store('photos', 'public'); }
        else {
            $img = Property::all()->where('id', $id)->first();
            $path = $img->photo;
        }
        $owner_id = User::all()->where('email', $request->email)->first();
        $type = Property_types::all()->where('name', $request->type)->first();
        $property=Property::find($id);
        $property->update(['name'=>$request->name,
                            'description'=>$request->description,
                            'city'=>$request->city,
                            'address'=>$request->address,
                            'user_id'=>$owner_id->id,
                            'type'=>$type->id,
                            'm2'=>$request->m2,
                            'photo'=>$path
        ]);
        return redirect()->route('properties.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $property = Property::find($id);
        $property->delete();
        return redirect()->route('properties.index');
    }

    public static function getType($typeID) {
        return Property_types::where('id', $typeID)->first()->name;
    }

    public static function getUserName($userID) {
        $name = User::where('id', $userID)->first()->name;
        $email = User::where('id', $userID)->first()->email;
        return $name.' ('.$email.')';
    }

    public static function getMail($userID) {
        return User::where('id', $userID)->first()->email;
    }

}
