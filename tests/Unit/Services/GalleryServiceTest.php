<?php

namespace Tests\Unit\Services;

use App\Modules\Tour\Models\Gallery;
use App\Modules\Tour\Models\Tour;
use App\Modules\Tour\Requests\GalleryRequest;
use App\Modules\Tour\Services\GalleryService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class GalleryServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreate()
    {
        $service = new GalleryService();
        $status = ['status' => 'Галерея добавлена'];
        $tour = factory(Tour::class)->create();
        $request = GalleryRequest::create('admin/galleries/store', 'POST', [
            'name' => 'Test',
            'img' => '/storage/images/countries/5dd7fd31d8094.jpg',
            'tour_id' => $tour->id
        ]);

        $this->assertNotNull($service->create($request));
        $this->assertNotFalse($service->create($request));
        $this->assertIsArray($service->create($request));
        $this->assertEquals($status, $service->create($request));
    }

    public function testUpdate()
    {
        $service = new GalleryService();
        $gallery = factory(Gallery::class)->create();
        $status = ['status' => 'Галерея обновлена'];
        $tour = factory(Tour::class)->create();
        $request = GalleryRequest::create("admin/galleries/update/", 'POST', [
            'name' => 'Test',
            'img' => '/storage/images/countries/5dd7fd31d8094.jpg',
            'tour_id' => $tour->id
        ]);

        $this->assertNotNull($service->update($request, $gallery->id));
        $this->assertNotFalse($service->update($request, $gallery->id));
        $this->assertIsArray($service->update($request, $gallery->id));
        $this->assertEquals($status, $service->update($request, $gallery->id));
    }

    public function testDestroy()
    {
        $service = new GalleryService();
        $gallery = factory(Gallery::class)->create();
        $status = ['status' => 'Галерея удалена'];

        $this->assertEquals($status, $service->destroy($gallery->id));
    }
}

?>
