<?php /** @noinspection ALL */

use Laravel\Lumen\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{

    use DatabaseTransactions;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();


        $user = factory('App\User', 'toLogin')->create();

        $this->user = $user;

    }

    /**
     * A test of Login.
     *
     * @return void
     */
    public function testValidLogin()
    {

        $this->json('POST', '/v1/auth', [
            'email' => 'acs@sistemaacs.com.br',
            'pass_user' => 'mudar'
        ]);

        $this->assertEquals(200, $this->response->getStatusCode());

        $this->seeJsonStructure([
            'token',
            'name'
        ]);

        $this->seeInDatabase('users', [
            'id' => $this->user->id,
            'logged' => true
        ]);
    }

    public function testInvalidLogin()
{
    $this->json('POST', '/v1/auth', [
        'email' => 'abc@123.com.br',
        'pass_user' => 'teste'
    ]);

    $this->assertEquals(401, $this->response->getStatusCode());

}
    public function testLogout()
    {
        $this->actingAs($this->user)->get('/v1/logout');

        $this->assertResponseStatus(200);

        $this->seeInDatabase('users', [
            'id' => $this->user->id,
            'logged' => false
        ]);

        $this->seeJsonEquals([
            'message' => 'Desligamento feito com sucesso!'
        ]);
    }
}
