<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends BaseModel
{
    use HasFactory;

    protected $table = 'catalog_materials';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'catalog_tax_id',
        'catalog_uom_id',
        'invt_minimum_stock',
        'is_consumable',
        'invt_quantity',
        'opt_color',
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'created_at',
        'deleted_at',
    ];

    public function opdd(){
        return $this->morphMany(OrderProductDynamicDetails::class, 'related');
    }

    public function unit_of_measure(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UnitOfMeasure::class, 'id', 'catalog_uom_id');
    }

    public function taxes(): \Illuminate\Database\Eloquent\Relations\belongsToMany
    {
        return $this->belongsToMany(Tax::class, 'taxes_details', 'reference_id', 'catalog_taxes_id')->wherePivot('reference_type', 'catalog_materials');
    }
}
