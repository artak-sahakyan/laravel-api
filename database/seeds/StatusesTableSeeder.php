<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['Active', 'Inactive', 'Draft'];
        foreach ($statuses as $status) {
            DB::table('statuses')->insert([
                'name' => $status,
            ]);    
        }
        
    }
}
