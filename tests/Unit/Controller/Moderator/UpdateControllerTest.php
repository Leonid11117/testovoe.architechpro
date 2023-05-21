<?php

namespace Tests\Unit\Controller\Moderator;

use Tests\TestCase;
use App\Models\Moderator;
use App\Enums\Moderator\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;
use App\Http\Requests\Moderator\ModeratorRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Http\Controllers\Moderators\UpdateController;

class UpdateControllerTest extends TestCase
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
     * @return void
     * @throws \Throwable
     */
    public function testUpdateModerator(): void
    {
        $moderator = Moderator::factory()->create();

        $request = ModeratorRequest::create('/api/moderators/' . $moderator->id, 'PUT', [
            'moderator' => [
                'name'            => 'Jane Smith',
                'email'           => 'jane@example.com',
                'global_settings' => ['setting_1' => false, 'setting_2' => true],
                'status'          => Status::REMOTE->value,
            ],
        ]);

        $controller = new UpdateController();
        $response   = $controller->__invoke($moderator->id, $request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());

        $data = $response->getData(true);
        $this->assertArrayHasKey('data', $data);

        $updatedModerator = Moderator::find($moderator->id);
        $this->assertInstanceOf(Moderator::class, $updatedModerator);
        $this->assertEquals($updatedModerator->name, $data['data']['name']);
        $this->assertEquals($updatedModerator->email, $data['data']['email']);
        $this->assertEquals($updatedModerator->global_settings, $data['data']['global_settings']);
        $this->assertEquals($updatedModerator->status, $data['data']['status']);
    }
}