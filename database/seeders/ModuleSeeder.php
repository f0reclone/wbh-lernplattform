<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Module;
use App\Models\User;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->first();
        Module::factory()->createMany([
            [
                'name' => 'Module 1',
                'user_id' => $user->id,
                // more props
            ],
            [
                'name' => 'Module 2',
                'user_id' => $user->id,
                // more props
            ],
        ]);
    }
}
