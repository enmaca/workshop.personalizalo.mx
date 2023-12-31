<?php

namespace App\Providers;

use Doctrine\DBAL\Exception;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     * @throws Exception
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            'catalog_materials' => \App\Models\Material::class,
            'catalog_products' => \App\Models\Product::class,
            'catalog_labor_costs' => \App\Models\LaborCost::class,
            'mfg_overhead' => \App\Models\MfgOverhead::class,
            'material_variations_group' => \App\Models\MaterialVariationsGroup::class,
            'print_variations_group' => \App\Models\PrintVariationsGroup::class,
            'order_product_dynamic' => \App\Models\OrderProductDynamic::class,
            'order_product_details' => \App\Models\OrderProductDetail::class
        ]);

        Blade::directive('hashid', function ($expression) {
            return "<?php echo \Vinkla\Hashids\Facades\Hashids::encode($expression); ?>";
        });

        // If you need a decode directive
        Blade::directive('dehashid', function ($expression) {
            return "<?php echo \Vinkla\Hashids\Facades\Hashids::decode($expression)[0]; ?>";
        });
    }

}
