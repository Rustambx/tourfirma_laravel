<?php

namespace Tests\Unit\Controllers;

use App\Modules\Tour\Controllers\Admin\TourController;
use App\Modules\Tour\Models\Tour;
use App\Modules\Tour\Models\Type;
use App\Modules\Tour\Requests\TourRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;

class TourControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testStore()
    {
        $controller = new TourController();
        $typeTour = factory(Type::class)->create();
        $request = TourRequest::create('admin/tours/store', 'POST', [
            'title' => 'Test',
            'price' => random_int(1000, 5000),
            'hot' => 'Y',
            'detail_text' => Str::random(100),
            'type_tour_id' => $typeTour->id,
        ]);

        $this->assertNotNull($controller->store($request));
        $this->assertNotFalse($controller->store($request));
        $this->assertEquals(302, $controller->store($request)->status());
    }

    public function testUpdate()
    {
        $controller = new TourController();
        $tour = factory(Tour::class)->create();
        $typeTour = factory(Type::class)->create();
        $request = TourRequest::create("admin/tours/update/$tour->id", 'POST', [
            'title' => 'Test',
            'price' => random_int(1000, 5000),
            'hot' => 'Y',
            'detail_text' => Str::random(100),
            'type_tour_id' => $typeTour->id,
        ]);

        $this->assertNotNull($controller->update($request, $tour->id));
        $this->assertNotFalse($controller->update($request, $tour->id));
        $this->assertEquals(302, $controller->update($request, $tour->id)->status());
    }

    public function testDestroy()
    {
        $controller = new TourController();
        $tour = factory(Tour::class)->create();

        $this->assertEquals(302, $controller->destroy($tour->id)->status());
    }
}

?>
