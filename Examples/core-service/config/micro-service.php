<?php
$serviceConfig = [
    "service_name"=> env("SERVICE_NAME","core")
];
$configPath = __DIR__.'/../../config/services.json';
$config = json_decode(file_get_contents($configPath), true);
$serviceConfig['config'] = $config;

return $serviceConfig;
