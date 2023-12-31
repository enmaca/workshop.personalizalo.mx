<?php

namespace App\Livewire\LaborCost\Modal;

use App\Models\LaborCost;
use Enmaca\LaravelUxmal\Components\Form\Input;
use Enmaca\LaravelUxmal\Support\Options\Form\Input\InputHiddenOptions;
use Enmaca\LaravelUxmal\Support\Options\Form\Input\InputNumberOptions;
use Enmaca\LaravelUxmal\Support\Options\Form\Input\InputTextOptions;
use Enmaca\LaravelUxmal\Support\Options\Ui\RowOptions;
use Enmaca\LaravelUxmal\UxmalComponent;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Enmaca\LaravelUxmal\Components\Ui\Row;

class AddLaborCostToOrder extends Component
{
    public $content;
    public $increment;
    public $order_hashId;

    public function mount(string $order_hashId): void
    {
        $this->content = 'Initial::Content';
        $this->order_hashId = $order_hashId;
    }

    /**
     * @throws Exception
     */
    #[On('add-labor-cost-to-order::laborcost.changed')]
    public function laborcost_changed($laborcost): void
    {
        $this->increment++;

        $__formId = '__' . bin2hex(random_bytes(4));

        $laborcost_data = LaborCost::With(['taxes'])->findByHashId($laborcost);

        $tax_factor = 0;
        foreach ($laborcost_data->taxes as $tax) {
            $tax_factor += $tax->value;
        }

        $cost_by_minute = $laborcost_data->cost_by_hour / 60;

        $one_subtotal = ($cost_by_minute * $laborcost_data->min_fraction_cost_in_minutes) * (1 + $tax_factor);

        $form = UxmalComponent::Make('form', [
            'options' => [
                'form.id' => $__formId,
                'form.action' => route('api_post_order_opd_labor_cost', $this->order_hashId)
            ]
        ]);

        $main_row = new UxmalComponent();

        $main_row->addRow(new RowOptions(
            appendAttributes: [
                'class' => 'mb-3'
            ],
            content: '<h6>' . $laborcost_data->name . '</h6>'
        ));


        $main_row->addElement(element: Input\Hidden::Options(new InputHiddenOptions(
            name: 'laborCostId',
            value: $laborcost_data->hashId
        )));

        $main_row->addElementInRow(
            element: Input::Options(new InputNumberOptions(
                label: 'Cantidad (Minimo [' . $laborcost_data->min_fraction_cost_in_minutes . '] Minutos)',
                name: 'laborCostQuantity',
                value: $laborcost_data->min_fraction_cost_in_minutes,
                required: true,
                appendAttributes: [
                    'data-value' => $cost_by_minute,
                    'data-tax-factor' => $tax_factor,
                ],
                min: $laborcost_data->min_fraction_cost_in_minutes
            )),
            row_options: new RowOptions(
                appendAttributes: [
                    'class' => 'mb-3'
                ]
            )
        );

        $main_row->addElementInRow(element: Input::Options(new InputTextOptions(
            label: 'Subtotal',
            name: 'laborCostSubtotal',
            value: '$' . number_format($one_subtotal, 2),
            required: true,
            appendAttributes: [
                'data-value' => $cost_by_minute,
                'data-tax-factor' => $tax_factor,
            ],
            readonly: true
        )),
            row_options: new RowOptions(
                appendAttributes: [
                    'class' => 'mb-3'
                ]
            )
        );


        $form->addRow(new RowOptions(
            appendAttributes: [
                'data-selected-laborcost-form-id' => $__formId
            ],
            content: $main_row
        ));

        $this->content = View::make($form->view, [
            'data' => $form->toArray()
        ])->render();
    }

    /**
     * @throws Exception
     */
    public function render(): Factory|Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $this->increment++;
        $uxmal = Row::Options(new RowOptions(
            appendAttributes: [
                'wire:model' => 'content'
            ],
            content: $this->content
        ));
        return view($uxmal->view, ['data' => $uxmal->toArray()]);
    }
}
