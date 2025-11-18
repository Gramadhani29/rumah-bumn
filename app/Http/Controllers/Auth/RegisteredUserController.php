<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validationRules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:umkm,eksternal'],
        ];

        // If role is UMKM, business_name is required
        if ($request->role === 'umkm') {
            $validationRules['business_name'] = ['required', 'string', 'max:255'];
        }

        $request->validate($validationRules);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        // Add business_name only if role is UMKM
        if ($request->role === 'umkm') {
            $userData['business_name'] = $request->business_name;
        }

        $user = User::create($userData);

        event(new Registered($user));

        Auth::login($user);

        // Redirect based on role
        if ($user->isAdmin()) {
            return redirect(route('dashboard', absolute: false));
        } elseif ($user->isEksternal()) {
            return redirect(route('eksternal.dashboard', absolute: false))
                ->with('success', 'Pendaftaran berhasil! Selamat datang di Rumah BUMN.');
        } elseif ($user->isUmkm()) {
            return redirect(route('umkm.dashboard', absolute: false))
                ->with('success', 'Pendaftaran berhasil! Mulai jual produk Anda sekarang.');
        }

        // Default redirect to home page
        return redirect('/')->with('success', 'Pendaftaran berhasil! Selamat datang di Rumah BUMN.');
    }
}
