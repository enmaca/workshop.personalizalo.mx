<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends BaseModel
{
    use HasFactory;

    protected $table = 'catalog_products';
    protected $primaryKey = 'id';

    public function digital_category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->BelongsTo(DigitalArtCategory::class, 'digital_art_category_id', 'id');
    }

    public function mfg_costs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ManufacturingCost::class, 'catalog_product_id', 'id');
    }

    public function taxes(): \Illuminate\Database\Eloquent\Relations\belongsToMany
    {
        return $this->belongsToMany(Tax::class, 'taxes_details', 'reference_id', 'catalog_taxes_id')
            ->wherePivot('reference_type', 'catalog_products');
    }

    public static function ProcessMfgMaterialVariationsGroupCosts($id): array {
        $d2r_variations = [];
        $d2r_variations_ids = [];
        $d2r_relations['color'] = [];
        $d2r_relations['size'] = [];
        $_data = MaterialVariationsGroup::with('items')->findOrFail($id);

        // TODO Build with variation group type enum switch
        foreach( $_data->items as $material ){

            $_material_data = Material::findOrFail($material->catalog_material_id);


            if(!empty($_material_data->opt_color)){
                $d2r_variations_ids['color'] = $_material_data->hashId;
                $d2r_variations['color'][$_material_data->opt_color] = true;
            }

            if(!empty($_material_data->opt_size)){
                $d2r_variations_ids['size'] = $_material_data->hashId;
                $d2r_variations['size'][$_material_data->opt_size] = true;
            }

            if( !empty($_material_data->opt_size) && !empty($_material_data->opt_color)){
                if( !array_key_exists($_material_data->opt_color, $d2r_relations['color'] ))
                    $d2r_relations['color'][$_material_data->opt_color] = [];

                if( !array_key_exists($_material_data->opt_size, $d2r_relations['size'] ))
                    $d2r_relations['size'][$_material_data->opt_size] = [];

                $d2r_relations['size'][$_material_data->opt_size][$_material_data->opt_color] = $_material_data->invt_quantity;
                $d2r_relations['color'][$_material_data->opt_color][$_material_data->opt_size] = $_material_data->invt_quantity;
            }
        }

        return [
            'hashId' => $_data->hashId,
            'variations' => [
                'color' => array_keys($d2r_variations['color']),
                'size' => array_keys($d2r_variations['size'])
            ],
            'variations_ids' => $d2r_variations_ids,
            'allowed_variations' => $d2r_relations
        ];

    }

    public static function ProcessMfgPrintVariationGroupCosts($id): array {

        $_data = PrintVariationsGroup::with('items')->findOrFail($id);
        $data2return =[
            'hashId' => $_data->hashId,
            'name' => $_data->name,
            'mockup_id' => $_data->mockup_id,
            'name' => $_data->name,
            'mockup_id' => $_data->mockup_id,
            'items' => []
        ];
        foreach( $_data->items as $print )
            $data2return['items'][] = [
                'hashId' => $print->hashId,
                'display_name' => $print->display_name,
                'preview_path' => $print->preview_path,
                'mockup_layer_id' => $print->mockup_layer_id,
                'variation_metadata' => json_decode($print['variation_metadata']),
                'price' => $print->price,
                'taxes' => $print->taxes
            ];

        return $data2return;
    }
}
