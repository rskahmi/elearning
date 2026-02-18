<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class forgetCache extends Command
{
    protected $signature = 'forget:cache';

    protected $description = 'For Forget All of cache';

    public function handle()
    {
        $this->forgetAll();
    }
}
