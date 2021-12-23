<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $table = 'categories';
    protected $fillable = [
        'id',
        'title',
        'description',
        'create_at',
        'update_at',
    ];

    public function product()
    {
        return $this->hasMany(productModel::class,'category_id');
    }
}
