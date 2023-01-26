<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function age()
    {
        return $this->belongsTo(AttributeValue::class, 'age_id');
    }


    public function country()
    {
        return $this->belongsTo(AttributeValue::class, 'country_id');
    }


    public function genre()
    {
        return $this->belongsTo(AttributeValue::class, 'genre_id');
    }

    public function language()
    {
        return $this->belongsTo(AttributeValue::class, 'language_id');
    }


    public function images()
    {
        return $this->hasMany(ProductImage::class)
            ->orderBy('id');
    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_value')
            ->orderByPivot('sort_order');
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_product')
            ->orderBy('id', 'desc');
    }

    public function isNew()
    {
        if ($this->created_at >= Carbon::now()->subMonth()->toDateTimeString()) {
            return true;
        } else {
            return false;
        }
    }

    public function getFullName()
    {
        if (app()->getLocale() == 'en') {
            return $this->full_name_en ?: $this->full_name_tm;
        } elseif (app()->getLocale() == 'ru') {
            return $this->full_name_ru ?: $this->full_name_tm;
        } else {
            return $this->full_name_tm;
        }
    }

    public function getName()
    {
        if (app()->getLocale() == 'en') {
            return $this->name_en ?: $this->name_tm;
        } elseif (app()->getLocale() == 'ru') {
            return $this->name_ru ?: $this->name_tm;
        } else {
            return $this->name_tm;
        }
    }
}
