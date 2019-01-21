<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'url'=>$faker->unique(),
        'parent'=>$faker->exist,
    ];
});
