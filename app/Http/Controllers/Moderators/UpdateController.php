<?php

namespace App\Http\Controllers\Moderators;

use App\Models\Moderator;
use App\Http\Controllers\Controller;
use App\Resources\Moderators\IndexResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Requests\Moderator\ModeratorRequest;

final class UpdateController extends Controller
{
    /**
     * @param int              $id
     * @param ModeratorRequest $request
     *
     * @return JsonResource
     * @throws \Throwable
     */
    public function __invoke(int $id, ModeratorRequest $request): JsonResource
    {
        $moderator = Moderator::query()->where('id', '=', $id)->firstOrFail();

        $moderator->fill([
            'name'            => $request->moderator['name'],
            'email'           => $request->moderator['email'],
            'global_settings' => $request->moderator['global_settings'],
            'status'          => $request->moderator['status'],
        ]);

        $moderator->saveOrFail();

        return IndexResource::make($moderator);
    }
}