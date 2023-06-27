## Enviroment
- <h5>PHP: 8.1</h5>
- <h5>Framework: Laravel 10</h5>
- <h5>MySql: 8.0</h5>
- <h5>Apache: 2.4</h5>

## Guildline for programmer
* <h6> Step 1: </h6> 
```bash
$ copy .env.example .env
```

* <h6> Step 2: </h6> 
```bash
$ docker compose up -d --build
```

* <h6> Step 3: </h6> 
```bash
$ docker-compose exec server bash
$ composer install
$ php artisan key:generate
$ exit
```

* <b>Stop docker:</b><br>
```bash
$ docker-compose stop
```
## Test your deployment :
* Open [localhost](http://localhost) in your browser
