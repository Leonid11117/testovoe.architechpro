<?php

namespace App\Resources\Moderators;

use App\Models\Moderator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Moderator $resource
 */
final class IndexResource extends JsonResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->resource->id,
            'name'            => $this->resource->name,
            'email'           => $this->resource->email,
            'global_settings' => $this->resource->global_settings,
            'status'          => $this->resource->status,
        ];
    }
}