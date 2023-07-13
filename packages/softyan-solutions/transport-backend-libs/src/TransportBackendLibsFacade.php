<?php

namespace SoftyanSolutions\TransportBackendLibs;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SoftyanSolutions\TransportBackendLibs\Skeleton\SkeletonClass
 */
class TransportBackendLibsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'transport-backend-libs';
    }
}
