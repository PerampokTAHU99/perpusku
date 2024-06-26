<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';
    
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'name', 'email', 'username', 'password', 'jenis_kelamin', 'kelas', 'id_role',
    ];

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'id_role');
    }
}

