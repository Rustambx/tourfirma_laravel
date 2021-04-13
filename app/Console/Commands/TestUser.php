<?php

namespace App\Console\Commands;

use App\Modules\RBAC\Models\Role;
use App\Modules\User\Models\User;
use Illuminate\Console\Command;

class TestUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $password = '12345678';
        $role = Role::where('name', 'Admin')->first();

        $user = User::create([
            'name' => 'Test',
            'login' => 'Test',
            'email' => 'test@mail.ru',
            'password' => bcrypt($password)
        ]);

        if ($user) {
            $user->roles()->attach($role->id);
        }
    }
}
