<?php

namespace Tests\Unit\Services;

use App\Modules\Country\Models\Country;
use App\Modules\Slider\Models\Slider;
use App\Modules\Slider\Requests\SliderRequest;
use App\Modules\Slider\Services\SliderService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SliderServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreate()
    {
        $service = new SliderService();
        $country = factory(Country::class)->create();
        $status = ['status' => 'Баннер добавлен'];
        $request = SliderRequest::create('admin/sliders/store', 'POST', [
            'title' => 'Test',
            'price' => random_int(1000, 5000),
            'country_id' => $country->id,
        ]);

        $this->assertNotNull($service->create($request));
        $this->assertNotFalse($service->create($request));
        $this->assertIsArray($service->create($request));
        $this->assertEquals($status, $service->create($request));
    }

    public function testUpdate()
    {
        $service = new SliderService();
        $slider = factory(Slider::class)->create();
        $country = factory(Country::class)->create();
        $status = ['status' => 'Баннер обновлен'];
        $request = SliderRequest::create("admin/sliders/store", 'POST', [
            'title' => 'Test',
            'price' => random_int(1000, 5000),
            'country_id' => $country->id,
        ]);

        $this->assertNotNull($service->update($request, $slider->id));
        $this->assertNotFalse($service->update($request, $slider->id));
        $this->assertIsArray($service->update($request, $slider->id));
        $this->assertEquals($status, $service->update($request, $slider->id));
    }

    public function testDestroy()
    {
        $service = new SliderService();
        $slider = factory(Slider::class)->create();
        $status = ['status' => 'Баннер удален'];

        $this->assertEquals($status, $service->destroy($slider->id));
    }
}

?>
