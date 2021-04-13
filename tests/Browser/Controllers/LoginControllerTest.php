<?php

namespace Tests\Browser\Controllers;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginControllerTest extends DuskTestCase
{
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $user = $this->getUser();

            $browser->loginAs($user)->visit('/admin')
                ->assertPathIs('/admin')
                ->assertSee('Добро пожаловать в Админ панель');
        });
    }
}
