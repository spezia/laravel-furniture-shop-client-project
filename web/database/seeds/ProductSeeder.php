<?php

use App\Category;
use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imageUrl = 'https://dummyimage.com/300x200/999/fff&text=Placeholder';

        for ($i = 10; $i <= 19; $i++) {

            for ($j = 1; $j <= 10; $j++) {
                $model = new Product;
                $model->setTranslations('name', [
                    'en' => 'Chair ' . $i . $j,
                    'de' => 'Stuhl ' . $i . $j,
                    'fr' => 'Chaise ' . $i . $j,
                    'it' => 'Sedia ' . $i . $j,
                ]);
                $model->setTranslations('description', [
                    'en' => 'Quality aluminum chair.',
                    'de' => 'Qualitäts-Aluminiumstuhl.',
                    'fr' => 'Chaise en aluminium de qualité.',
                    'it' => 'Sedia in alluminio di qualità.',
                ]);
                $model->setTranslations('properties', [
                    'en' => 'height: 180,weight: 120,length:50',
                    'de' => 'height: 180,weight: 120,length:50',
                    'fr' => 'height: 180,weight: 120,length:50',
                    'it' => 'height: 180,weight: 120,length:50',
                ]);
                $model->price = rand(219.99, 319.99);
                $model->code = 'A ' . rand(111, 999);
                $model->category_id = Category::where('id', $j)->first()->id;
                $model->addMediaFromUrl($imageUrl)->toMediaCollection(\config('custom.media.product'));
                $model->save();

                $model = new Product;
                $model->setTranslations('name', [
                    'en' => 'Kitchen table ' . $i . $j,
                    'de' => 'Küchentisch ' . $i . $j,
                    'fr' => 'Table de cuisine ' . $i . $j,
                    'it' => 'Tavolo della cucina ' . $i . $j,
                ]);
                $model->setTranslations('description', [
                    'en' => 'Kitchen table for 8 people full of wood.',
                    'de' => 'Küchentisch für 8 Personen voller Holz.',
                    'fr' => 'Table de cuisine pour 8 personnes pleine de bois.',
                    'it' => 'Tavolo da cucina per 8 persone pieno di legno.',
                ]);
                $model->setTranslations('properties', [
                    'en' => 'height: 180,weight: 120,length:50',
                    'de' => 'height: 180,weight: 120,length:50',
                    'fr' => 'height: 180,weight: 120,length:50',
                    'it' => 'height: 180,weight: 120,length:50',
                ]);
                $model->price = rand(219.99, 319.99);
                $model->code = 'B ' . rand(111, 999);
                $model->category_id = Category::where('id', $j)->first()->id;
                $model->addMediaFromUrl($imageUrl)->toMediaCollection(\config('custom.media.product'));
                $model->addMediaFromUrl($imageUrl)->toMediaCollection(\config('custom.media.product'));
                $model->save();
            }
        }
    }
}
