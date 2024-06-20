<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public function icon()
    {
        if ($this->title == 'Администратор')
            return 'fas fa-user-shield';
        else if ($this->title == 'Научный руководитель')
            return 'fas fa-user-tie';
        else
            return 'fas fa-user-graduate';
    }
}
