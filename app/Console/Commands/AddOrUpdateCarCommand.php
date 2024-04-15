<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AddOrUpdateCarCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'catalog:add-or-update-car-command {car}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dd($this->arguments());
    }
}
