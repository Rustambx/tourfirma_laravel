<?php

namespace Tests;

use App\Modules\User\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseTransactions;

    public function getUser()
    {
        $user = User::where('login', 'Test')->first();

        return $user;
    }
}
