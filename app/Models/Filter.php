<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'field_id'];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function vacancies()
    {
        return $this->belongsToMany(Vacancy::class, 'vacancy_filters', 'filter_id', 'vacancy_id');
    }
}
