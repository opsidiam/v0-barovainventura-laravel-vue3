<?php
return [
    'table' => [
        'name' => 'Name',
        'value' => 'Volume',
        'alcohol' => 'Alcohol',
        'ean' => 'Barcode (EAN)',
        'action' => 'Action',
        'type' => 'Type',
    ],
    'type' => [
        'unspilled' => 'Individual',
        'spilled' => 'Bulk',
    ],
    'messages' => [
        'success' => [
            'product-delete' => 'Product has been successfully deleted',
            'product-update' => 'Product has been successfully updated',
            'product-save' => 'Product has been successfully saved',
        ],
        'failure' => [
            'product-delete' => 'Product was not deleted (Error)',
            'product-update' => 'Product was not updated',
            'product-save' => 'Product was not saved',
        ],
    ],
    'product-detail' => 'Product Detail',
];
