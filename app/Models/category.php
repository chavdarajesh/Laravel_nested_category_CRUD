<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'parent_category_id',
        'created_at',
        'updated_at'
    ];

    public function childern()
    {
        return $this->hasMany(category::class,'parent_category_id');
    }
}
