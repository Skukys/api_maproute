<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'password', 'email', 'role', 'api_token'];

    public function generateToken()
    {
        $token = Str::uuid();
        $this->api_token = $token;
        $this->save();
        return $token;
    }

    public function logout()
    {
        $this->api_token = null;
        $this->save();
    }
    use HasFactory;
}
