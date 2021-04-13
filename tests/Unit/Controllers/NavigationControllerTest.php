<?php

namespace Tests\Unit\Controllers;

use App\Modules\Navigation\Controllers\Admin\NavigationController;
use App\Modules\Navigation\Models\Navigation;
use App\Modules\Navigation\Requests\NavigationRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class NavigationControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testStore()
    {
        $controller = new NavigationController();
        $request = NavigationRequest::create('admin/navigations/store', 'POST', [
            'title' => 'Тест',
            'path' => '/test',
            'routeName' => 'test'
        ]);

        $this->assertNotNull($controller->store($request));
        $this->assertEquals(302, $controller->store($request)->status());
    }

    public function testUpdate()
    {
        $controller = new NavigationController();
        $navigation = factory(Navigation::class)->create();
        $request = NavigationRequest::create("'dmin/navigations/update/$navigation->id", 'POST', [
            'title' => 'Тест',
            'path' => '/test',
            'routeName' => 'test'
        ]);

        $this->assertNotNull($controller->update($request, $navigation->id));
        $this->assertEquals(302, $controller->update($request, $navigation->id)->status());
    }

    public function testDestroy()
    {
        $controller = new NavigationController();
        $navigation = factory(Navigation::class)->create();

        $this->assertEquals(302, $controller->destroy($navigation->id)->status());
    }
}

?>
