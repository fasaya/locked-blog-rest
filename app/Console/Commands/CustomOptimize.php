<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CustomOptimize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:optimize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan optimize';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        exec('php artisan optimize');
        return Command::SUCCESS;
    }
}
