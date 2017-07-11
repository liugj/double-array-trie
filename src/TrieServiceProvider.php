<?php

/*
 * This file is part of the double array trie  php package.
 *
 * (c) liugj <liugj@boqii.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Liugj\DoubleArray;

use Illuminate\Support\ServiceProvider;
use Liugj\DoubleArray\Console\CleanCommand;

class TrieServiceProvider extends ServiceProvider
{
    /**
     * defer.
     *
     * @var mixed
     */
    protected $defer = true;

    /**
     * register.
     *
     *
     *
     * @return mixed
     */
    public function register()
    {
        $this->app->singleton(Trie :: class, function ($app) {
            $app->configure('double-array-trie');
            $config = $app->make('config')->get('double-array-trie');

            return new Trie($config);
        });

        if ($this->app->runningInConsole()) {
            $this->commands([
                  CleanCommand::class,
            ]);
        }
    }

    /**
     * provides.
     *
     *
     *
     * @return mixed
     */
    public function provides()
    {
        return [Trie :: class];
    }
}
