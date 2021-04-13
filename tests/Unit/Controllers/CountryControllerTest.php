<?php

namespace Tests\Unit\Controllers;

use App\Modules\Country\Controllers\Admin\CountryController;
use App\Modules\Country\Models\Country;
use App\Modules\Country\Requests\CountryRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Tests\TestCase;

class CountryControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testStore()
    {
        $controller = new CountryController();
        $file = new UploadedFile(public_path('test.jpg'), 'test.jpg', 'image/jpeg', 0, false);
        $request = CountryRequest::create('admin/countries/store', 'POST',[
            'title' => 'test',
            'preview_text' => Str::random('100'),
            'detail_text' => Str::random('100'),
        ]);

        /*$test = UploadedFile::fake()->image('test.jpg');
        $request->files->add(['img' => $test]);*/

        $this->assertNotNull($controller->store($request));
        $this->assertEquals(302, $controller->store($request)->status());
    }

    public function testUpdate()
    {
        $country = factory(Country::class)->create();
        $controller = new CountryController();

        $request = CountryRequest::create("admin/countries/update/$country->id", 'POST',[
            'title' => 'test',
            'preview_text' => Str::random('100'),
            'detail_text' => Str::random('100'),
        ]);

        $this->assertNotNull($controller->update($request, $country->id));
        $this->assertNotFalse($controller->update($request, $country->id));
        $this->assertEquals(302, $controller->update($request, $country->id)->status());
    }

    public function testDestroy()
    {
        $country = factory(Country::class)->create();
        $controller = new CountryController();

        $this->assertEquals(302, $controller->destroy($country->id)->status());
    }
}
