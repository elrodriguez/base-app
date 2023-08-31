<?php

namespace Modules\Security\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Routing\Controller;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Security::Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {  
        
        $content = $request->getContent();
        // Separar las partes utilizando el delimitador
        $parts = explode("-----------------------------", $content);
    
        // Recorrer las partes para encontrar la sección de la imagen
        foreach ($parts as $part) {
            if (strpos($part, 'Content-Disposition: form-data; name="avatar"') !== false) {
                // Encontrada la sección de la imagen
                
                // Obtener el nombre de archivo
                $fileName = '';
                if (preg_match('/filename="([^"]+)"/', $part, $matches)) {
                    $fileName = $matches[1];
                }
    
                // Obtener el contenido de la imagen
                $imageContent = substr($part, strpos($part, "\r\n\r\n") + 4, -2);
                $random = rand(0, 99999);
                $fileName = 'storage/users/avatars/'.$random.$fileName;
                file_put_contents($fileName, $imageContent);
        ///////////////////////////////////////////////////
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        
        $path = $fileName;
        $request->user()->avatar = $path;
        
        $request->user()->save();

        return Redirect::route('profile.edit');
    }
}}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
