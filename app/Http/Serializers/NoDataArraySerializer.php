<?php
namespace App\Http\Serializers;

use League\Fractal\Serializer\ArraySerializer;

class NoDataArraySerializer extends ArraySerializer
{
    /**
     * Serialize a collection.
     */
    public function collection($resourceKey, array $data)
    {
        return ($resourceKey) ? [ $resourceKey => $data ] : $data;
    }

}