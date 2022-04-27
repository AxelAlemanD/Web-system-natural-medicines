<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::factory()->count(3)->create(
            new Sequence(
                ['name' => 'Pendiente'],
                ['name' => 'En proceso'],
                ['name' => 'Pagado'],
            )
        );
    }
}
