<?php

namespace App\Http\Controllers\Moderators;

use App\Models\Moderator;
use App\Http\Controllers\Controller;
use App\Resources\Moderators\IndexResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class IndexController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function __invoke(): AnonymousResourceCollection
    {
        $moderator = Moderator::query()->orderBy('id','desc')->paginate();

        return IndexResource::collection($moderator);
    }
}