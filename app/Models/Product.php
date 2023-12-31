<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Attribute;

class Product extends Model
{
    use HasFactory,SoftDeletes;
 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'category',
        'name',
        'description',
        'selling_price',
        'special_price',
        'status',
        'is_delivery_available',
        'image',
    ];

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}
