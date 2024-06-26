<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $table = 'user_roles';

    protected $primaryKey = 'id_role';

    protected $fillable = [
        'typeOfRole',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_role');
    }
}


