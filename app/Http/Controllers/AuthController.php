<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Hash;
use App\Models\User;
use App\Models\Watched;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller

{

    public function show()
    {
        return view('login');
    }


    public function login(Request $request)
    {
        //Je valide et je recupere
        $request->validate([
            //email est obligatoire 
            'email' => 'required',
            //mtp est obligatoire
            'password' => 'required',
        ]);

        //on recupere que email et mtp
        $utilisateur = $request->only('email' ,'password');
        //vérifier si un utilisateur correspond à ces conditions
        if(Auth::attempt($utilisateur)){
            //j'ai crée un session email et je met email de user
            session()->put('email', Auth::user()->email);
            session()->put('user_role', Auth::user()->user_role);
            session()->put('name', Auth::user()->name);
            Session()->put('logged_in', true);
            return redirect()->intended('/')
            ->with('message', 'Signed in!');
        }
        //sinon on le redirige vers la page login
        return redirect('/login')->with('message', 'User not found');
    }

    public function signupsave(Request $request)
    {
        //Je valide et je recupere
        $request->validate([
            //nom est obligatoire
            'name' => 'required',
            //email est obligatoire ,format email et unique
            'email' => 'required|email|unique:users',
            //mdp min 6 caractere 
            'password' => 'required|min:6',
        ]);
        //je recupere tous 
        $data = $request->all();
        //j'envoie le data a function create
        $check = $this->create($data);

        return redirect('/login');
    }

    public function create(array $data)
    {
        //je crée utilisateur
        return User::create(
            [
                //dans column name j'ajoute name de formulaire
                'name' => $data['name'],
                //dans column email j'ajoute email de formulaire
                'email' => $data['email'],
                //dans column password et je hash password de formulaire
                'password' => Hash::make($data['password']),
            ]
            );
    }

    public function signout()
    {
        Session::flush();
        Auth::logout();

        return redirect('/login');
    }

    public function dashboard()
    {
    // Vérifiez si l'utilisateur est authentifié
    if (Auth::check()) {
        // Obtenez une liste pagination des anime regardés par l'utilisateur, avec les informations d'anime associées
        $watched = Watched::where('user_id', Auth::user()->id)
        ->join('anime', 'watched.anime_id', '=', 'anime.anime_id')
        ->paginate(18);
        // Renvoyez la vue du tableau de bord avec les données d'anime regardées
         return view('dashboard.dashboard' ,compact('watched'));
    }
    // Si l'utilisateur n'est pas authentifié, redirigez-les vers la page de connexion
    return redirect('/login');
    }
}