<?php


use App\Provider;
use App\ProviderContact;
use App\User;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProviderTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var User
     */
    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory('App\User')->create([ ]);
    }

    public function testCreate()
    {

        $this->actingAs($this->user)->json('POST', '/v1/providers', [
            'trade_name' => 'test',
            'city_id' => '9480',
            'company_name' => 'Test LTDA',
            'logo_url' => 'logoUrl',
            'federal_tax_id' => '16020899000144',
            'state_tax_id' => '1234567890',
            'city_tax_id' => '1234567890',
            'creationing_date' => '2018-12-01',
            'opening_date' => '2018-12-01',
            'balance' => 20,
            'address_1' => 'Av Brasil',
            'address_2' => 'Av Paulista',
            'address_3' => 'Av Rebouças',
            'address_number' => 39,
            'zipcode' => '12040000',
            'note' => 'O que dá desconto na madeira',
            'status_id' => 1,
            'providers_contacts' => [
                [
                    'name' => 'Fernando',
                    'phone' => '12345678901',
                    'email' => 'acs@acs.com.br',
                    'description' => 'Apenas teste'
                ]
            ]
        ]);


        $this->assertEquals(201, $this->response->getStatusCode());

        $seeInDatabase = [
            'trade_name' => 'test',
            'city_id' => '9480',
            'company_name' => 'Test LTDA',
            'logo_url' => 'logoUrl',
            'federal_tax_id' => '16020899000144',
            'state_tax_id' => '1234567890',
            'city_tax_id' => '1234567890',
            'creationing_date' => '2018-12-01',
            'opening_date' => '2018-12-01',
            'balance' => 20,
            'address_1' => 'Av Brasil',
            'address_2' => 'Av Paulista',
            'address_3' => 'Av Rebouças',
            'address_number' => 39,
            'zipcode' => '12040000',
            'note' => 'O que dá desconto na madeira',
            'status_id' => 1
        ];

        $seeInDatabaseContact = [
            'name' => 'Fernando',
            'phone' => '12345678901',
            'email' => 'acs@acs.com.br',
            'description' => 'Apenas teste'
        ];

        foreach ($seeInDatabase as $field => $value) {
            $this->seeInDatabase('providers', [$field => $value]);
        }

        $this->seeInDatabase('providers', $seeInDatabase);


        foreach ($seeInDatabaseContact as $field => $value) {
            $this->seeInDatabase('providers_contacts', [$field => $value]);
        }

        $this->seeInDatabase('providers_contacts', $seeInDatabaseContact);
    }

    public function testList()
    {
        $provider = factory('App\Provider')->create([ ]);

        $provider->providers_contacts()->save(factory(ProviderContact::class)->make());

        $this->actingAs($this->user)->get('/v1/providers');

        $this->assertEquals(200, $this->response->getStatusCode());


        $this->seeJsonStructure([
           [
                'id',
                'trade_name',
                'providers_contacts' => [
                    '*' => [
                        'name',
                        'email',
                        'phone',
                        'description'
                    ]
                ]
            ]
        ]);
    }

    public function testEdit()
    {
        /** @var Provider $provider */
        $provider = factory('App\Provider')->create([ ]);

        $provider->providers_contacts()->save(factory(ProviderContact::class)->make());

        $this->actingAs($this->user)->json('PATCH', '/v1/providers/'.$provider->id, [
            'trade_name' => 'test edited',
            'city_id' => 9481,
            'company_name' => 'Test LTDA Edited',
            'logo_url' => 'logoUrlEdited',
            'federal_tax_id' => '16020899000144',
            'state_tax_id' => '1234567891',
            'city_tax_id' => '1234567891',
            'creationing_date' => '2018-12-02',
            'opening_date' => '2018-12-02',
            'balance' => 21,
            'address_1' => 'Av Brasil E',
            'address_2' => 'Av Paulista E',
            'address_3' => 'Av Rebouças E',
            'address_number' => 40,
            'zipcode' => '12040001',
            'note' => 'O que dá desconto na madeira E',
            'status_id' => 2,
            'providers_contacts' => [
                [
                    'name' => 'Fernando',
                    'phone' => '12345678901',
                    'email' => 'acs@acs.com.br',
                    'description' => 'Apenas teste'
                ]
            ]
        ]);

        $this->assertEquals(200, $this->response->getStatusCode());

        $this->seeJson([
            'id' => $provider->id
        ]);

        $seeInDatabase = [
            'trade_name' => 'test edited',
            'city_id' => 9481,
            'company_name' => 'Test LTDA Edited',
            'logo_url' => 'logoUrlEdited',
            'federal_tax_id' => '16020899000144',
            'state_tax_id' => '1234567891',
            'city_tax_id' => '1234567891',
            'creationing_date' => '2018-12-02',
            'opening_date' => '2018-12-02',
            'balance' => 21,
            'address_1' => 'Av Brasil E',
            'address_2' => 'Av Paulista E',
            'address_3' => 'Av Rebouças E',
            'address_number' => 40,
            'zipcode' => '12040001',
            'note' => 'O que dá desconto na madeira E',
            'status_id' => 2
        ];

        $seeInDatabaseContact = [
            'name' => 'Fernando',
            'phone' => '12345678901',
            'email' => 'acs@acs.com.br',
            'description' => 'Apenas teste'
        ];


        foreach ($seeInDatabase as $field => $value) {
            $this->seeInDatabase('providers', [$field => $value]);
        }

        $this->seeInDatabase('providers', $seeInDatabase);

        foreach ($seeInDatabaseContact as $field => $value) {
            $this->seeInDatabase('providers_contacts', [$field => $value]);
        }

        $this->seeInDatabase('providers_contacts', $seeInDatabaseContact);
    }

    public function testDelete()
    {
        $provider = factory('App\Provider')->create([ ]);

        $this->actingAs($this->user)->delete('/v1/providers/'.$provider->id);

        $this->assertEquals(200, $this->response->getStatusCode());

        $this->seeInDatabase('providers', ['active' => false, 'id' => $provider->id]);
    }
}
