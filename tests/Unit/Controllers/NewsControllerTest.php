<?php

namespace Tests\Unit\Controllers;

use App\Modules\News\Controllers\Admin\NewsController;
use App\Modules\News\Models\News;
use App\Modules\News\Requests\NewsRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Str;
use Tests\TestCase;

class NewsControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function testStore()
    {
        $controller = New NewsController();
        $request = NewsRequest::create('admin/news/store', 'POST', [
            'title' => 'test',
            'preview_text' => Str::random('100'),
            'detail_text' => Str::random('100'),
        ]);

        $this->assertNotNull($controller->store($request));
        $this->assertEquals(302, $controller->store($request)->status());
    }

    public function testUpdate()
    {
        $news = factory(News::class)->create();
        $controller = New NewsController();
        $request = NewsRequest::create("admin/news/update/$news->id", 'POST', [
            'title' => 'test',
            'preview_text' => Str::random('100'),
            'detail_text' => Str::random('100'),
        ]);

        $this->assertNotNull($controller->update($request, $news->id));
        $this->assertNotFalse($controller->update($request, $news->id));
        $this->assertEquals(302, $controller->update($request, $news->id)->status());
    }

    public function testDestroy()
    {
        $news = factory(News::class)->create();
        $controller = New NewsController();
        $request = NewsRequest::create("admin/news/update/$news->id", 'POST', [
            'title' => 'test',
            'preview_text' => Str::random('100'),
            'detail_text' => Str::random('100'),
        ]);

        $this->assertEquals(302, $controller->destroy($news->id)->status());
    }
}
