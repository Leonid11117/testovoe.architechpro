<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string email
 * @property int global_settings
 * @property string status
 */
class Moderator extends Model
{
    use HasFactory;

    protected $table = 'moderators';

    protected $fillable = [
        'name',
        'email',
        'global_settings',
        'status'
    ];

    protected $casts = [
        self::UPDATED_AT => 'datetime:Y-m-d H:i:s',
        self::CREATED_AT => 'datetime:Y-m-d H:i:s',
    ];
}
