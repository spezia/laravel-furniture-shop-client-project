
<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        $category = new Category;
        $category->setTranslations('name', [
            'en' => 'Kitchen',
            'de' => 'Küche',
            'fr' => 'Cuisine',
            'it' => 'Cucina',
        ]);
        $category->save();

        $category = new Category;
        $category->setTranslations('name', [
            'en' => 'Bedrooms',
            'de' => 'Schlafzimmer',
            'fr' => 'Chambres à Coucher',
            'it' => 'Camere da letto',
        ]);
        $category->save();
    }
}
