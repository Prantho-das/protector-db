<?php

namespace Pranthokumar\ProtectDb\App\Console\Commands;

use Illuminate\Console\Command;
use Pranthokumar\ProtectDb\App\Facades\ProtectDb;

class ProtectMyDbCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'protect-db:protect';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Protect your database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Protecting your database...');

        ProtectDb::protect();

        $this->info('Database protected!');
    }
}