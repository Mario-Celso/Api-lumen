<?php


use App\Contact;
use App\User;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CustomerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var User
     */

    private $user;

    private $customer;

    private $contacts;

    public function setUp():void
    {
        parent::setUp();


        $this->user = factory('App\User')->create([

        ]);

//        /**
//         * Clientes de teste
//         */
//
//        $this->customer = factory('App\Customer')->create([
//        ]);
//
//        $this->contacts = factory('App\Contact')->create([
//            'customer_id' => $this->customer->id
//        ]);

    }

    public function testCreate()
    {
        $this->actingAs($this->user)->json('POST', '/v1/customers', [
            'name' => 'Teste da Silva',
            'status_id' => '1',
            'birthdate'=> '1990-12-01',
            'address_1'=> 'Av Paulista',
            'address_2'=> 'Av Brasil',
            'address_3'=> 'Av Rebouças',
            'address_number'=> '39',
            'zipcode'=> '12040000',
            'city_id'=> 9480,
            'notes'=> 'O filho do Joaquim',
            'balance' => 10.0,
            'nickname' => 'Jones',
            'logo_url' => 'https://google.com',
            'state_tax_id' => '1234567890',
            'city_tax_id' => '1234567890',
            'contacts' => [
                [
                    'email' => 'test@test.com',
                    'phone' => '1234567890',
                    'name' => 'João',
                    'description' => 'Apenas teste'
                ]
            ]
        ]);

        $this->assertEquals(201, $this->response->getStatusCode());

        $seeInDatabase = [
            'name'=> 'Teste da Silva', //obrigatório
            'status_id' => 1,
            'birthdate'=> '1990-12-01',
            'address_1'=> 'Av Paulista',
            'address_2'=> 'Av Brasil',
            'address_3'=> 'Av Rebouças',
            'address_number'=> 39,
            'zipcode'=> '12040000',
            'city_id'=> 9480,
            'notes'=> 'O filho do Joaquim',
            'balance' => 10,
            'nickname' => 'Jones',
            'logo_url' => 'https://google.com',
            'state_tax_id' => '1234567890',
            'city_tax_id' => '1234567890',
           'contacts' => [
               [
                    'email' => 'test@test.com',
                    'phone' => '1234567890',
                    'name' => 'João',
                    'description ' => 'Apenas teste'
                ]
           ]
        ];

        $seeInDatabaseContact =  [

            'email' => 'test@test.com',
            'phone' => '1234567890',
            'name' => 'João',
            'description ' => 'Apenas teste'

        ];

        foreach ($seeInDatabase as $field => $value) {
            $this->seeInDatabase('customers', [$field => $value]);
        }

        $this->seeInDatabase('customers', $seeInDatabase);


        foreach ($seeInDatabaseContact as $field => $value) {
            $this->seeInDatabase('contacts', [$field => $value]);
        }

        $this->seeInDatabase('contacts', $seeInDatabaseContact);
    }

    public function testList()
    {
        $customer = factory('App\Customer')->create([]);

        $customer->contacts()->save(factory(Contact::class)->make());

        $this->actingAs($this->user)->get('/v1/customers');

        $this->assertEquals(200, $this->response->getStatusCode());

//        $this->seeJsonStructure([
//        [
//            '*' =>[
//                'id',
//                'balance',
//                'name',
//                'birthdate',
//                'status_id',
//                'address_1',
//                'address_2',
//                'address_3',
//                'address_number',
//                'zipcode',
//                'city_id',
//                'notes',
//                'nickname',
//                'logo_url',
//                'state_tax_id',
//                'city_tax_id',
//                'contacts' => [
//                    [   'email',
//                        'phone',
//                        'name',
//                        'description'
//                    ]
//                ]
//            ]
//            ]
//        ]);
    }

    public function testEdit()
    {
        /** @var Customer $customer */
        $customer = factory('App\Customer')->create([ ]);

        $customer->contacts()->save(factory(Contact::class)->make());

        $this->actingAs($this->user)->json('PATCH', '/v1/customers/'.$customer->id, [
            'name' => 'Teste da Silva',
            'status_id' => '1',
            'birthdate'=> '1990-12-01',
            'address_1'=> 'Av Paulista',
            'address_2'=> 'Av Brasil',
            'address_3'=> 'Av Rebouças',
            'address_number'=> '39',
            'zipcode'=> '12040000',
            'city_id'=> 9480,
            'notes'=> 'O filho do Joaquim',
            'balance' => 10.0,
            'nickname' => 'Jones',
            'logo_url' => 'https://google.com',
            'state_tax_id' => '1234567890',
            'city_tax_id' => '1234567890',
            'contacts' => [
                [
                    'email' => 'test@test.com',
                    'phone' => '1234567890',
                    'name' => 'João',
                    'description' => 'Apenas teste'
                ]
            ]
        ]);

        $this->assertEquals(200, $this->response->getStatusCode());
//
//        $this->seeJson([
//            'id' => $customer->id
//        ]);

        $seeInDatabase = [
            'name' => 'Teste da Silva',
            'status_id' => '1',
            'birthdate'=> '1990-12-01',
            'address_1'=> 'Av Paulista',
            'address_2'=> 'Av Brasil',
            'address_3'=> 'Av Rebouças',
            'address_number'=> '39',
            'zipcode'=> '12040000',
            'city_id'=> 9480,
            'notes'=> 'O filho do Joaquim',
            'balance' => 10.0,
            'nickname' => 'Jones',
            'logo_url' => 'https://google.com',
            'state_tax_id' => '1234567890',
            'city_tax_id' => '1234567890',
        ];

        $seeInDatabaseContact = [
            'name' => 'Fernando',
            'phone' => '12345678901',
            'email' => 'acs@acs.com.br',
            'description' => 'Apenas teste'
        ];


        foreach ($seeInDatabase as $field => $value) {
            $this->seeInDatabase('customers', [$field => $value]);
        }

        $this->seeInDatabase('customers', $seeInDatabase);

        foreach ($seeInDatabaseContact as $field => $value) {
            $this->seeInDatabase('contacts', [$field => $value]);
        }

        $this->seeInDatabase('contacts', $seeInDatabaseContact);
    }

    public function testDelete()
    {
        $customer = factory('App\Customer')->create([ ]);

        $this->actingAs($this->user)->delete('/v1/customers/'.$customer->id);

        $this->assertEquals(200, $this->response->getStatusCode());

        $this->seeInDatabase('customers', ['active' => false, 'id' => $customer->id]);
    }
}
