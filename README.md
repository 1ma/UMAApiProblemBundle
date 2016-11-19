# UMAApiProblemBundle

[![Build Status](https://travis-ci.org/1ma/UMAApiProblemBundle.svg?branch=master)](https://travis-ci.org/1ma/UMAApiProblemBundle) [![Code Coverage](https://scrutinizer-ci.com/g/1ma/UMAApiProblemBundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/1ma/UMAApiProblemBundle/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/1ma/UMAApiProblemBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/1ma/UMAApiProblemBundle/?branch=master) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/efdc3fe6-e2d1-44c7-9ff8-49ec9a09c2c4/mini.png)](https://insight.sensiolabs.com/projects/efdc3fe6-e2d1-44c7-9ff8-49ec9a09c2c4)

Clean integration between the [crell/api-problem](https://github.com/Crell/ApiProblem) library and the Symfony framework

## What it does

This bundle just hooks a simple [VIEW event](http://symfony.com/doc/current/reference/events.html#kernel-view) listener into the request lifecycle. This allows you to return [ApiProblem](https://github.com/Crell/ApiProblem/blob/master/README.md) objects from your controllers without needing to concern yourself about how to transform them into Symfony responses.

## Installation & Configuration

Add [`uma/api-problem-bundle`](https://packagist.org/packages/uma/api-problem-bundle) to your `composer.json` file:

    php composer.phar require "uma/api-problem-bundle"

And register the bundle in `app/AppKernel.php`:

``` php
public function registerBundles()
{
    return [
        // ...
        new UMA\ApiProblemBundle\UMAApiProblemBundle(),
    ];
}
```

## Usage

Take a look at the [TestController](https://github.com/1ma/UMAApiProblemBundle/blob/master/tests/TestProject/src/AppBundle/Controller/TestController.php) class for a hands-on example.

## TODO

- XML support
