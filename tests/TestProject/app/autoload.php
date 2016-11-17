<?php

use Doctrine\Common\Annotations\AnnotationRegistry;

$loader = require __DIR__.'/../../../vendor/autoload.php';
AnnotationRegistry::registerLoader([$loader, 'loadClass']);

require_once __DIR__.'/TestKernel.php';

return $loader;
