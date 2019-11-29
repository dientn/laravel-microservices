<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Laravel\Lumen\Testing\WithoutMiddleware;
use App\Services\Clients\CoreServiceClient;
use App\Services;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $coreData = ["message"=> "welcome to core test"];
        $coreClient = Mockery::mock(CoreServiceClient::class);
        $coreClient->shouldReceive('getCoreInfo')
//            ->once() // if call 1 time
            ->andReturn($coreData);
        $this->app->instance(CoreServiceClient::class, $coreClient);

        // mock function
        $result = $coreClient->getCoreInfo();
        $this->assertJson(json_encode($coreData), json_encode($result));

        $response = $this->get('/test/info');
        $response->seeJsonEquals(["message"=>"welcome to test service info page","core_info"=>$coreData]);
    }
}
