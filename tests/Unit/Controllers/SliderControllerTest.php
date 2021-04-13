<?php

namespace Tests\Unit\Controllers;

use App\Modules\Country\Models\Country;
use App\Modules\Slider\Controllers\Admin\SliderController;
use App\Modules\Slider\Models\Slider;
use App\Modules\Slider\Requests\SliderRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SliderControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testStore()
    {
        $controller = new SliderController();
        $country = factory(Country::class)->create();
        $request = SliderRequest::create('admin/sliders/store', 'POST', [
            'title' => 'Test',
            'price' => random_int(1000, 5000),
            'country_id' => $country->id,
        ]);

        $this->assertNotNull($controller->store($request));
        $this->assertEquals(302, $controller->store($request)->status());
    }

    public function testUpdate()
    {
        $controller = new SliderController();
        $slider = factory(Slider::class)->create();
        $country = factory(Country::class)->create();
        $request = SliderRequest::create('admin/sliders/store', 'POST', [
            'title' => 'Test',
            'price' => random_int(1000, 5000),
            'country_id' => $country->id,
        ]);

        $this->assertNotNull($controller->update($request, $slider->id));
        $this->assertNotFalse($controller->update($request, $slider->id));
        $this->assertEquals(302, $controller->update($request, $slider->id)->status());
    }

    public function testDestroy()
    {
        $controller = new SliderController();
        $slider = factory(Slider::class)->create();

        $this->assertEquals(302, $controller->destroy($slider->id)->status());
    }
}

?>
