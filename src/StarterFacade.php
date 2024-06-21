<?php

namespace MVI\Starter;

use Illuminate\Support\Facades\Facade;

/**
 * @see \MVI\Starter\Skeleton\SkeletonClass
 */
class StarterFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'starter';
    }
}
