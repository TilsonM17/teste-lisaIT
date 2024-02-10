<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TaskStatusEnums;

class Task extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'title',
        'description'
    ];

    protected $casts = [
        'status' => TaskStatusEnums::class
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
