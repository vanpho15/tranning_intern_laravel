<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'category_id',
        'name_kana',
        'alias',
        'content',
        'amount',
        'price',
        'image_link',
        'created_by',
        'updated_by',

    ];
    public function categories()
    {
        return $this->hasOne(Category::class, 'id', 'category_id')
            ->withDefault(['name' => '']);
    }
}
