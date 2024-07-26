<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Katalog extends Model
{
    use HasFactory;

    protected $table = 'tbl_katalog';

    protected $guarded=[
        'id'
    ];

    public function order(){
        return $this->hasMany(Order::class, 'name_package');
    }
}
