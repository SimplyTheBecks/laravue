<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Employee
 * @package App\Models
 * @property int id
 * @property string surname
 * @property string name
 * @property string patronymic
 * @mixin Builder
 */
class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'surname',
        'name',
        'patronymic',
    ];

    protected $visible = [
        'id',
        'surname',
        'name',
        'patronymic',
    ];
}
