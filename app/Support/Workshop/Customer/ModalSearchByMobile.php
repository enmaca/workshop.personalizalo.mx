<?php

namespace App\Support\Workshop\Customer;

use Enmaca\LaravelUxmal\Block\ModalBlock;
use Enmaca\LaravelUxmal\Components\Form\Input;
use Enmaca\LaravelUxmal\Components\Ui\Modal;
use Enmaca\LaravelUxmal\Support\Options\Form\ButtonOptions;
use Enmaca\LaravelUxmal\Support\Options\Form\Input\InputTextOptions;
use Enmaca\LaravelUxmal\Support\Options\Ui\ModalOptions;
use Enmaca\LaravelUxmal\Support\Options\Ui\RowOptions;
use Enmaca\LaravelUxmal\UxmalComponent;
use Exception;

class ModalSearchByMobile extends ModalBlock
{

    /**
     * @throws Exception
     */
    public function build(): void
    {
        $form = UxmalComponent::Make('form', [
            'options' => [
                'form.id' => 'NewOrderFrom',
                'form.action' => route('api_post_order'),
                'form.method' => 'POST'
            ]
        ]);

        $main_row = $form->addComponent(
            type: 'ui.row',
            attributes: [
                'options' => [
                    'row.append-attributes' => [
                        'class' => 'gy-4']
                ]
            ]);


        $main_row->addElementInRow(
            element: SelectByNameMobileEmail::Object(),
            row_options: new RowOptions(appendAttributes: ['class' => 'mb-3'])
        );

        $main_row->addElementInRow(
            element: Input::Options(
                new InputTextOptions(
                    label: 'Celular',
                    name: 'customerMobile',
                    placeholder: '(+52) XXXXXXXXXX',
                    required: true,
                    maskCleaveType: 'phone',
                    maskCleavePhoneRegionCode: 'MX',
                    maskCleavePrefix: '+52 ',
                )
            ),
            row_options: new RowOptions(
                appendAttributes: ['class' => 'mb-3']
            ));

        $main_row->addElementInRow(
            element: Input::Options(
                new InputTextOptions(
                    label: 'Nombre',
                    name: 'customerName',
                    placeholder: 'Ingresa el nombre del cliente',
                    required: true,
                )
            ),
            row_options: new RowOptions(
                appendAttributes: ['class' => 'mb-3']
            ));


        $main_row->addElementInRow(
            element: Input::Options(
                new InputTextOptions(
                    label: 'Apellido',
                    name: 'customerLastName',
                    placeholder: 'Ingresa el apellido del cliente',
                    required: true
                )
            ),
            row_options: new RowOptions(
                appendAttributes: ['class' => 'mb-3']
            ));

        $main_row->addElementInRow(
            element: Input::Options(
                new InputTextOptions(
                    label: 'Correo Electrónico',
                    name: 'customerEmail',
                    placeholder: 'Ingresa el correo electrónico del cliente',
                    required: true
                )
            ),
            row_options: new RowOptions(
                appendAttributes: ['class' => 'mb-3']
            ));


        $modal = Modal::Options(
            new ModalOptions(
                name: 'customerSearchByMobile',
                size: 'large',
                title: 'Buscar/Crear Cliente',
                body: $form,
                saveBtnLabel: 'Crear Pedido'
            )
        );

        $this->_callBtn = match ($this->GetContext()) {
            'createclient' => $modal->getShowButton(btnAttributes: new ButtonOptions(
                label: 'Agregar Cliente',
                name: 'clientAdd'
            ), return_type: 'object'),
            'createorder' => $modal->getShowButton(btnAttributes: new ButtonOptions(
                label: 'Crear Pedido',
                name: 'orderCreate'
            ), return_type: 'object'),
            default => $modal->getShowButton(btnAttributes: new ButtonOptions(
                label: 'Mostrar',
                name: 'showBtn'
            ), return_type: 'object')
        };

        $this->SetContent($modal);
    }
}
