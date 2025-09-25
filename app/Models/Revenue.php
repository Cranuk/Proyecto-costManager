<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;

    protected $table = 'revenues';
    
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
