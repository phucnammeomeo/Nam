<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags_relationship extends Model
{
    use HasFactory;
    public function article()
    {
        return $this->hasOne(Article::class, 'id', 'module_id');
    }
    public function products()
    {
        return $this->hasOne(Product::class, 'id', 'module_id');
    }
}
