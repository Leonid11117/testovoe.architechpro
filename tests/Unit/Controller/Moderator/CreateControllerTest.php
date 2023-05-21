<?php

namespace Tests\Unit\Controller\Moderator;

use Tests\TestCase;
use App\Models\Moderator;
use App\Enums\Moderator\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;
use App\Http\Requests\Moderator\ModeratorRequest;
use App\Http\Controllers\Moderators\CreateController;

class CreateControllerTest extends TestCase
{
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
    public function testCreateModerator(): void
    {
        $request = ModeratorRequest::create('/api/moderators', 'POST', [
            'moderator' => [
                'name'            => 'John Doe',
                'email'           => 'john@example.com',
                'global_settings' => ['setting_1' => true, 'setting_2' => false],
                'status' => Status::ACTIVE->value,
            ],
        ]);

        $controller = new CreateController();
        $response   = $controller->__invoke($request);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());

        $data = $response->getData(true);
        $this->assertArrayHasKey('data', $data);

        $moderator = Moderator::first();
        $this->assertInstanceOf(Moderator::class, $moderator);
        $this->assertEquals($moderator->name, $data['data']['name']);
        $this->assertEquals($moderator->email, $data['data']['email']);
        $this->assertEquals($moderator->global_settings, $data['data']['global_settings']);
        $this->assertEquals($moderator->status, $data['data']['status']);
    }
}