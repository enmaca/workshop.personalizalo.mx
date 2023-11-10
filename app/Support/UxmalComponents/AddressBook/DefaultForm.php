<?php

namespace App\Support\UxmalComponents\AddressBook;

use Enmaca\LaravelUxmal\Abstract\FormBlock;
use Enmaca\LaravelUxmal\Components\Form;
use Enmaca\LaravelUxmal\Components\Form\Input\Checkbox as CheckboxInput;
use Enmaca\LaravelUxmal\Support\Options\Form\Input\Text as TextOptions;
use Illuminate\Support\Str;

class DefaultForm extends FormBlock
{
    /**
     * @throws \Exception
     */
    public function build(): void
    {
/*
        $this->Input([
            'input.type' => 'checkbox',
            'checkbox.label' => 'Datos del Destinatario igual que el cliente?',
            'checkbox.name' => 'recipientDataSameAsCustomer',
            'checkbox.value' => 1,
            'checkbox.checked' => isset($this->attributes['values'][str::snake('recipientDataSameAsCustomer')]) && $this->attributes['values'][str::snake('recipientDataSameAsCustomer')] == 1
        ], 'col-12');
*/

        /**
         * Direccion
         * class="card-body bg-light border-bottom border-top bg-opacity-25"
         */
        $this->ContentAddRow(row_options: [
            'row.slot' => '<h5>Dirección</h5>',
            'row.append-attributes' => [
                'class' => 'bg-light border-bottom border-top p-3'
            ]
        ]);

        $this->ContentAddRow();

        $this->ContentAddElement(element: CheckboxInput::Options([
            'input.type' => 'checkbox',
            'checkbox.label' => 'Datos del Destinatario igual que el cliente?',
            'checkbox.name' => 'recipientDataSameAsCustomer',
            'checkbox.value' => 1,
            'checkbox.checked' => isset($this->attributes['values'][str::snake('recipientDataSameAsCustomer')]) && $this->attributes['values'][str::snake('recipientDataSameAsCustomer')] == 1
        ]));

        $this->ContentAddRow(row_options: [
            'row.name' => 'recipientData',
            'row.append-attributes' => [
                'data-workshop-recipient-data' => true
            ]]);

        $this->Input( options: new TextOptions(
            label: 'Nombre (Destinatario)',
            name: 'recipientName',
            value: isset($this->attributes['values'][str::snake('recipientName')]) ? $this->attributes['values'][str::snake('recipientName')] : ''
        ));

        $this->Input( options: new TextOptions(
            label: 'Apellido (Destinatario)',
            name: 'recipientLastName',
            value: isset($this->attributes['values'][str::snake('recipientLastName')]) ? $this->attributes['values'][str::snake('recipientLastName')] : ''
        ));

        $this->Input( options: new TextOptions(
            label: 'Celular (Destinatario)',
            name: 'recipientMobile',
            value: isset($this->attributes['values'][str::snake('recipientMobile')]) ? $this->attributes['values'][str::snake('recipientMobile')] : ''
        ));

        $this->ContentAddRow();

        $this->Input( options: [
            'input.type' => 'text',
            'input.label' => 'Calle y Número',
            'input.name' => 'address1',
            'input.value' => isset($this->attributes['values'][str::snake('address1')]) ? $this->attributes['values'][str::snake('address1')] : ''
        ],
            row_class: 'col-6');

        $this->Input(
            options: [
            'input.type' => 'text',
            'input.label' => 'Entre Calles',
            'input.name' => 'address2',
            'input.value' => isset($this->attributes['values'][str::snake('address2')]) ? $this->attributes['values'][str::snake('address2')] : ''
        ], row_class: 'col-6');

        $this->Input([
            'input.type' => 'text',
            'input.label' => 'Código Postal',
            'input.name' => 'zipCode',
            'input.value' => isset($this->attributes['values'][str::snake('zipCode')]) ? $this->attributes['values'][str::snake('zipCode')] : ''
        ]);

        $row_selects = $this->ContentAddRow();
        $row_selects->addElementInRow( element: SelectMexDistricts::Object(), row_options: [
            'row.append-attributes' => [
                'class' => 'col-12 col-md-6'
            ]
        ]);

        $row_selects->addElementInRow(element: SelectMexMunicipalities::Object(), row_options: [
            'row.append-attributes' => [
                'class' => 'col-12 col-md-6'
            ]
        ]);

        $row_selects->addElementInRow(element: SelectMexStates::Object(), row_options: [
            'row.append-attributes' => [
                'class' => 'col-12 col-md-6'
            ]
        ]);
    }
}