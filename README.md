# Laravel HATEOAS response formatter

#How to install
```
composer require wgjr/hateoas-laravel
```

* Required PHP 7.4 + 
Others versions:
```
composer require wgjr/hateoas-laravel --ignore-platform-reqs
```

* Laravel 5.6+

# How tu use class

* Add providers in Laravel
```
\hateoasLaravel\HateoasLaravelServiceProvider::class
```

* add in you class
```
    use use hateoasLaravel\Domain\UseCases\HateoasLaravel;
```

```
    $responseFormater = new HateoasLaravel();

    /**
     *
     * Formatted a universal response object to Hateoas response
     *
     * @param string $classInResponse
     * @param string $hashMessage
     * @param int|null $code
     * @param array|null $dataResponse
     * @return LaravelJsonResponse
     * @throws Exception
     */

    return $this->responseFormatter->formatResponse(
        'login',
        'login_success',
        200,
        []
    );
```