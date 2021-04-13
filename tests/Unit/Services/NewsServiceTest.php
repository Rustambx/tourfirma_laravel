<?php

namespace Tests\Unit\Services;

use App\Modules\News\Requests\NewsRequest;
use App\Modules\News\Services\NewsService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use App\Modules\News\Models\News;
use Tests\TestCase;

class NewsServiceTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreate()
    {
        $service = New NewsService();
        $status = ["status" => "Новость добавлена"];
        $request = NewsRequest::create('admin/news/store', 'POST', [
            'title' => 'test',
            'preview_text' => Str::random('100'),
            'detail_text' => Str::random('100'),
        ]);

        $this->assertNotNull($service->create($request));
        $this->assertNotFalse($service->create($request));
        $this->assertIsArray($service->create($request));
        $this->assertEquals($status, $service->create($request));
    }

    public function testUpdate()
    {
        $service = new NewsService();
        $news = factory(News::class)->create();
        $status = ['status' => 'Новость обновлена'];
        $request = NewsRequest::create("admin/news/update/$news->id", 'POST', [
            'title' => 'test',
            'preview_text' => Str::random('100'),
            'detail_text' => Str::random('100'),
        ]);

        $this->assertNotNull($service->update($request, $news->id));
        $this->assertNotFalse($service->update($request, $news->id));
        $this->assertIsArray($service->update($request, $news->id));
        $this->assertEquals($status, $service->update($request, $news->id));
    }

    public function testDestroy()
    {
        $service = new NewsService();
        $news = factory(News::class)->create();
        $status = ['status' => 'Новость удалена'];

        $this->assertEquals($status, $service->destroy($news->id));
    }
}

?>
