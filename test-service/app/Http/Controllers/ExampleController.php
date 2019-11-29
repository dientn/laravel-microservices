<?php

namespace App\Http\Controllers;

use http\Env\Response;
//use App\Services\Clients\CoreServiceClient;
use App\Services\Clients\CoreServiceClient;

class ExampleController extends Controller
{
    /**
     * The user repository instance.
     */
    protected $client;

    /**
     * Create a new controller instance.
     *
     * @param  CoreServiceClient  $client
     * @return void
     */

    public function __construct(CoreServiceClient $client)
    {
        $this->client = $client;
    }
    /**
     * @SWG\Get(
     *     path="/home",
     *     description="Home page",
     *     @SWG\Response(response=200, description="Welcome page"),
     *     x={
     *        "roles": "admin",
     *    }
     * )
     */
    public function index (){
        return response()
            ->json('test service welcome');
    }

    /**
     * @SWG\Get(
     *     path="/info",
     *     description="Info page",
     *     @SWG\Response(response=200, description="Info page"),
     *     x={
     *        "roles": { "admin", "guest" },
     *    }
     * )
     */
    public function info (){
        $coreInfo = $this->client->getCoreInfo();
        return response()
            ->json(array(
                "message"=>'welcome to test service info page',
                "core_info"=> $coreInfo
                ));
    }
}
