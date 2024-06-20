<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function registerForm($chosen_status = null)
    {
        return view('user.register', compact('chosen_status'));
    }
    public function register(Request $request)
    {
        if (auth()->user()->status->title == 'Администратор') {
            return $this->adminRegister($request);
        } else {
            return $this->professorRegister($request);
        }
    }
    protected function adminRegister(Request $request)
    {
        $incomingFields = $request->validate([
            'email' => 'required|email|unique:users',
            'status' => 'required',
            'password' => '',
            'group' => '',
        ],[
            'status.required' => 'Необходимо указать статус пользователя',
            'email.required' => 'Необходимо указать почту',
            'email.email' => 'Некорректная почта',
            'email.unique' => 'Пользователь с такой почтой уже существует',
        ]);
        if ($incomingFields['password'] == '') {
            $pwd = Str::random(12);
            $file = '/var/www/vkr-journal/passwords';
            $data = $incomingFields['email'] . ' ' . $pwd;
            file_put_contents($file, $data . PHP_EOL, FILE_APPEND);
        } else {
            $pwd = $incomingFields['password'];
        }
        
        $user = \App\Models\User::create([
            'email' => $incomingFields['email'],
            'password' => $pwd,
            'status_id' => $incomingFields['status'],
        ]);

        $user->save();
        $user_misc_info = new \App\Models\UserMiscInfo();
        $user_misc_info->user_id = $user->id;

        if ($user->status->title == 'Студент') {
            if ($incomingFields['group'] == '') {
                $errors = ['group' => 'Необходимо указать группу студента'];
                return redirect()->back()->withErrors($errors)->withInput();
            } else {
                $user_misc_info->group_id = $incomingFields['group'];
            }
        }
        $user_misc_info->save();

        return redirect()->back()->with('success', 'Регистрация прошла успешно');
    }
    protected function professorRegister(Request $request)
    {
        $incomingFields = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => '',
            'group' => 'required',
        ],[
            'group.required' => 'Необходимо указать группу',
            'email.required' => 'Необходимо указать почту',
            'email.email' => 'Некорректная почта',
            'email.unique' => 'Пользователь с такой почтой уже существует',
        ]);

        if ($incomingFields['password'] == '') {
            $pwd = \Str::random(12);
            $file = '/var/www/vkr-journal/passwords';
            $data = $incomingFields['email'] . ' ' . $pwd;
            file_put_contents($file, $data . PHP_EOL, FILE_APPEND);
        } else {
            $pwd = $incomingFields['password'];
        }
        $user = \App\Models\User::create([
            'email' => $incomingFields['email'],
            'password' => $pwd,
            'status_id' => \App\Models\Status::where('title', 'Студент')->first()->id,
            'professor_id' => auth()->user()->id,
        ]);
        $user_misc_info = new \App\Models\UserMiscInfo();

        $user_misc_info->user_id = $user->id;
        $user_misc_info->group_id = $incomingFields['group'];
        $user_misc_info->save();

        return redirect()->back()->with('success', 'Регистрация прошла успешно');
    }
}
