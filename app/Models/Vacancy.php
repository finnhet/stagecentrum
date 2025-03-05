<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'title',
        'introduction',
        'description',
        'location',
        'company_id',
    ];
}
