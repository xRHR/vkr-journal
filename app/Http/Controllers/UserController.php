<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Status;
use App\Models\UserMiscInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function selfRegisterForm()
    {
        return view('user.self-register', ['statuses' => Status::all()]);
    }
    public function selfRegister(Request $request)
    {
        $incomingFields = $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'patronymic' => 'max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|max:255|min:6|confirmed',
            'status' => 'required|exists:App\Models\Status,id'
        ], [
            'firstname.required' => 'Необходимо заполнить поле "Фамилия"',
            'lastname.required' => 'Необходимо заполнить поле "Имя"',

            'firstname.max' => 'Фамилия должна содержать не более 255 символов',
            'lastname.max' => 'Имя должно содержать не более 255 символов',
            'patronymic.max' => 'Отчество должно содержать не более 255 символов',

            'email.required' => 'Необходимо заполнить поле "Электронная почта"',
            'email.email' => 'Адрес электронной почты имеет некорректный формат',
            'email.unique' => 'Пользователь с таким адресом электронной почты уже существует',
            'email.max' => 'Адрес электронной почты должен содержать не более 255 символов',

            'password.min' => 'Пароль должен содержать не менее 6 символов',
            'password.required' => 'Необходимо заполнить поле "Пароль"',
            'password.confirmed' => 'Пароли не совпадают',
            'password.max' => 'Пароль должен содержать не более 255 символов',
            
            'status.required' => 'Необходимо выбрать статус пользователя',
            'status.exists' => 'Статус пользователя не существует',
        ]);

        $user = User::create([
            'firstname' => strip_tags($incomingFields['firstname']),
            'lastname' => strip_tags($incomingFields['lastname']),
            'patronymic' => strip_tags($incomingFields['patronymic']),
            'email' => strip_tags($incomingFields['email']),
            'password' => $incomingFields['password'],
            'status_id' => $incomingFields['status']
        ]);
        $user_misc_info = new UserMiscInfo();
        $user_misc_info->user_id = $user->id;

        $user->save();
        $user_misc_info->save();
        return redirect()->route('loginForm')->with('success', 'Вы успешно зарегистрировались. Вы можете войти в систему');
    }
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
        return view('user.edit-profile', ['user' => $user, 'groups' => \App\Models\Group::all()]);        
    }
    public function updateProfile(Request $request, User $user) {
        $incomingFields = $request->only([
            'firstname',
            'lastname',
            'patronymic',
            'firstname_genitive',
            'lastname_genitive',
            'patronymic_genitive',
            'group'
        ]);

        $user->firstname = strip_tags($incomingFields['firstname']);
        $user->lastname = strip_tags($incomingFields['lastname']);
        $user->patronymic = strip_tags($incomingFields['patronymic']);

        $user->miscInfo->firstname_genitive = strip_tags($incomingFields['firstname_genitive']);
        $user->miscInfo->lastname_genitive = strip_tags($incomingFields['lastname_genitive']);
        $user->miscInfo->patronymic_genitive = strip_tags($incomingFields['patronymic_genitive']);

        $user->miscInfo->group_id = $incomingFields['group'];

        $user->save();
        $user->miscInfo->save();

        return redirect()->route('profile', $user)->with('success', 'Профиль обновлен');
    }
}
