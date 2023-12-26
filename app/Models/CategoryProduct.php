<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'page', 'description', 'title_category_description', 'category_description', 'image_json', 'parentid', 'image', 'meta_title', 'meta_description', 'userid_created', 'created_at', 'publish', 'alanguage', 'ishome', 'isaside', 'isfooter', 'highlight', 'icon', 'banner'

    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userid_created');
    }
    public function children()
    {
        return $this->hasMany(CategoryProduct::class, 'parentid');
    }
    public function countProduct()
    {
        return $this->hasMany(Catalogues_relationships::class, 'catalogueid', 'id')->where('module', '=', 'products');
    }
    public function posts()
    {
        return $this->hasMany(Catalogues_relationships::class, 'catalogueid')->where('catalogues_relationships.module', '=', 'products');
    }
    public function postsHome()
    {
        return $this->hasMany(Catalogues_relationships::class, 'catalogueid')->where('catalogues_relationships.module', '=', 'products')->limit(8);
    }
    public function brands_relationships()
    {
        return $this->hasMany(Brands_relationships::class, 'category_product_id')->select('category_product_id', 'brand_id')->groupBy('brand_id')->with('brands');
    }
    public function attributes_relationships()
    {
        return $this->hasMany(Attributes_relationships::class, 'category_product_id')->select('category_product_id', 'attribute_id')->groupBy('attribute_id')->with('attributes');
    }

    public function postmetas()
    {
        return $this->hasMany(ConfigPostmeta::class, 'module_id')->where(['module' => 'products'])->select('module_id', 'meta_key', 'meta_value');;
    }

    public function postProduct()
    {
        return $this->hasMany(Catalogues_relationships::class, 'catalogueid')
            ->join('products', 'products.id', '=', 'catalogues_relationships.moduleid')
            ->where(['products.publish' => 0, 'module' => 'products'])
            ->select('products.id', 'products.title',  'products.slug', 'products.description', 'products.image', 'products.price', 'products.price_sale', 'products.price_contact', 'catalogues_relationships.catalogueid')
            ->orderBy('products.order', 'asc')
            ->orderBy('products.id', 'desc');
    }



}
