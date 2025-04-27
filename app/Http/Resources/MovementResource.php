<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "productCode"       => $this->product->productCode ?? 'N/A',
            "productName"       => $this->product->productName ?? 'N/A',
            "fromBatchNumber"   => $this->fromBatchNumber,
            "toBatchNumber"     => $this->toBatchNumber,
            "fromLocation"      => $this->fromLocation,
            "toLocation"        => $this->toLocation,
            "quantity"          => $this->quantity,
            "movementTypeId"    => $this->movementType->movementTypeId ?? 'N/A',
            "movementTypeName"  => $this->movementType->movementTypeName ?? 'N/A',
            "movementDate"      => $this->movementDate,
            "customer"          => $this->customer ?? "",
            "supplier"          => $this->supplier ?? ""
        ];
    }
}
