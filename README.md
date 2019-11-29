# laravel-microservices
Microservices with Laravel Lumen

The api-gateway use [PoweredLocal/vrata](https://github.com/PoweredLocal/vrata)

## Build Setup

``` bash
# install dependencies on all repo
composer install

# setup server
We are create virtual host for api-gateway and each service same "<your-domain>" with tempalte

## api-gateway
<VirtualHost *:80>
	ServerName api-gateway.<your-domain>
	DocumentRoot "<path of project>/api-gateway/public"
	<Directory  "<path of project>/api-gateway/public/">
		Options +Indexes +Includes +FollowSymLinks +MultiViews
		AllowOverride All
		Require all
	</Directory>
</VirtualHost>

<VirtualHost *:80>
	ServerName <service-name>.<your-domain>
	DocumentRoot "<path of project>/<service-folder>/public"
	<Directory  "path of project/<service-folder>/public/">
		Options +Indexes +Includes +FollowSymLinks +MultiViews
		AllowOverride All
		Require local
	</Directory>
</VirtualHost>
```
### Add  local DNS

``` bash

# Do need for deploy to server production because the api-gateway will use server domain
127.0.0.1	api-gateway.<your-domain>
::1	api-gateway.<your-domain>

# Each service add same the template
127.0.0.1	<service-name>.cargopedia.local
::1	<service-name>.cargopedia.local
```
## configration
In file config/services.json we are define the service and relations to service exam this template

``` bash

"services": {
    "<service-name-1>": {
        "url": "http://<service-name-1>.<yourdomain>/",
        "relations": [
          "service-name-2"
        ]
    },
    "<service-name-2>": {
        "url": "http://<service-name-2>.<yourdomain>/",
        "relations": [
        ]
    },
},
## Example
"services": {
    "core": {
        "url": "http://core.<yourdomain>/",
        "relations": [
        ]
    },
    "test": {
        "url": "http://test.<yourdomain>/",
        "relations": [
          'core'
        ]
    },
},

```

# Generate Route from doc api use swagger

In Controller we will add swagger anotation to generate doc. can se more [zircote/swagger-php](https://github.com/zircote/swagger-php/tree/2.x)

In the each service run commend above to generate swagger api json
``` bash
php artisan swagger-lume:generate

```
In Api-gateway run above parse route from api doc the route store at api-gateway/storage/app/routes.json
``` bash
php artisan gateway:parse
```

Example routes.json after generate

``` bash
[
    {
        "id": "fec203cf-8be3-4321-b18f-7129effcdec6",
        "method": "GET",
        "path": "/v1/home",
        "actions": [
            {
                "method": "GET",
                "service": "core",
                "path": "/home",
                "critical": true
            }
        ]
    },
    {
        "id": "99a9fb60-0cf7-4cbf-9cad-6adb39f94a3e",
        "method": "GET",
        "path": "/v1/info",
        "actions": [
            {
                "method": "GET",
                "service": "core",
                "path": "/info",
                "critical": true
            }
        ]
    },
    {
        "id": "e0c6189d-2be7-4f21-a9e1-7c908a636d64",
        "method": "GET",
        "path": "/v1/test/home",
        "actions": [
            {
                "method": "GET",
                "service": "test",
                "path": "/test/home",
                "critical": true
            }
        ]
    },
    {
        "id": "1be14213-bcbf-4116-a48f-acf5ed78a0d6",
        "method": "GET",
        "path": "/v1/test/info",
        "actions": [
            {
                "method": "GET",
                "service": "test",
                "path": "/test/info",
                "critical": true
            }
        ]
    }
]
```

Done now you can access to gateway with api generated in routes.jon

ex: api-gateway.<your-domain>/v1/test/info








