<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;

class subscriptions extends Model
{
    use HasFactory;

    /**
     * The table is assigned
     *
     * @var array
     */
    protected $table = "subscriptions";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'product_id',
        'initial_date',
        'final_date',
    ];

    public function sendMessage($date)
    {
        $date = Carbon::now();
    } 

    public function client()
    {
        return $this->belongsTo(Clients::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
