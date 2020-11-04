<?php

namespace App\Traits;

trait Seedable
{
    public function seed($class)
    {
        if (!class_exists($class)) {
            require_once database_path('seeds/').$class.'.php';
        }
        with(new $class())->run();
    }
}
