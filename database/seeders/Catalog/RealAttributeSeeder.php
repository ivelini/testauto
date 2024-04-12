<?php

namespace Database\Seeders\Catalog;

use App\Models\Catalog\RealComplectAttribute;
use Illuminate\Database\Seeder;

class RealAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            'Активная безопасность',
            'Пассивная безопасность',
            'Противоугонная система',
            'Помощь при вождении',
            'Комфорт',
            'Управление климатом и обогрев',
            'Мультимедиа и навигация',
            'Салон и интерьер',
            'Экстерьер',
            'Освещение',
            'Комплектность',
        ];

        if(RealComplectAttribute::query()->count() == 0) {
            RealComplectAttribute::insert(array_map(fn ($name) => ['name' => $name], $values));
        }
    }
}
