<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'expenses';

    protected $fillable = [
        'category_id',
        'description',
        'amount',
        'created_at',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
