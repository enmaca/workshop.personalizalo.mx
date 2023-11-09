<?php

namespace App\Support\UxmalComponents\MfgDevices;

use App\Models\MfgDevice;
use App\Support\UxmalComponents\BaseTomSelect;

class SelectByName extends BaseTomSelect
{
    protected string $Model = MfgDevice::class;

    protected array $Options = [
        'tomselect.label' => 'Dispositivos',
        'tomselect.name' => 'mfgDevicesSelected',
        'tomselect.placeholder' => 'Seleccionar...',
        'tomselect.load-url' => '/mfg_devices/search_tomselect?context=by_name',
        'tomselect.allow-empty-option' => true,
        'tomselect.event-change-handler' => 'onChangeSelectedMfgDeviceByName'
    ];

}