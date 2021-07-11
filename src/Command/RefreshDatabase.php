<?php

namespace AmirAghaee\Redirector\Command;

use AmirAghaee\Redirector\Facades\Redirector;
use Illuminate\Console\Command;

class RefreshDatabase extends Command
{
    protected $signature = 'redirector:refresh';

    protected $description = 'refresh database and remove all routes';

    public function handle()
    {
        Redirector::fresh();
        $this->info('Database refreshed!');
    }
}
