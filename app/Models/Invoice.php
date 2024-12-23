<?php

namespace App\Models;

use App\Models\User;
use App\Models\Status;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_date',
        'due_date',
        'company_name',
        'company_address_line_1',
        'company_address_line_2',
        'company_city',
        'company_county',
        'company_postcode',
        'company_vat_number',
        'client_name',
        'client_address_line_1',
        'client_address_line_2',
        'client_city',
        'client_county',
        'client_postcode',
        'sub_total',
        'vat_percentage',
        'total',
        'note',
        'status',
        'user_id'
    ];

    /**
     * Get the user that created this invoice.
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the status of this invoice.
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'status');
    }

    /**
     * Get the products for this invoice.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
