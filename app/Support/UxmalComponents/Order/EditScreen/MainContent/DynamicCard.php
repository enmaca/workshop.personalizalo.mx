<?php

namespace App\Support\UxmalComponents\Order\EditScreen\MainContent;

use App\Support\UxmalComponents\LaborCost\SelectByName as SelectByNameLaborCost;
use App\Support\UxmalComponents\Material\SelectByNameSkuDesc as SelectByNameSkuDescMaterial;
use App\Support\UxmalComponents\MfgOverHead\SelectByName as SelectByNameMfgOverHead;
use App\Support\UxmalComponents\OrderProductDynamicDetails\TbHandler\ProfitMargin as ProfitMarginTbHandler;
use Enmaca\LaravelUxmal\Abstract\CardBlock;
use Enmaca\LaravelUxmal\UxmalComponent;
use Exception;

class DynamicCard extends CardBlock
{

    /**
     * @throws Exception
     */
    public function build(): void
    {
        $this->BodyRow();

        $this->setBodyFieldRowClass('col-xxl-6 mb-3');

        $this->BodyInput(SelectByNameSkuDescMaterial::Object(['options' => ['event-change-handler' => 'onChangeSelectedMaterialByNameSkuDesc']]));

        $this->BodyInput(SelectByNameLaborCost::Object(['options' => ['event-change-handler' => 'onChangeSelectedLaborCostByName']]));

        $this->BodyInput(SelectByNameMfgOverHead::Object(['options' => ['event-change-handler' => 'onChangeSelectedMfgOverHeadByName']]));

        $table = $this->Footer()->addElementInRow(element: UxmalComponent::Make(type: 'ui.table', attributes: [
            'options' => [
                'table.name' => 'orderProductDynamicDetails',
                'table.columns' => [
                    'hashId' => [
                        'tbhContent' => 'hidden',
                        'type' => 'primaryKey'
                    ],
                    'related.name' => [
                        'tbhContent' => 'Material/Concepto',
                    ],
                    'quantity' => [
                        'tbhContent' => 'Cantidad',
                    ],
                    'cost' => [
                        'tbhContent' => 'Costo'
                    ],
                    'taxes' => [
                        'tbhContent' => 'Impuestos'
                    ],
                    'profit_margin' => [
                        'tbhContent' => 'Margen',
                        'handler' => ProfitMarginTbHandler::class
                    ],
                    'subtotal' => [
                        'tbhContent' => 'Subtotal'
                    ],
                    'createdby.name' => [
                        'tbhContent' => 'Creado'
                    ],
                    'actions' => [
                        'tbhContent' => null,
                        'buttons' => [
                            [
                                'button.type' => 'icon',
                                'button.style' => 'danger',
                                'button.onclick' => 'removeOPDD(this)',
                                'button.name' => 'deleteOPPD',
                                'button.remix-icon' => 'delete-bin-5-line'
                            ],
                        ]
                    ]
                ],
                'table.data.livewire' => 'order-product-dynamic-details.table.tbody',
                'table.data.livewire.append-data' => [
                    'values' => $this->attributes['values']
                ],
                'table.footer' => [
                    'related.name' => [
                        'html' => '<span class="justify-end">Totales</span>'
                    ],
                    'cost' => [
                        'operation' => 'sum'
                    ],
                    'taxes' => [
                        'operation' => 'sum'
                    ],
                    'profit_margin' => [
                        'operation' => 'average'
                    ],
                    'subtotal' => [
                        'operation' => 'sum'
                    ]
                ]
            ]
        ]), row_options: ['row.append-attributes' => ['class' => 'table-responsive']]);
    }

}