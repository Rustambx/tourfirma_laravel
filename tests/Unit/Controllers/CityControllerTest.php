<?php

namespace Tests\Unit\Controllers;

use App\Modules\City\Controllers\Admin\CityController;
use App\Modules\City\Models\City;
use App\Modules\City\Requests\CityRequest;
use App\Modules\Country\Models\Country;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;

class CityControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testStore()
    {
        $country = factory(Country::class)->create();
        $controller = New CityController();
        $request = CityRequest::create('/admin/cities/store', 'POST', [
            'title' => 'test',
            'preview_text' => Str::random('100'),
            'detail_text' => Str::random('100'),
            'country_id' => $country->id
        ]);

        $this->assertNotNull($controller->store($request));
        $this->assertEquals(302, $controller->store($request)->status());
    }

    public function testUpdate()
    {
        $city = factory(City::class)->create();
        $country = factory(Country::class)->create();
        $controller = New CityController();
        $request = CityRequest::create("/admin/cities/update/$city->id", 'POST', [
            'title' => 'test',
            'preview_text' => Str::random('100'),
            'detail_text' => Str::random('100'),
            'country_id' => $country->id
        ]);

        $this->assertNotNull($controller->update($request, $city->id));
        $this->assertNotFalse($controller->update($request, $city->id));
        $this->assertEquals(302, $controller->update($request, $city->id)->status());
    }

    public function testDestroy()
    {
        $city = factory(City::class)->create();
        $controller = New CityController();

        $this->assertEquals(302, $controller->destroy($city->id)->status());
    }
}
