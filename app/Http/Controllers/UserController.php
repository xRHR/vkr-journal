<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function loginForm() {
        if (auth()->check()) {
            return redirect()->route('redirect.homepage');
        }
        return view('user.login');
    }
    
    public function login(Request $request) {
        $incomingFields = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (!auth()->attempt([
            'email' => $incomingFields['email'],
            'password' => $incomingFields['password']
        ])) {
            return redirect()->back()->with('failure', 'Неверный логин или пароль');
        }
        $request->session()->regenerate();
        return redirect()->route('redirect.homepage')->with('success', 'Вы вошли в систему');
    }
    public function logout(Request $request) {
        auth()->logout();
        return redirect()->route('login')->with('success', 'Вы вышли из системы');
    }
    public function userProfile(User $user) {
        return view('user.profile', ['user' => $user]);
    }
    public function editProfile(User $user) {
        return view('user.edit-profile', ['user' => $user]);        
    }
    public function updateProfile(Request $request, User $user) {
        $incomingFields = $request->only([
            'firstname',
            'lastname',
            'patronymic',
            'firstname_genitive',
            'lastname_genitive',
            'patronymic_genitive'
        ]);

        $user->firstname = strip_tags($incomingFields['firstname']);
        $user->lastname = strip_tags($incomingFields['lastname']);
        $user->patronymic = strip_tags($incomingFields['patronymic']);

        $user->miscInfo->firstname_genitive = strip_tags($incomingFields['firstname_genitive']);
        $user->miscInfo->lastname_genitive = strip_tags($incomingFields['lastname_genitive']);
        $user->miscInfo->patronymic_genitive = strip_tags($incomingFields['patronymic_genitive']);

        $user->save();
        $user->miscInfo->save();

        return redirect()->route('profile', $user)->with('success', 'Профиль обновлен');
    }
}
