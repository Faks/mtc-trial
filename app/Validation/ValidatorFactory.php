<?php

declare(strict_types=1);

namespace App\Validation;

use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;

use function realpath;

class ValidatorFactory
{
    public Factory $factory;

    public function __construct()
    {
        $base = __DIR__ . '/../../';

        $loader = new FileLoader(new Filesystem, realpath($base . '/resources/lang'));
        $translator = new Translator($loader, 'en');
        $translator->setFallback('en');
        $this->factory = new Factory($translator, new Container);
    }


    public function __call($method, $args)
    {
        return call_user_func_array([$this->factory, $method], $args);
    }
}