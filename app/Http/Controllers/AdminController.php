<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Status;
use Illuminate\Support\Str;
use App\Models\UserMiscInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function registerForm(Request $request)
    {
        if ($request->user()->status->title == 'Администратор') {
            return view('user.register', ['statuses' => Status::all()]);
        } else if ($request->user()->status->title == 'Научный руководитель') {
            return view('user.register', ['statuses' => Status::where('title', 'Студент')->get()]);
        }
    }

    public function registerUsers(Request $request)
    {
        $new_users_table = json_decode($request->array, true);
        if (empty($new_users_table)) {
            return response()->json(['success' => false, 'message' => 'Вы не добавили ни одного пользователя'], 400);
        }
        $already_exist = [];
        foreach ($new_users_table as $new_user) {
            $pwd = Str::random(12);
            $file = 'E:\laravel\пароли.txt';
            $data = $new_user['email'] . ' ' . $pwd;
            file_put_contents($file, $data . PHP_EOL, FILE_APPEND);

            $user = new User();
            $user_misc_info = new UserMiscInfo();

            $user->email = $new_user['email'];
            $user->password = $pwd;
            if (auth()->user()->status->title == 'Научный руководитель') {
                $user->status_id = Status::where('title', 'Студент')->first()->id;
                $user->professor_id = auth()->user()->id;
            } else {
                $user->status_id = $new_user['status'];
            }
            try {
                $user->save();
            } catch (\Illuminate\Database\UniqueConstraintViolationException $e) {
                $already_exist[] = $new_user['email'];
                continue;
            }

            $user_misc_info->user_id = $user->id;
            $user_misc_info->save();
        }
        if (count($already_exist) == 0) {
            return response()->json(['success' => true], 200);
        } else if (count($already_exist) == 1) {
            return response()->json(['success'=> false, 'message' => 'Пользователь c email <i>' . $already_exist[0] . '</i> уже зарегистрирован'], 400);
        } else {
            return response()->json(['success'=> false, 'message' => 'Пользователи со следующими email: <i>' . implode(', ', $already_exist) . '</i> уже зарегистрированы'],400);
        }
    }

    public function getUsers(Request $request)
    {
        $users = User::all();
        return view('user.user-list', ['users' => $users]);
    }
}
