<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email'=> 'required|email|unique:users',
            'password' => 'required|min:6|max:20'
        ]);
        
        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        $to_name = $request->name;
        $to_email = $request->email;
        $body="<a href=''>Cliquez ici pour confirmer</a>";

        Mail::send('email.mail', $data = [
            'name' => $to_name,
            'body' => $body
        ],
        function($message) use ($to_name, $to_email){
            $message->to($to_email, $to_name)->subject('Courriel test laravel');
        }
        );

        return redirect()->back()->withSuccess(trans('lang.msg_1'));

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function authentication(Request $request){
        $request->validate([
            'email'=> 'required|email|exists:users',
            'password' => 'required|min:6|max:20'
        ]);

        $credentials = $request->only('email', 'password');

        if(!Auth::validate($credentials)):
            return redirect(route('login'))
                      ->withErrors(trans('auth.failed'))
                      ->withInput();
         endif;

         $user = Auth::getProvider()->retrieveByCredentials($credentials);
     
         Auth::login($user, $request->get('remember'));

         return redirect()->intended('dashboard')->withSuccess('Signed in');
    }

    public function dashboard(){

        
        if(Auth::check()){
           return view('dashboard'); 
        }
        return redirect(route('login'))->withErrors('Vous n\'êtes pas autorisé à accéder');
    }

    public function logout(){
        Session::flush();
        Auth::logout();

        return redirect(route('login'));
    }

    public function forgotPassword(){
        return view('auth.forgot-password');
    }

    public function tempPassword(Request $request){
        $request->validate([
            'email'=> 'required|email|exists:users',
        ]);

        $user = User::where('email', $request->email)->get();
        $user = $user[0];
        $tempPass = str::random(25);
        $user->temp_password = $tempPass;
        $user->save();
        $userId = $user->id;

        $link = "<a href='http://localhost:8000/new-password/".$userId."/".$tempPass."'>Cliquez ici pour réinitialiser votre mot de passe</a>";

        //http://localhost:8000/new-password/23/ORar0RQHfrzkoqWFSLSyXedrt
        //return $link;

        $to_email = $user->email;
        $to_name = $user->name;

        Mail::send('email.mail', $data = [
            'name' => $to_name,
            'body' => $link
        ],
        function($message) use ($to_name, $to_email){
            $message->to($to_email, $to_name)->subject('Reset Password');
        }
        );
        return redirect()->back()->withSuccess('Check your email to change your password');







    }
    public function newPassword(User $user, $tempPassword){
        if ($user->temp_password === $tempPassword) {
            return view ('auth.new-password');
        }
        return redirect('forgot-password')->withErrors('Les identifiants ne correspondent pas');   
    }

    public function storeNewPassword(User $user, $tempPassword, Request $request){
        if ($user->temp_password === $tempPassword) {
            $request->validate([
                'password' => 'required|min:6|confirmed'
            ]);

            $user->temp_password = null;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect(route('login'))->withSuccess(trans('lang.msg_success'));
            //return redirect(route('login'))->withSuccess('mot de passe reinitialisé');

        }
        return redirect('forgot-password')->withErrors('Les identifiants ne correspondent pas');   
    }

}
