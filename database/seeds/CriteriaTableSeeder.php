<?php

use Illuminate\Database\Seeder;
use App\Models\Criteria;

class CriteriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criteria = [
            ["name" => "temperature", "type" => "order"],
            ["name" => "portion size", "type" => "order"],
            ["name" => "taste", "type" => "order"],
            ["name" => "presentation", "type" => "order"],
            ["name" => "other", "type" => "order"],
            ["name" => "temperature", "type" => "shipping"],
            ["name" => "lack of professionalism", "type" => "shipping"],
            ["name" => "Waiting too long", "type" => "shipping"],
            ["name" => "damaged command", "type" => "shipping"],
            ["name" => "delivered at the wrong door", "type" => "shipping"],
            ["name" => "damaged dish", "type" => "shipping"],
            ["name" => "ignored shipping instructions", "type" => "shipping"],
            ["name" => "invalid vehicle", "type" => "shipping"],
            ["name" => "shipping id error", "type" => "shipping"],
            ["name" => "other", "type" => "shipping"]
        ];

        foreach ($criteria as $criterion) {
            Criteria::firstOrCreate(['name' => $criterion['name']], [
                'name'   => $criterion['name'],
                'type' => $criterion['type'],
            ]);
        }
    }
}
