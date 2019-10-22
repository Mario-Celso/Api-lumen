<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\Customer;
use App\Provider;
use App\ProviderContact;
use App\Contact;
use App\User;
use Carbon\Carbon;
use Faker\Generator;

/**
 * User
 */

$factory->define(App\User::class, function (Faker\Generator $faker) {

    return [
        'full_name' => $faker->name,
        'email' => $faker->email,
        'access_user' => $faker->userName,
        'pass_user' => hash('sha512', 'mudar'.env('APP_KEY')),
        'city_id' => 9480,
        'logged' => false,
        'role' => 'Mananger',
        'last_activity_on' => Carbon::now('America/Sao_Paulo')
    ];
});

$factory->defineAs('App\User', 'toLogin', function () use ($factory) {
    /** @noinspection PhpUndefinedMethodInspection */
    $user = $factory->raw('App\User');

    return array_merge($user, ['logged' => true]);
});

/**
 * Provider
 */

$factory->define(Provider::class, function (Faker\Generator $faker) {

    return [
        'status_id' => 1,
        'trade_name' => $faker->company,
        'company_name' => $faker->company,
        'logo_url' => $faker->url,
        'federal_tax_id' => $faker->text(14),
        'state_tax_id' => $faker->text(14),
        'city_tax_id' => $faker->text(14),
        'creationing_date' => $faker->dateTime,
        'opening_date' => $faker->dateTime,
        'balance' => $faker->randomNumber(1),
        'address_1' => $faker->streetName,
        'address_2' => $faker->address,
        'address_3' => $faker->address,
        'address_number' => $faker->randomNumber(2),
        'zipcode' => $faker->randomNumber(8),
        'city_id' => 9480,
        'note' => $faker->sentence
    ];
});

/**
 * ProviderContact
 */

$factory->define(ProviderContact::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
    ];
});

/**
 * Customer
 */
$factory->define(Customer::class, function (Faker\Generator $faker) {
    return [
        'active' => true,
        'status_id' => 1,
        'balance' => $faker->numberBetween(0, 10),
        'address_1' => $faker->address,
        'address_2' => $faker->address,
        'address_3' => $faker->address,
        'address_number' => $faker->numberBetween(0, 100),
        'zipcode' => $faker->postcode,
        'city_id' => 9480,
        'notes' => $faker->sentence,
        'created_at' => Carbon::now(config('app.timezone')),
        'updated_at' => Carbon::now(config('app.timezone')),
        'name' => $faker->name,
        'birthdate' => $faker->date(),
        'nickname' => $faker->name,
        'logo_url' => $faker->url,
        'state_tax_id' => null,
        'city_tax_id' => null,

    ];
});

/**
 * Contacts
 */

$factory->define(Contact::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
    ];
});



