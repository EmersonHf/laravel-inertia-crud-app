<?php

namespace App\Http\Controllers;

use App\Models\User;
use Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Redirect;
use Inertia\Inertia;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        return Inertia::render('Users/Index',[
            'users' => User::all()
        ]);
        
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = Request::validate([
            'name' => 'required',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users'
        ], [
            'name.required' => 'Name field is required.',
            'password.required' => 'Password field is required.',
            'email.required' => 'Email field is required.',
            'email.email' => 'Email field must be email address.'
        ]);

    $validatedData['password'] = bcrypt($validatedData['password']);
    $user = User::create($validatedData);



        
       

        return \Redirect::route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return Inertia::render('Users/Edit',[
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
     $user->update([
        'name' => Request::input('name'),
        'email' => Request::input('email'),
        'password' => Request::input('password')
     ]);
     return \Redirect::route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        
        
    
        if ($user->delete()) {
    
            return \Redirect::route('dashboard')->with('global', 'Your account has been deleted!');
       }
        return \Redirect::route('users.index');

        
        $user = \User::find(Auth::user()->id);

        Auth::logout();


    }
}
