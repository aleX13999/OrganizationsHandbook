<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitiesSeeder extends Seeder
{
    protected array $activities
        = [
            [
                'name'     => 'Еда',
                'children' => [
                    [
                        'name'     => 'Мясная продукция',
                        'children' => [
                            ['name' => 'Говядина'],
                            ['name' => 'Свинина'],
                            ['name' => 'Птица'],
                            ['name' => 'Колбасы'],
                        ],
                    ],
                    [
                        'name'     => 'Молочная продукция',
                        'children' => [
                            ['name' => 'Молоко'],
                            ['name' => 'Сыр'],
                            ['name' => 'Творог'],
                            ['name' => 'Кефир'],
                        ],
                    ],
                    [
                        'name'     => 'Овощи',
                        'children' => [
                            ['name' => 'Помидор'],
                            ['name' => 'Огурец'],
                            ['name' => 'Перец красный'],
                            ['name' => 'Морковь'],
                        ],
                    ],
                    [
                        'name'     => 'Фрукты',
                        'children' => [
                            ['name' => 'Яблоки'],
                            ['name' => 'Бананы'],
                            ['name' => 'Цитрусовые'],
                        ],
                    ],
                    [
                        'name'     => 'Напитки',
                        'children' => [
                            ['name' => 'Безалкогольные'],
                            ['name' => 'Алкогольные'],
                        ],
                    ],
                ],
            ],
            [
                'name'     => 'Автомобили',
                'children' => [
                    [
                        'name'     => 'Грузовые',
                        'children' => [
                            ['name' => 'Фуры'],
                            ['name' => 'Самосвалы'],
                        ],
                    ],
                    [
                        'name'     => 'Легковые',
                        'children' => [
                            ['name' => 'Седаны'],
                            ['name' => 'Хэтчбеки'],
                            ['name' => 'Кроссоверы'],
                            ['name' => 'Спортивные'],
                            ['name' => 'Запчасти'],
                            ['name' => 'Аксессуары'],
                        ],
                    ],
                    ['name' => 'Мотоциклы'],
                    ['name' => 'Электросамокаты'],
                ],
            ],
            [
                'name'     => 'Электроника',
                'children' => [
                    [
                        'name'     => 'Телефоны',
                        'children' => [
                            ['name' => 'Смартфоны'],
                            ['name' => 'Кнопочные'],
                        ],
                    ],
                    [
                        'name'     => 'Компьютеры',
                        'children' => [
                            ['name' => 'Ноутбуки'],
                            ['name' => 'Настольные ПК'],
                            ['name' => 'Комплектующие'],
                        ],
                    ],
                    [
                        'name'     => 'Аудио',
                        'children' => [
                            ['name' => 'Наушники'],
                            ['name' => 'Колонки'],
                        ],
                    ],
                ],
            ],
            [
                'name'     => 'Строительство',
                'children' => [
                    [
                        'name'     => 'Материалы',
                        'children' => [
                            ['name' => 'Кирпич'],
                            ['name' => 'Цемент'],
                            ['name' => 'Дерево'],
                        ],
                    ],
                    [
                        'name'     => 'Инструменты',
                        'children' => [
                            ['name' => 'Электроинструменты'],
                            ['name' => 'Ручные инструменты'],
                        ],
                    ],
                    ['name' => 'Отделка'],
                ],
            ],
        ];

    public function run(): void
    {
        $this->createActivities($this->activities);
    }

    private function createActivities(array $activities, ?int $parentId = null, string $path = '', int $level = 0): void
    {
        foreach ($activities as $activity) {
            $children = $activity['children'] ?? [];
            unset($activity['children']);

            $activity['parent_id'] = $parentId;
            $activity['path']      = $path . $parentId . '/';
            $activity['level']     = $level;
            $created               = Activity::firstOrCreate($activity);

            if (!empty($children)) {
                $this->createActivities($children, $created->id, $path . $parentId . '/', $level + 1);
            }
        }
    }
}
