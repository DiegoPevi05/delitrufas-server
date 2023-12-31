<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecoverPassword;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Use the correct view path
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ], [
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe tener un formato válido.',
            'email.exists' => 'El correo electrónico proporcionado no existe.',
            'password.required' => 'El campo contraseña es obligatorio.',
        ]);


        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return redirect()->route('login')->withInput($request->only('email'))->with('logError','No se ha podido ingresar correctamente');
    }

    public function showRecoverPasswordForm()
    {
        return view('auth.password'); // Use the correct view path
    }

    public function recoverPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe tener un formato válido.',
            'email.exists' => 'El correo electrónico proporcionado no existe.'
        ]);

        $user = User::where('email',$request->input('email'))->first();

        // Check if a token was created within the last 15 minutes
        $currentTime = time();
        $lastTokenCreationTime = $user->recover_token_time ?? 0; // Change 'last_token_creation' to your user model's field
        $timeDiff = $currentTime - $lastTokenCreationTime;

        if ($timeDiff < 900) { // 900 seconds = 15 minutes
            return redirect()->route('recover-password')->with('logError', 'Debes esperar 15 minutos antes de solicitar otro token.');
        }

        $new_password = Str::random(16);

        try{
            $recoverPassword =  new RecoverPassword($user->name, $new_password);
            Mail::to($user->email)->send($recoverPassword);
        }catch (\Exception $e){
            return redirect()->route('recover-password')->with('logError', 'Hubo un error enviando el correo, intenta en un rato.');
        }

        $user->recover_token_time = $currentTime;
        $user->password =  bcrypt($new_password);
        $user->save();

        return redirect()->route('recover-password')->with('logSuccess', 'Se ha enviado el correo exitosamente');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
