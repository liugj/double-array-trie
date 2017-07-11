<?php

/*
 * This file is part of the double array trie  php package.
 *
 * (c) liugj <liugj@boqii.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Liugj\DoubleArray\Facades;

use Illuminate\Support\Facades\Facade;
use Liugj\DoubleArray\Trie;

class Trier extends Facade
{
    /**
     * getFacadeAccessor.
     *
     * @static
     *
     * @return mixed
     */
    protected static function getFacadeAccessor()
    {
        return  Trie :: class;
    }
}
