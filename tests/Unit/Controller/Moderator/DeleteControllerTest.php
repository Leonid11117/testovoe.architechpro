<?php

namespace Tests\Unit\Controller\Moderator;

use Tests\TestCase;
use App\Models\Moderator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Http\Controllers\Moderators\DeleteController;

class DeleteControllerTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    /**
     *
     * @return void
     */
    public function testDeleteModerator(): void
    {
        $moderator = Moderator::factory()->create();

        $controller = new DeleteController();
        $response   = $controller->__invoke($moderator->id);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(ResponseAlias::HTTP_NO_CONTENT, $response->getStatusCode());

        $this->assertSoftDeleted($moderator);
    }
}