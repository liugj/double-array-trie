<?php

/*
 * This file is part of the double array trie  php package.
 *
 * (c) liugj <liugj@boqii.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Liugj\DoubleArray\Console;

use Illuminate\Console\Command;

class CleanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:clean {model} {--offset=} {--limit=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '清洗数据';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $class = $this->argument('model');
        $offset = $this->option('offset');
        $limit = $this->option('limit');

        (new $class())->clean((int) $offset, $offset + $limit);
    }
}
