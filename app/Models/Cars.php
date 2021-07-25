<?php

declare(strict_types=1);

namespace App\Models;

use App\Services\PurifierService;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    protected $table = 'cars';

    protected $fillable =
        [
            'Make',
            'Name',
            'Trim',
            'Year',
            'Body',
            'Engine_Position',
            'Engine_Type',
            'Engine_Compression',
            'Engine_Fuel',
            'Image',
            'Country',
            'Make_Display',
            'Weight_KG',
            'Transmission_Type',
            'Tags',
            'Price',
            'Is_API'
        ];

    protected $hidden = ['id'];

    public function ScopeFilter($query, $request)
    {
        if (! empty($request['Name'])) {
            $query->where('Name', PurifierService::clean($request['Name']));
        }

        if (! empty($request['PriceFrom']) && empty($request['PriceTill'])) {
            $query->where('Price', 'like', PurifierService::clean($request['PriceFrom']) . '%');
        }

        if (! empty($request['PriceTill']) && empty($request['PriceFrom'])) {
            $query->where('Price', 'like', PurifierService::clean($request['PriceTill']) . '%');
        }

        if (! empty($request['PriceFrom']) && ! empty($request['PriceTill'])) {
            $query->whereBetween(
                'Price',
                [PurifierService::clean($request['PriceFrom']), PurifierService::clean($request['PriceTill'])]
            );
        }

        if (! empty($request['Country'])) {
            $query->where('Country', 'like', '%' . PurifierService::clean($request['Country']) . '%');
        }

        if (! empty($request['Tags'])) {
            $query->where('Tags', 'like', '%' . PurifierService::clean($request['Tags']) . '%');
        }
    }

    public function ScopeNameFilter($query, $args): void
    {
        $query->where('Name', $args);
    }
}