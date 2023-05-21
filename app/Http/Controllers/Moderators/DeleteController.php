<?php

namespace App\Http\Controllers\Moderators;

use App\Models\Moderator;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

final class DeleteController extends Controller
{
    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function __invoke(int $id): JsonResponse
    {
        $moderator = Moderator::query()->where('id', '=', $id)->firstOrFail();

        $moderator->delete();

        return \response()->json([], ResponseAlias::HTTP_NO_CONTENT);
    }
}