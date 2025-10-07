<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
        'typeCategory', // 1 = gasto, 2 = ingreso
        'color'
    ];

    public function expenses(){
        return $this->hasMany(Expense::class);
    }

    public function revenues(){
        return $this->hasMany(Revenue::class);
    }
}
