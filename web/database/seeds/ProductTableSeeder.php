<?php

use App\Category;
use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Media::truncate();
        Product::truncate();
        Schema::enableForeignKeyConstraints();

        $imageUrl = 'https://via.placeholder.com/300';

        $model = new Product;
        $model->setTranslations('name', [
            'en' => 'Chair',
            'de' => 'Stuhl',
            'fr' => 'Chaise',
            'it' => 'Sedia',
        ]);
        $model->setTranslations('description', [
            'en' => 'Quality aluminum chair.',
            'de' => 'Qualitäts-Aluminiumstuhl.',
            'fr' => 'Chaise en aluminium de qualité.',
            'it' => 'Sedia in alluminio di qualità.',
        ]);
        $model->price = 135;
        $model->category_id = Category::first()->id;
        $model->addMediaFromUrl($imageUrl)->toMediaCollection(\config('custom.media.product'));
        $model->save();

        $model = new Product;
        $model->setTranslations('name', [
            'en' => 'Kitchen table',
            'de' => 'Küchentisch',
            'fr' => 'Table de cuisine',
            'it' => 'Tavolo della cucina',
        ]);
        $model->setTranslations('description', [
            'en' => 'Kitchen table for 8 people full of wood.',
            'de' => 'Küchentisch für 8 Personen voller Holz.',
            'fr' => 'Table de cuisine pour 8 personnes pleine de bois.',
            'it' => 'Tavolo da cucina per 8 persone pieno di legno.',
        ]);
        $model->price = 219.99;
        $model->category_id = Category::first()->id;
        $model->addMediaFromUrl($imageUrl)->toMediaCollection(\config('custom.media.product'));
        $model->addMediaFromUrl($imageUrl)->toMediaCollection(\config('custom.media.product'));
        $model->save();
    }
}
