<?php


namespace App\Services\Clients;

use App\Services\RestClient;

class CoreServiceClient extends RestClient
{
    public function getCoreInfo(){
        return $this->syncRequest('info');
    }
}
