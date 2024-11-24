<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GeckoService;

class ImportAndUpdateGecko extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import and update currencies';

    /**
     * Execute the console command.
     */
    public function handle(GeckoService $geckoService)
    {
        $this->info('Starting the import...');
        try {
            $message = $geckoService->importCurrencyList();
            $this->info($message);
        } catch (\Exception $e) {
            $this->error('Error occurred: ' . $e->getMessage());
        }

        $this->info('Import/Update  completed.');

        return Command::SUCCESS;
    }
}
