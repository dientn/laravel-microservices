<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
/*        $mock = Mockery::mock(<Service class>::class);
        $coreClient->shouldReceive('<Service function>')
            ->once()// if call 1 time
            ->andReturn(<data return>);
        //        bind to instance container
        //        when actions of controller or other function call Service function the result will your set on mock
        $this->app->instance(<Service class>::class, $mock);
        $coreData = ["message"=> "welcome to core test"];
        // example with App\Services\Clients\CoreServiceClient
        $coreClient = Mockery::mock(App\Services\Clients\CoreServiceClient::class);
        $coreClient->shouldReceive('getCoreInfo')
            ->once()
            ->andReturn($coreData);

        $this->app->instance(App\Services\Clients\CoreServiceClient::class, $coreClient);
        // call from mock
        $result = $coreClient->getCoreInfo();
        $this->assertJson(json_encode($coreData), json_encode($result));
        // call from http the action of path '/' will call function getCoreInfo
         $this->get('/');
        $response->seeJsonEquals(["message"=>"welcome to test service info page","core_info"=>$coreData]);
*/
//        $result
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }
}
