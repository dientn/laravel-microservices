<?php

namespace App\Http\Controllers;

use http\Env\Response;
use App\Services\Clients\TestServiceClient;

class ExampleController extends Controller
{
    /**
     * The user repository instance.
     */
    protected $client;

    /**
     * Create a new controller instance.
     *
     * @param  TestServiceClient  $client
     * @return void
     */

    public function __construct(TestServiceClient $client)
    {
        $this->client = $client;
    }
    /**
     * @SWG\Get(
     *     path="/home",
     *     description="Home page",
     *     @SWG\Response(response=200, description="Welcome page"),
     *     x={
     *        "authorizes": "admin",
     *    }
     * )
     */
    public function index (){
        return response()
            ->json('welcome');
    }

    /**
     * @SWG\Get(
     *     path="/info",
     *     description="Info page",
     *     @SWG\Response(response=200, description="Info page"),
     *     x={
     *        "authorizes": { "admin", "guest" },
     *    }
     * )
     */
    public function info (){
        dd($this->client);
        return response()
            ->json('welcome to info page');
    }
}
