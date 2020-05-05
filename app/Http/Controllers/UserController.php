<?php

namespace App\Http\Controllers;

use App\Property;
use App\Publication;
use App\Role;
use App\Role_User;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $request->user()->authorizeRoles(['admin']);
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::find($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $user = User::find($id);
        $user->update(['name'=>$request->name,
                        'email'=>$request->email
        ]);
        $role_user_id = Role_User::all()->where('user_id', $id)->first();
        $role = Role::all()->where('description', $request->role)->first();
        $role_user = Role_User::find($role_user_id->id);
        $role_user->update(['role_id'=>$role->id]);
        if (strlen(trim($request->password)) >= 8) {
            $password = trim($request->password);
            $user->update(['password'=>Hash::make($password)]);
        }
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $user = User::find($id);
        $publications = Publication::all()->where('publisher_id', $id);
        $properties = Property::all()->where('user_id', $id);
        foreach ($publications as $publication) {
            if (!is_null($publication)) { $publication->delete(); }
        }
        foreach ($properties as $property) {
            if (!is_null($property)) { $property->delete(); }
        }
        $user->delete();
        return redirect()->route('users.index');
    }

    public static function getRole($id){
        $role_id = Role_User::all()->where('user_id', $id)->first();
        $role = Role::all()->where('id', $role_id->role_id)->first();
        return $role;
    }
}
