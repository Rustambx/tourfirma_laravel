<?php

namespace Tests\Unit\Services;

use App\Modules\City\Models\City;
use App\Modules\Hotel\Models\Hotel;
use App\Modules\Hotel\Requests\HotelRequest;
use App\Modules\Hotel\Services\HotelService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;

class HotelServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreate()
    {
        $service = new HotelService();
        $city = factory(City::class)->create();
        $status = ['status' => 'Отель добавлен'];
        $request = HotelRequest::create("admin/hotels/store", 'POST', [
            'title' => 'test',
            'price' => random_int(1000, 5000),
            'detail_text' => Str::random('100'),
            'city_id' => $city->id,
        ]);

        $this->assertNotNull($service->create($request));
        $this->assertNotFalse($service->create($request));
        $this->assertIsArray($service->create($request));
        $this->assertEquals($status, $service->create($request));
    }

    public function testUpdate()
    {
        $service = new HotelService();
        $hotel = factory(Hotel::class)->create();
        $city = factory(City::class)->create();
        $status = ['status' => 'Отель обновлен'];
        $request = HotelRequest::create("admin/hotels/update/$hotel->id", 'POST', [
            'title' => 'test',
            'price' => random_int(1000, 5000),
            'detail_text' => Str::random('100'),
            'city_id' => $city->id,
        ]);

        $this->assertNotNull($service->update($request, $hotel->id));
        $this->assertNotFalse($service->update($request, $hotel->id));
        $this->assertIsArray($service->update($request, $hotel->id));
        $this->assertEquals($status, $service->update($request, $hotel->id));
    }

    public function testDestroy()
    {
        $service = new HotelService();
        $hotel = factory(Hotel::class)->create();
        $status = ['status' => 'Отель удалена'];

        $this->assertEquals($status, $service->destroy($hotel->id));
    }
}

?>
