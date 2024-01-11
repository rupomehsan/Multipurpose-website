<?php

namespace Modules\HotelBooking\Entities;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Room extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ["name","room_type_id","base_cost","share_value","description"];
    protected $with = ["room_types","room_image"];
    protected $translatable = ['name','description'];

    public function room_types(){
        return $this->belongsTo(RoomType::class,"room_type_id","id");
    }


    public function room_image(){
        return $this->hasMany(RoomImage::class,"room_id","id");
    }

    public function room_inventory(){
        return $this->hasMany(RoomInventory::class,"room_id","id");
    }

    public function reviews(){
        return $this->hasMany(HotelReview::class,"room_id","id");
    }
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('ratting');
    }

    public function reviewCount()
    {
        return $this->reviews()->count();
    }

    public function inventory()
    {
        return $this->hasManyThrough(Inventory::class, RoomInventory::class,"room_id","id","id","inventory_id");
    }

}
