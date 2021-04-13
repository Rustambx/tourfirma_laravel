<?php

namespace Tests\Unit\Services;

use App\Modules\Country\Controllers\Admin\CountryController;
use App\Modules\Country\Models\Country;
use App\Modules\Country\Requests\CountryRequest;
use App\Modules\Country\Services\CountryService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use PHPUnit\Framework\Constraint\Count;
use Tests\TestCase;

class CountryServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function testFind()
    {
        $country = factory(Country::class)->create();

        $service = new CountryService();
        $this->assertNotNull($service->find($country->id));
        $this->assertIsObject($service->find($country->id));
    }

    public function testStore()
    {
        $service = new CountryService();
        $file = new UploadedFile(public_path('test.jpg'), 'test.jpg', 'image/jpeg', 0, false);
        $request = CountryRequest::create('admin/countries/store', 'POST',[
            'title' => 'test',
            'preview_text' => Str::random('100'),
            'detail_text' => Str::random('100'),
        ]);
        $status = ['status' => 'Страна добавлена'];

        /*$test = UploadedFile::fake()->image('test.jpg');
        $request->files->add(['img' => $test]);*/

        $this->assertNotNull($service->create($request));
        $this->assertNotFalse($service->create($request));
        $this->assertIsArray($service->create($request));
        $this->assertEquals($status, $service->create($request));
    }

    public function testUpdate()
    {
        $country = factory(Country::class)->create();
        $service = new CountryService();
        $request = CountryRequest::create("admin/countries/update/$country->id", 'POST',[
            'title' => 'test',
            'preview_text' => Str::random('100'),
            'detail_text' => Str::random('100'),
        ]);
        $status = ['status' => 'Страна обновлена'];

        $this->assertNotNull($service->update($request, $country->id));
        $this->assertNotFalse($service->update($request, $country->id));
        $this->assertEquals($status, $service->update($request, $country->id));
    }

    public function testDestroy()
    {
        $country = factory(Country::class)->create();
        $service = new CountryService();
        $status = ['status' => 'Страна удалена'];

        $this->assertEquals($status, $service->destroy($country->id));
    }
}
