<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
    ];

    public function sales()
    {
        return $this -> hasMany(sales::class);
    }

    public function companies()
    {
        return $this -> belongsTo(companies::class);
    }
}
