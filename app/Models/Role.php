<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $fillable = ['nama', 'kode'];

    public function userRole()
    {
        return $this->hasMany(UserRole::class, 'role_id', 'id');
    }
}
