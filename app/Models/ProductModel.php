<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $table = 'products';
    protected $fillable = [
        'id',
        'title',
        'price',
        'create_at',
        'update_at',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryModel::class);
    }

}
