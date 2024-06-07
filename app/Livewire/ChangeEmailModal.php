<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use App\Models\User;
use Hash;

class ChangeEmailModal extends ModalComponent
{
    public $user;

    public $password;

    public $email;

    public function render()
    {
        return view('livewire.change-email-modal');
    }
    
    public function mount($user_id)
    {
        $this->user = User::find($user_id);
    }

    public function changeEmail()
    {
        if (auth()->user()->status->title == 'Администратор') {
            $this->validate([
                'email' => [
                    'required',
                    'email',
                ]
            ], [
                'password.required' => 'Введите email',
                'password.email' => 'Некорректный формат email',
            ]);
        } else {
            $this->validate([
                'password' => [
                    'required', function ($attribute, $value, $fail) {
                        if (!Hash::check($value, $this->user->password)) {
                            $fail('Вы неверно ввели пароль');
                        }
                    },
                ],
                'email' => [
                    'required',
                    'email',
                ]
            ], [
                'password.required' => 'Ввод пароля обязателен',
                'email.required' => 'Введите email',
                'email.email' => 'Некорректный формат email',
            ]);
        }

        $this->user->update(['email' => $this->email]);

        $this->closeModal();

        $this->redirect(route('profile', $this->user));
    }
}
