<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = [
            [
                'name' => 'HTML',
                'logo' => '<i class="fa-brands fa-html5"></i>',
            ],
            [
                'name' => 'CSS',
                'logo' => '<i class="fa-brands fa-css3-alt"></i>',
            ],
            [
                'name' => 'JAVASCRIPT',
                'logo' => '<i class="fa-brands fa-js">',
            ],
            [
                'name' => 'VUE JS',
                'logo' => '<i class="fa-brands fa-vuejs"></i>',
            ],
            [
                'name' => 'SASS',
                'logo' => '<i class="fa-brands fa-sass"></i>',
            ],
            [
                'name' => 'LARAVEL',
                'logo' => '<i class="fa-brands fa-laravel"></i>',
            ],
            [
                'name' => 'BOOTSTRAP',
                'logo' => '<i class="fa-brands fa-bootstrap"></i>',
            ],
            [
                'name' => 'VITE',
                'logo' => '<i class="fa-brands fa-vimeo"></i>',
            ],
            [
                'name' => 'PHP',
                'logo' => '<i class="fa-brands fa-php"></i>',
            ],
           
            
        ];

        foreach ($technologies as $technology) {
            Technology::create($technology);
        }
    }
}
