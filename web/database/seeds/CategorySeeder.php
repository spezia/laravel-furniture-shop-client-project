
<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            $category = new Category;
            $category->setTranslations('name', [
                'en' => 'Kitchen ' . $i,
                'de' => 'Küche ' . $i,
                'fr' => 'Cuisine ' . $i,
                'it' => 'Cucina ' . $i,
            ]);
            $category->setTranslations('description', [
                'en' => 'Simple and minimalist shades',
                'de' => 'Einfache und minimalistische Farben',
                'fr' => 'Nuances simples et minimalistes',
                'it' => 'Tonalità semplici e minimaliste',
            ]);
            $category->save();

            $category = new Category;
            $category->setTranslations('name', [
                'en' => 'Bedrooms ' . $i,
                'de' => 'Schlafzimmer ' . $i,
                'fr' => 'Chambres à Coucher ' . $i,
                'it' => 'Camere da letto ' . $i,
            ]);
            $category->setTranslations('description', [
                'en' => 'Different design of modern furniture',
                'de' => 'Anderes Design moderner Möbel',
                'fr' => 'Conception différente de meubles modernes',
                'it' => 'Design diverso di mobili moderni',
            ]);
            $category->save();
        }
    }
}
