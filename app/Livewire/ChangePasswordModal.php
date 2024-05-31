<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use App\Models\User;
use Hash;

class ChangePasswordModal extends ModalComponent
{
    public $user;

    public $old_password;

    public $password;

    public $password_confirmation;

    public function mount($user_id)
    {
        $this->user = User::find($user_id);
    }

    public function render()
    {
        return view('livewire.change-password-modal');
    }

    public function changePassword()
    {
        if (auth()->user()->status->title == 'Администратор') {
            $this->validate([
                'password' => [
                    'required',
                    'min:1',
                    'confirmed',
                ]
            ], [
                'password.required' => 'Ввод нового пароля обязателен',
                'password.min' => 'Новый пароль должен содержать не менее 1 символа',
                'password.confirmed' => 'Пароли не совпадают',
            ]);
        } else {
            $this->validate([
                'old_password' => [
                    'required', function ($attribute, $value, $fail) {
                        if (!Hash::check($value, $this->user->password)) {
                            $fail('Вы неверно ввели старый пароль');
                        }
                    },
                ],
                'password' => [
                    'required',
                    'min:6',
                    'confirmed',
                ]
            ], [
                'old_password.required' => 'Ввод старого пароля обязателен',
                'password.required' => 'Ввод нового пароля обязателен',
                'password.min' => 'Новый пароль должен содержать не менее 6 символов',
                'password.confirmed' => 'Пароли не совпадают',
            ]);
        }

        $this->user->update(['password' => $this->password]);

        $this->closeModal();
    }
}
