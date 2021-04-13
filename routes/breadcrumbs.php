<?php
//login
Breadcrumbs::for('login', function ($trail) {
    $trail->push('Title Here', route('login'));
});

// home
Breadcrumbs::for('index', function ($trail) {
    $trail->push('Главная', route('index'));
});

// Home > tours
Breadcrumbs::for('tours.index', function ($trail) {
    $trail->parent('index');
    $trail->push('Туры', route('tours.index'));
});

// Home > tours
Breadcrumbs::for('tours.show', function ($trail, $tourId) {
    $obTour = \App\Modules\Tour\Models\Tour::find($tourId);
    $trail->parent('tours.index');
    $trail->push($obTour->title, route('tours.show', $tourId));
});

// Home > hotels
Breadcrumbs::for('hotels.index', function ($trail) {
    $trail->parent('index');
    $trail->push('Отели', route('hotels.index'));
});

// Home > hotels
Breadcrumbs::for('hotels.show', function ($trail, $hotelId) {
    $obHotel = \App\Modules\Hotel\Models\Hotel::find($hotelId);
    $trail->parent('hotels.index');
    $trail->push($obHotel->title, route('hotels.show', $hotelId));
});

// Home > countries
Breadcrumbs::for('countries.index', function ($trail) {
    $trail->parent('index');
    $trail->push('Страны', route('countries.index'));
});

// Home > countries
Breadcrumbs::for('countries.show', function ($trail, $countryId) {
    $obCountry = \App\Modules\Country\Models\Country::find($countryId);
    $trail->parent('countries.index');
    $trail->push($obCountry->title, route('countries.show', $countryId));
});


// Home > cities
Breadcrumbs::for('cities.show', function ($trail, $cityId) {
    $obCity = \App\Modules\City\Models\City::find($cityId);
    $trail->parent('index');
    $trail->push($obCity->title, route('cities.show', $cityId));
});


// Home > news
Breadcrumbs::for('news.index', function ($trail) {
    $trail->parent('index');
    $trail->push('Новости', route('news.index'));
});

// Home > news
Breadcrumbs::for('news.show', function ($trail, $newsId) {
    $obNews = \App\Modules\News\Models\News::find($newsId);
    $trail->parent('news.index');
    $trail->push($obNews->title, route('news.show', $newsId));
});

// Home > contacts
Breadcrumbs::for('contacts', function ($trail) {
    $trail->parent('index');
    $trail->push('Контакты', route('contacts'));
});

/////////////////////////////// Admin Breadcrumbs /////////////////////////////////////
Breadcrumbs::for('adminIndex', function ($trail) {
    $trail->push('Главная', route('adminIndex'));
});

// Admin > tours
Breadcrumbs::for('admin.tours.index', function ($trail) {
    $trail->parent('adminIndex');
    $trail->push('Туры', route('admin.tours.index'));
});

// Admin > tours > edit
Breadcrumbs::for('admin.tours.edit', function ($trail, $tourId) {
    $obTour = \App\Modules\Tour\Models\Tour::find($tourId);
    $trail->parent('admin.tours.index');
    $trail->push($obTour->title, route('admin.tours.edit', $tourId));
});

// Admin > tours > create
Breadcrumbs::for('admin.tours.create', function ($trail) {
    $trail->parent('admin.tours.index');
    $trail->push('Добавления тура', route('admin.tours.create'));
});



// Admin > hotels
Breadcrumbs::for('admin.hotels.index', function ($trail) {
    $trail->parent('adminIndex');
    $trail->push('Отели', route('admin.hotels.index'));
});

// Admin > hotels > edit
Breadcrumbs::for('admin.hotels.edit', function ($trail, $hotelId) {
    $obHotel = \App\Modules\Hotel\Models\Hotel::find($hotelId);
    $trail->parent('admin.hotels.index');
    $trail->push($obHotel->title, route('admin.hotels.edit', $hotelId));
});

// Admin > hotels > create
Breadcrumbs::for('admin.hotels.create', function ($trail) {
    $trail->parent('admin.hotels.index');
    $trail->push('Добавления отеля', route('admin.hotels.create'));
});



// Admin > countries
Breadcrumbs::for('admin.countries.index', function ($trail) {
    $trail->parent('adminIndex');
    $trail->push('Страны', route('admin.countries.index'));
});

// Admin > countries > edit
Breadcrumbs::for('admin.countries.edit', function ($trail, $countryId) {
    $obCountry = \App\Modules\Country\Models\Country::find($countryId);
    $trail->parent('admin.countries.index');
    $trail->push($obCountry->title, route('admin.countries.edit', $countryId));
});

