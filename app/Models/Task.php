<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['task', 'level', 'estimated_duration'];

    public function user() {
        return $this->hasOne(User::class, 'id', 'assigned_user_id');
    }

}
