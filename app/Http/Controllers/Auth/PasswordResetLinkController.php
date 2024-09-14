<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPassword;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\Mail;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'email' => 'required|email',
        ]);

        // Busca al usuario
        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => [trans('No se encontró un usuario con este correo.')],
            ]);
        }

        // Genera un token de restablecimiento


        // Envía la notificación personalizada
        Mail::to($user->email)->send(new ResetPassword($user));

        return back()->with('status', __('Se ha enviado el enlace de restablecimiento de contraseña.'));
    }
}