// Admin > countries > create
Breadcrumbs::for('admin.countries.create', function ($trail) {
    $trail->parent('admin.countries.index');
    $trail->push('Добавления стран', route('admin.countries.create'));
});



// Admin > cities
Breadcrumbs::for('admin.cities.index', function ($trail) {
    $trail->parent('adminIndex');
    $trail->push('Городы', route('admin.cities.index'));
});

// Admin > cities > edit
Breadcrumbs::for('admin.cities.edit', function ($trail, $cityId) {
    $obCity = \App\Modules\City\Models\City::find($cityId);
    $trail->parent('admin.cities.index');
    $trail->push($obCity->title, route('admin.cities.edit', $cityId));
});

// Admin > cities > create
Breadcrumbs::for('admin.cities.create', function ($trail) {
    $trail->parent('admin.cities.index');
    $trail->push('Добавления города', route('admin.cities.create'));
});



// Admin > news
Breadcrumbs::for('admin.news.index', function ($trail) {
    $trail->parent('adminIndex');
    $trail->push('Новости', route('admin.news.index'));
});

// Admin > news > edit
Breadcrumbs::for('admin.news.edit', function ($trail, $newsId) {
    $obNews = \App\Modules\News\Models\News::find($newsId);
    $trail->parent('admin.news.index');
    $trail->push($obNews->title, route('admin.news.edit', $newsId));
});

// Admin > news > create
Breadcrumbs::for('admin.news.create', function ($trail) {
    $trail->parent('admin.news.index');
    $trail->push('Добавления новостей', route('admin.news.create'));
});



// Admin > menus
Breadcrumbs::for('admin.navigations.index', function ($trail) {
    $trail->parent('adminIndex');
    $trail->push('Меню', route('admin.navigations.index'));
});

// Admin > menus > edit
Breadcrumbs::for('admin.navigations.edit', function ($trail, $menuId) {
    $obMenu = \App\Modules\Navigation\Models\Navigation::find($menuId);
    $trail->parent('admin.navigations.index');
    $trail->push($obMenu->title, route('admin.navigations.edit', $menuId));
});

// Admin > menus > create
Breadcrumbs::for('admin.navigations.create', function ($trail) {
    $trail->parent('admin.navigations.index');
    $trail->push('Добавления меню', route('admin.navigations.create'));
});



// Admin > sliders
Breadcrumbs::for('admin.sliders.index', function ($trail) {
    $trail->parent('adminIndex');
    $trail->push('Слайдер', route('admin.sliders.index'));
});

// Admin > sliders > edit
Breadcrumbs::for('admin.sliders.edit', function ($trail, $menuId) {
    $obMenu = \App\Modules\Slider\Models\Slider::find($menuId);
    $trail->parent('admin.sliders.index');
    $trail->push($obMenu->title, route('admin.sliders.edit', $menuId));
});

// Admin > sliders > create
Breadcrumbs::for('admin.sliders.create', function ($trail) {
    $trail->parent('admin.sliders.index');
    $trail->push('Добавления слайдера', route('admin.sliders.create'));
});


// Admin > galleries
Breadcrumbs::for('admin.galleries.index', function ($trail) {
    $trail->parent('adminIndex');
    $trail->push('Галерея', route('admin.galleries.index'));
});

// Admin > galleries > edit
Breadcrumbs::for('admin.galleries.edit', function ($trail, $galleryId) {
    $obGalery = \App\Modules\Tour\Models\Gallery::find($galleryId);
    $trail->parent('admin.galleries.index');
    $trail->push($obGalery->name, route('admin.galleries.edit', $galleryId));
});

// Admin > galleries > create
Breadcrumbs::for('admin.galleries.create', function ($trail) {
    $trail->parent('admin.galleries.index');
    $trail->push('Добавления галереи', route('admin.galleries.create'));
});



// Admin > permissions
Breadcrumbs::for('admin.permissions.index', function ($trail) {
    $trail->parent('adminIndex');
    $trail->push('Привилегии', route('admin.permissions.index'));
});



// Admin > users
Breadcrumbs::for('admin.users.index', function ($trail) {
    $trail->parent('adminIndex');
    $trail->push('Пользователи', route('admin.users.index'));
});

// Admin > users > edit
Breadcrumbs::for('admin.users.edit', function ($trail, $userId) {
    $obUser = \App\Modules\User\Models\User::find($userId);
    $trail->parent('admin.users.index');
    $trail->push($obUser->name, route('admin.users.edit', $userId));
});

// Admin > users > create
Breadcrumbs::for('admin.users.create', function ($trail) {
    $trail->parent('admin.users.index');
    $trail->push('Добавления пользователя', route('admin.users.create'));
});
