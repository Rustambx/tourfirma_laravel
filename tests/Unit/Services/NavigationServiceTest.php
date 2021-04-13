<?php

namespace Tests\Unit\Services;

use App\Modules\Navigation\Models\Navigation;
use App\Modules\Navigation\Requests\NavigationRequest;
use App\Modules\Navigation\Services\NavigationService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class NavigationServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreate()
    {
        $service = new NavigationService();
        $status = ['status' => 'Меню добавлен'];
        $request = NavigationRequest::create('admin/navigations/store', 'POST', [
            'title' => 'Тест',
            'path' => '/test',
            'routeName' => 'test'
        ]);

        $this->assertNotNull($service->create($request));
        $this->assertNotFalse($service->create($request));
        $this->assertIsArray($service->create($request));
        $this->assertEquals($status, $service->create($request));
    }

    public function testUpdate()
    {
        $service = new NavigationService();
        $navigation = factory(Navigation::class)->create();
        $status = ['status' => 'Меню обновлен'];
        $request = NavigationRequest::create("'dmin/navigations/update/$navigation->id", 'POST', [
            'title' => 'Тест',
            'path' => '/test',
            'routeName' => 'test'
        ]);

        $this->assertNotNull($service->update($request, $navigation->id));
        $this->assertNotFalse($service->update($request, $navigation->id));
        $this->assertIsArray($service->update($request, $navigation->id));
        $this->assertEquals($status, $service->update($request, $navigation->id));
    }

    public function testDestroy()
    {
        $service = new NavigationService();
        $navigation = factory(Navigation::class)->create();
        $status = ['status' => 'Меню удален'];

        $this->assertEquals($status, $service->destroy($navigation->id));
    }
}

?>
