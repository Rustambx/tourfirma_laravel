<?php

namespace Tests\Unit\Controllers;

use App\Modules\Tour\Controllers\Admin\GalleryController;
use App\Modules\Tour\Models\Gallery;
use App\Modules\Tour\Models\Tour;
use App\Modules\Tour\Requests\GalleryRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class GalleryControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testStore()
    {
        $controller = new GalleryController();
        $tour = factory(Tour::class)->create();
        $request = GalleryRequest::create('admin/galleries/store', 'POST', [
            'name' => 'Test',
            'img' => '/storage/images/countries/5dd7fd31d8094.jpg',
            'tour_id' => $tour->id
        ]);

        $this->assertNotNull($controller->store($request));
        $this->assertEquals(302, $controller->store($request)->status());
    }

    public function testUpdate()
    {
        $controller = new GalleryController();
        $gallery = factory(Gallery::class)->create();
        $tour = factory(Tour::class)->create();
        $request = GalleryRequest::create('admin/galleries/store', 'POST', [
            'name' => 'Test',
            'img' => '/storage/images/countries/5dd7fd31d8094.jpg',
            'tour_id' => $tour->id
        ]);

        $this->assertNotNull($controller->update($request, $gallery->id));
        $this->assertEquals(302, $controller->update($request, $gallery->id)->status());
    }

    public function testDestroy()
    {
        $controller = new GalleryController();
        $gallery = factory(Gallery::class)->create();

        $this->assertEquals(302, $controller->destroy($gallery->id)->status());
    }
}

?>
