<?php

namespace App\Support\Workshop\Order\EditScreen;

use Enmaca\LaravelUxmal\Abstract\ContentBlock;
use Enmaca\LaravelUxmal\Components\Form\Input\Checkbox;
use Enmaca\LaravelUxmal\Components\Form\Input\Flatpickr as FlatpickrComponent;
use Enmaca\LaravelUxmal\Components\Ui\Card as CardComponent;
use Enmaca\LaravelUxmal\Support\Options\Form\Input\InputCheckboxOptions;
use Enmaca\LaravelUxmal\Support\Options\Ui\CardOptions;
use Enmaca\LaravelUxmal\Support\Options\Ui\RowOptions;
use Enmaca\LaravelUxmal\UxmalComponent;

class MainContent extends ContentBlock
{
    /**
     * @throws \Exception
     */
    public function build(): void
    {
        $this->NewContentRow(new RowOptions(
            replaceAttributes: [
                'data-uxmal-order-data' => json_encode([
                    'customer_id' => $this->GetValue('customer_id'),
                    'order_id' => $this->GetValue('order_id')
                ]),
                'class' => [
                    'row gy-4' => true
                ]
            ]));

        $DateButton = UxmalComponent::Make('livewire', [
            'options' => [
                'livewire.path' => 'order.button.delivery-date',
                'livewire.append-data' => [
                    'order_id' => $this->GetValue('order_id')
                ]
            ]
        ])->toHtml();

        $orderCardObj = $this->ContentRow()->addElement(CardComponent::Options(
            new CardOptions(
                name: 'orderCard',
                header: 'Pedido ' . $this->GetValue('order_code'),
                headerRight: $DateButton,
                body: null,
                footer: '&nbsp;'
            )
        ));


        $orderCardBodyObj = $orderCardObj->Body();

        $orderCardBodyObj->addElement(FlatpickrComponent::Options([
            'input.type' => 'flatpickr',
            'flatpickr.label' => null,
            'flatpickr.name' => 'deliveryDate',
            'flatpickr.append-attributes' => ['style' => 'display: none'],
            'flatpickr.date-format' => "d M, Y",
            'flatpickr.positionElement' => '#orderDeliveryDateButtonId'
        ]));


        $orderCardBodyObj->addElement(MainContent\ClientCard::Object(
            values: $this->GetValues(),
            options: [
                'card.header' => 'Datos Cliente/Entrega',
                'card.body' => null,
                'card.footer' => null,
                'card.style' => 'primary',
                'card.name' => 'clientCard'
            ]));


        $orderCardBodyObj->addElement(MainContent\MfgCard::Object(
            values: $this->GetValues(),
            options: [
                'card.header' => 'Datos de Manufactura',
                'card.body' => null,
                'card.footer' => null,
                'card.style' => 'success',
                'card.name' => 'deliveryCard'
            ]));


        $orderCardBodyObj->addElement(MainContent\ProductCard::Object(
            values: $this->GetValues(),
            options: [
                'card.header' => 'Productos',
                'card.body' => null,
                'card.footer' => null,
                'card.style' => 'info',
                'card.name' => 'productCard'
            ]));

        $orderCardBodyObj->addElement(MainContent\DynamicCard::Object(
            values: $this->GetValues(),
            options: [
                'card.header' => 'Costos Directos',
                'card.body' => null,
                'card.footer' => null,
                'card.style' => 'warning',
                'card.name' => 'dynamicCard'
            ]));

        $orderCardBodyObj->addElement(MainContent\PaymentCard::Object(
            values: $this->GetValues(),
            options: [
                'card.header' => 'Información de Pago',
                'card.body' => null,
                'card.footer' => '',
                'card.style' => 'dark',
                'card.name' => 'paymentCard'
            ]));
    }
}
