<?php

namespace App\Console\Commands;

use App\Jobs\OrganizationCsvImport;
use Illuminate\Console\Command;

class ImportOrganizations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:organizations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Organizations from csv file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Csv importing...');

        OrganizationCsvImport::dispatch('app/public/organizations.lite.csv');

        return 0;
    }
}
