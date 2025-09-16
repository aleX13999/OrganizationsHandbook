<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Organization;
use App\Models\OrganizationPhone;
use Illuminate\Database\Seeder;

class OrganizationsSeeder extends Seeder
{
    public function run()
    {
        $org1 = $this->createOrganization('ООО Рога и Копыта', 1);
        $this->createOrganizationPhone($org1->id, fake()->phoneNumber());
        $this->createOrganizationPhone($org1->id, fake()->phoneNumber());
        $meatActivity  = Activity::where('name', 'Мясная продукция')->first();
        $dairyActivity = Activity::where('name', 'Молочная продукция')->first();
        $org1->activities()->syncWithoutDetaching([$meatActivity->id, $dairyActivity->id]);

        $org2 = $this->createOrganization('Напитки', 1);
        $this->createOrganizationPhone($org2->id, fake()->phoneNumber());
        $drinkActivity  = Activity::where('name', 'Безалкогольные')->first();
        $org2->activities()->syncWithoutDetaching([$drinkActivity->id]);

        $org3 = $this->createOrganization('ООО Центр запчастей', 2);
        $this->createOrganizationPhone($org3->id, fake()->phoneNumber());
        $this->createOrganizationPhone($org3->id, fake()->phoneNumber());
        $this->createOrganizationPhone($org3->id, fake()->phoneNumber());
        $toolsActivity  = Activity::where('name', 'Запчасти')->first();
        $org3->activities()->syncWithoutDetaching([$toolsActivity->id]);

        $org4 = $this->createOrganization('ООО Тяжеловес', 2);
        $this->createOrganizationPhone($org4->id, fake()->phoneNumber());
        $this->createOrganizationPhone($org4->id, fake()->phoneNumber());
        $auto1Activity  = Activity::where('name', 'Фуры')->first();
        $auto2Activity  = Activity::where('name', 'Самосвалы')->first();
        $org4->activities()->syncWithoutDetaching([$auto1Activity->id, $auto2Activity->id]);

        $org5 = $this->createOrganization('ООО Маловес', 2);
        $this->createOrganizationPhone($org5->id, fake()->phoneNumber());
        $this->createOrganizationPhone($org5->id, fake()->phoneNumber());
        $auto3Activity  = Activity::where('name', 'Легковые')->first();
        $org5->activities()->syncWithoutDetaching([$auto3Activity->id]);

        $org6 = $this->createOrganization('ООО NDS', 3);
        $this->createOrganizationPhone($org6->id, fake()->phoneNumber());
        $this->createOrganizationPhone($org6->id, fake()->phoneNumber());
        $this->createOrganizationPhone($org6->id, fake()->phoneNumber());
        $electricActivity  = Activity::where('name', 'Электроника')->first();
        $org6->activities()->syncWithoutDetaching([$electricActivity->id]);

        $org7 = $this->createOrganization('ООО Цемент', 4);
        $this->createOrganizationPhone($org7->id, fake()->phoneNumber());
        $cementActivity  = Activity::where('name', 'Цемент')->first();
        $org7->activities()->syncWithoutDetaching([$cementActivity->id]);

        $org8 = $this->createOrganization('ООО Электроинструменты', 4);
        $this->createOrganizationPhone($org8->id, fake()->phoneNumber());
        $this->createOrganizationPhone($org8->id, fake()->phoneNumber());
        $elecToolsActivity  = Activity::where('name', 'Электроинструменты')->first();
        $org8->activities()->syncWithoutDetaching([$elecToolsActivity->id]);

        $org9 = $this->createOrganization('ООО Инструменты', 4);
        $this->createOrganizationPhone($org9->id, fake()->phoneNumber());
        $this->createOrganizationPhone($org9->id, fake()->phoneNumber());
        $handToolsActivity  = Activity::where('name', 'Ручные инструменты')->first();
        $org9->activities()->syncWithoutDetaching([$elecToolsActivity->id, $handToolsActivity->id]);

        $org10 = $this->createOrganization('ООО Телефония', 4);
        $this->createOrganizationPhone($org10->id, fake()->phoneNumber());
        $phoneActivity  = Activity::where('name', 'Телефоны')->first();
        $org10->activities()->syncWithoutDetaching([$phoneActivity->id]);

        $org10 = $this->createOrganization('ООО Вощи', 5);
        $this->createOrganizationPhone($org10->id, fake()->phoneNumber());
        $vegetableActivity  = Activity::where('name', 'Овощи')->first();
        $org10->activities()->syncWithoutDetaching([$vegetableActivity->id]);
    }

    private function createOrganization(string $title, int $buildingId): Organization
    {
        return Organization::firstOrCreate(
            [
                'name'        => $title,
                'building_id' => $buildingId,
            ],
        );
    }

    private function createOrganizationPhone($organizationId, $phone): void
    {
        OrganizationPhone::firstOrCreate(
            [
                'organization_id' => $organizationId,
                'phone_number'    => $phone,
            ],
        );
    }
}
