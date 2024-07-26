<?php

namespace App\Models;

use App\Models\Katalog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'tbl_order';

    protected $guarded = [
        'id'
    ];

    /**
     * Get the user that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function katalog(): BelongsTo
    {
        return $this->belongsTo(Katalog::class, 'name', 'name_package');
    }
}
