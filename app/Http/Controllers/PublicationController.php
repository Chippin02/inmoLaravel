<?php

namespace App\Http\Controllers;

use App\Property_types;
use App\User;
use App\Property;
use App\Publication;
use App\Publication_Types;

use Illuminate\Http\Request;

class PublicationController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (auth()->user()->hasRole('admin')) { $publications = Publication::all(); }
        else { $publications = Publication::all()->where('publisher_id', auth()->user()->id); }
        $types = Publication_Types::all();
        return view('publications.index', compact('publications', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if (auth()->user()->hasRole('admin')) { $properties = Property::all(); }
        else { $properties = Property::all()->where('user_id', auth()->user()->id); }
        $types = Publication_Types::all();
        return view('publications.create', compact('properties', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if (auth()->user()->hasRole('admin')) {
            $property = Property::all()->where('name', $request->property_id)->first();
            $property_id = $property->id;
            $user_id = $property->user_id;
        }
        else {
            $property = Property::all()->where('name', $request->property_id)->where('user_id', auth()->user()->id)->first();
            $property_id = $property->id;
            $user_id = auth()->user()->id;
        }
        $type = Publication_Types::all()->where('name', $request->type)->first();
        Publication::create(['publisher_id'=>$user_id,
                                'property_id'=>$property_id,
                                'pubTitle'=>$request->pubTitle,
                                'type'=>$type->id,
                                'price'=>$request->price]);
        return redirect()->route('publications.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $publication = Publication::find($id);
        $publication_type = Publication_Types::all()->where('id', $publication->type)->first();
        $property = Property::all()->where('id', $publication->property_id)->first();
        $property_type = Property_types::all()->where('id', $property->type)->first();
        $user = User::all()->where('id', $publication->publisher_id)->first();
        return view('publications.show', compact('publication', 'publication_type', 'property', 'property_type', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $publication = Publication::find($id);
        if (auth()->user()->hasRole('admin')) {
            $users = User::all();
            $properties = Property::all();
        }
        else {
            $users = User::all()->where('id', auth()->user()->id)->first();
            $properties = Property::all()->where('user_id',  auth()->user()->id);
        }
        $types = Publication_Types::all();
        return view('publications.edit', compact('publication', 'users', 'properties', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //De esta manera recogeremos el propietario de la vivienda y la id de la propiedad, así no tenemos que indicarlo y evitamos posibles errores
        $property = Property::all()->where('name', $request->property_id)->first();
        $type = Publication_Types::all()->where('name', $request->type)->first();
        $publication = Publication::find($id);
        $publication->update(['publisher_id'=>$property->user_id,
                                'property_id'=>$property->id,
                                'pubTitle'=>$request->pubTitle,
                                'type'=>$type->id,
                                'price'=>$request->price]);
        return redirect()->route('publications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $publication = Publication::find($id);
        $publication->delete();
        return redirect()->route('publications.index');
    }

    public static function getUserName($id) {
        $user = User::all()->where('id', $id)->first();
        return $user->name;
    }

    public static function getUserMail($id) {
        $user = User::all()->where('id', $id)->first();
        return $user->email;
    }

    public static function getProperty($id) {
        $type = Property::all()->where('id', $id)->first();
        return $type->name;
    }

    public static function getType($id) {
        $type = Publication_Types::all()->where('id', $id)->first();
        return $type->name;
    }
}
