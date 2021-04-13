<?php

namespace Tests\Unit\Controllers;

use App\Modules\City\Models\City;
use App\Modules\Hotel\Controllers\Admin\HotelController;
use App\Modules\Hotel\Models\Hotel;
use App\Modules\Hotel\Requests\HotelRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;

class HotelControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testStore()
    {
        $controller = new HotelController();
        $city = factory(City::class)->create();
        $request = HotelRequest::create('admin/hotels/store', 'POST', [
            'title' => 'test',
            'price' => random_int(1000, 5000),
            'detail_text' => Str::random('100'),
            'city_id' => $city->id,
        ]);

        $this->assertNotNull($controller->store($request));
        $this->assertEquals(302, $controller->store($request)->status());
    }

    public function testUpdate()
    {
        $controller = new HotelController();
        $hotel = factory(Hotel::class)->create();
        $city = factory(City::class)->create();
        $request = HotelRequest::create("admin/hotels/update/$hotel->id", 'POST', [
            'title' => 'test',
            'price' => random_int(1000, 5000),
            'detail_text' => Str::random('100'),
            'city_id' => $city->id,
        ]);

        $this->assertNotNull($controller->update($request, $hotel->id));
        $this->assertEquals(302, $controller->update($request, $hotel->id)->status());
    }

    public function testDestroy()
    {
        $controller = new HotelController();
        $hotel = factory(Hotel::class)->create();

        $this->assertEquals(302, $controller->destroy($hotel->id)->status());
    }
}

?>
