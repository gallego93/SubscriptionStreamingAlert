<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Carbon\Carbon;

class Subscriptions extends Model
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
        'user_id',
        'initial_date',
        'final_date',
    ];

    /**
     * Scope a query to include search functionality.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithSearch($query, $search)
    {
        if ($search) {
            $query->where('client_id', 'like', '%' . $search . '%')
                ->orWhere('product_id', 'like', '%' . $search . '%')
                ->orWhere('initial_date', 'like', '%' . $search . '%')
                ->orWhere('final_date', 'like', '%' . $search . '%')
                ->orWhereHas('client', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('product', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
        }
        return $query;
    }

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
