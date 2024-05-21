<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function showCorrectHomepage() {
        $success = false;
        $flash_msg = null;
        if (session('success')) {
            $success = true;
            $flash_msg = session('success');
        }
        if (session('failure')) {
            $flash_msg = session('failure');
        }
        if (!auth()->check()) {
            return redirect()->route('login')->with($success ? 'success' : 'failure', $flash_msg);
        }
        switch (auth()->user()->status->title) {
            case 'Администратор':
                return redirect()->route('admin.index')->with($success ? 'success' : 'failure', $flash_msg);
            case 'Студент':
                return redirect()->route('student.index')->with($success ? 'success' : 'failure', $flash_msg);
            case 'Научный руководитель':
                return redirect()->route('professor.index')->with($success ? 'success' : 'failure', $flash_msg);
        }
    }
}
