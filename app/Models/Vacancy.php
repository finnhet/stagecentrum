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
        'field_id',
    ];

    public function filters()
    {
        return $this->belongsToMany(Filter::class, 'vacancy_filters', 'vacancy_id', 'filter_id');
    }
      
}
