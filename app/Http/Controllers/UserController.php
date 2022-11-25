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
            'email' => 'required|email|unique:users',
            // 'cpf' => 'required|unique:users',
            'password' => 'required|min:6'
           
        ], [
            'name.required' => 'O campo Nome é obrigatório.',
            'password.required' => 'O campo Senha é obrigatório.',
            'email.required' => 'O campo Email é obrigatório.',
            // 'cpf.required' => 'Campo CPF é obrigatório.',
            'email.email' => 'O campo Email deve ser um endereço de email. ex: exemplo@email.com'
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
        $validatedData = Request::validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            // 'cpf' => 'required|unique:users',
            'password' => 'required|min:6'
           
        ], [
            'name.required' => 'O campo Nome é obrigatório.',
            'password.required' => 'O campo Senha é obrigatório.',
            'email.required' => 'O campo Email é obrigatório.',
            // 'cpf.required' => 'Campo CPF é obrigatório.',
            'email.email' => 'O campo Email deve ser um endereço de email. ex: exemplo@email.com'
        ]);

     $user->update([
        'name' => Request::input('name'),
        'email' => Request::input('email'),
        // 'cpf' => Request::input('cpf'),
        'password' => Request::input('password')
        
     ]);
     $validatedData['password'] = bcrypt($validatedData['password']);

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


        if ($user == [\Auth::user()]) {
            $user = \User::find(Auth::user()->id);
            $user->delete();
     
            return \Redirect::route('register')->with('global', 'Your account has been deleted!');
            Auth::logout();
       }else
        $user->delete();
        return \Redirect::route('users.index')->with('global', 'the account has been deleted!');

        
        

      


    }
}
