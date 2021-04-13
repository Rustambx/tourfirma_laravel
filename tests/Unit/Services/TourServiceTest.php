<?php

namespace Tests\Unit\Services;

use App\Modules\Tour\Models\Tour;
use App\Modules\Tour\Models\Type;
use App\Modules\Tour\Requests\TourRequest;
use App\Modules\Tour\Services\TourService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;

class TourServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreate()
    {
        $service = new TourService();
        $status = ['status' => 'Тур добавлен'];
        $typeTour = factory(Type::class)->create();
        $request = TourRequest::create('admin/tours/store', 'POST', [
            'title' => 'Test',
            'price' => random_int(1000, 5000),
            'hot' => 'Y',
            'detail_text' => Str::random(100),
            'type_tour_id' => $typeTour->id,
        ]);

        $this->assertNotNull($service->create($request));
        $this->assertNotFalse($service->create($request));
        $this->assertIsArray($service->create($request));
        $this->assertEquals($status, $service->create($request));
    }

    public function testUpdate()
    {
        $service = new TourService();
        $tour = factory(Tour::class)->create();
        $status = ['status' => 'Тур обновлен'];
        $typeTour = factory(Type::class)->create();
        $request = TourRequest::create("admin/tours/update/$tour->id", 'POST', [
            'title' => 'Test',
            'price' => random_int(1000, 5000),
            'hot' => 'Y',
            'detail_text' => Str::random(100),
            'type_tour_id' => $typeTour->id,
        ]);

        $this->assertNotNull($service->update($request, $tour->id));
        $this->assertNotFalse($service->update($request, $tour->id));
        $this->assertIsArray($service->update($request, $tour->id));
        $this->assertEquals($status, $service->update($request, $tour->id));
    }

    public function testDestroy()
    {
        $service = new TourService();
        $tour = factory(Tour::class)->create();
        $status = ['status' => 'Тур удален'];

        $this->assertEquals($status, $service->destroy($tour->id));
    }
}

?>
