<?php

use Illuminate\Database\Seeder;
use App\OptionTerm;

class OptionTermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $option_terms = array(
            ['description' => "3 Meses", 'percent' => 5, "term" => 3],
            ['description' => "6 Meses", 'percent' => 7, "term" => 6],
            ['description' => "9 Meses", 'percent' => 12, "term" => 9],
        );

        foreach ($option_terms as $option) {
           	OptionTerm::create([
                'description' => $option['description'],
                'percent' => $option['percent'],
                'term' => $option['term']
            ]);
        }
    }
}
