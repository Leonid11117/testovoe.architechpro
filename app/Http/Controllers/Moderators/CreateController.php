<?php

namespace App\Http\Controllers\Moderators;

use App\Models\Moderator;
use App\Enums\Moderator\Status;
use App\Http\Controllers\Controller;
use App\Resources\Moderators\IndexResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Requests\Moderator\ModeratorRequest;

final class CreateController extends Controller
{
    /**
     * @param ModeratorRequest $request
     *
     * @return JsonResource
     * @throws \Throwable
     */
    public function __invoke(ModeratorRequest $request): JsonResource
    {
        $moderator = new Moderator();

        $moderator->fill([
            'name'            => $request->moderator['name'],
            'email'           => $request->moderator['email'],
            'global_settings' => $request->moderator['global_settings'],
            'status'          => Status::ACTIVE->value,
        ]);

        $moderator->saveOrFail();

        return IndexResource::make($moderator);
    }
}