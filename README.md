Zendo - DI Component
====================

Simple proxy/wrapper del componente __Symfony Dependency Injection__

Funcionalidades
---------------

+ Api sencilla
* Generación de cache
+ Permite funcionar modo __dev__ donde detecta automaticamente algún cambio en un archivo yml y regenera el cache
+ Por el momento solo permite archivos de configuracion/servicios en fomato YAML
+ Permite crear una jerarquía de configuración
+ Carga de múltiples archivos y múltiples directorios

Versión
--------

__1.2.0__

Instalación
-----------

### Requerimientos

* PHP 5.4 +
* [Composer](http://getcomposer.org)

### Via composer

    "require": {
        "php": ">=5.4.0",
        "zendo/di": "1.2.0"
    }

Licencia
--------

The MIT License (MIT). Please see [License File](https://github.com/mostofreddy/DI/blob/master/LICENSE.md) for more information.

Ejemplos
--------

Ver el directorio [__examples__](https://github.com/mostofreddy/DI/tree/master/examples)

Correr los tests
----------------

php vendor/bin/phpunit -c tests/phpunit.xml

Validación código estandar
----------------

php vendor/bin/phpcs --standard=build/travis-ci-phpcs.xml src/

La documentación del estándar de código utilizado se encuentra en el [site de PEAR](https://pear.php.net/manual/en/standards.php)


