<?php

namespace Tests\Unit\Services;

use App\Modules\City\Controllers\Admin\CityController;
use App\Modules\City\Models\City;
use App\Modules\City\Requests\CityRequest;
use App\Modules\City\Services\CityService;
use App\Modules\Country\Models\Country;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;

class CityServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreate()
    {
        $country = factory(Country::class)->create();
        $service = new CityService();
        $status = ['status' => 'Город добавлен'];
        $error = ['error' => 'Ошибка при сохранении'];
        $request = CityRequest::create('/admin/cities/store', 'POST', [
            'title' => 'test',
            'preview_text' => Str::random('100'),
            'detail_text' => Str::random('100'),
            'country_id' => $country->id
        ]);

        $this->assertNotNull($service->create($request));
        $this->assertNotEquals($error, $service->create($request));
        $this->assertEquals($status, $service->create($request));
    }

    public function testUpdate()
    {
        $city = factory(City::class)->create();
        $country = factory(Country::class)->create();
        $service = new CityService();
        $status = ['status' => 'Город обновлен'];
        $request = CityRequest::create("/admin/cities/update/$city->id", 'POST', [
            'title' => 'test',
            'preview_text' => Str::random('100'),
            'detail_text' => Str::random('100'),
            'country_id' => $country->id
        ]);

        $this->assertNotNull($service->update($request, $city->id));
        $this->assertNotFalse($service->update($request, $city->id));
        $this->assertEquals($status, $service->update($request, $city->id));
    }

    public function testDestroy()
    {
        $city = factory(City::class)->create();
        $service = new CityService();
        $status = ['status' => 'Город удален'];

        $this->assertEquals($status, $service->destroy($city->id));
    }
}
