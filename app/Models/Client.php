<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function employees() {
        return $this->hasMany(Employee::class, 'client_id', 'id');
    }

    public function getEmployee() {
        return $this->hasMany(Employee::class, 'client_id', 'id');
    }



}
