<?php

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Supplement;

class DatabaseDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shops = factory(Restaurant::class, 5)->state('restaurant')->create();
        foreach($shops as $shop){
            $menus = factory(Menu::class, 5)->create(['restaurant_id' => $shop->id]);
            $itemCategories = factory(Category::class, 5)->state('items')->create(['restaurant_id' => $shop->id]);
            $supplementCategories = factory(Category::class, 5)->state('supplements')->create(['restaurant_id' => $shop->id]);
            for ($i=0; $i < 5; $i++) { 
                $shop->items()->save(factory(Item::class)->make([
                    'menu_id' => $menus->random()->id,
                    'category_id' => $itemCategories->random()->id,
                    'restaurant_id' => $shop->id
                ]));
                $shop->supplements()->save(factory(Supplement::class)->make([
                    'category_id' => $supplementCategories->random()->id,
                    'restaurant_id' => $shop->id
                ]));
            }
        }
    }
}
