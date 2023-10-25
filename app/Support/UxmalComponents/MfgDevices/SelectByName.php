<?php

namespace App\Support\UxmalComponents\MfgDevices;

use App\Models\MfgDevice;

class SelectByName extends \App\Support\UxmalComponents\BaseTomSelect
{
    protected $Model = MfgDevice::class;

    protected $Options = [
        'tomselect.label' => 'Dispositivos',
        'tomselect.name' => 'mfgDevicesSelected',
        'tomselect.placeholder' => 'Seleccionar...',
        'tomselect.load-url' => '/mfg_devices/search_tomselect?context=by_name',
        'tomselect.allow-empty-option' => true,
        'tomselect.event-change-handler' => 'onChangeSelectedMfgDeviceByName'
    ];

}