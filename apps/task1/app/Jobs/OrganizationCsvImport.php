<?php

namespace App\Jobs;

use App\Models\Organization;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class OrganizationCsvImport implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * rabbitmq timeout
     * @var $timeout
     *
     */
    public $timeout = 0;
    /**
     * @var $backoff
     *
     */
    public $backoff = 3;
    /**
     * @var $tries
     *
     */
    public $tries = 1;
    /**
     * @var $file_path
     *
     */
    private $file_path;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $file_path)
    {
        $this->file_path = $file_path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Job: Organization import started : " . $this->file_path);

        $model_data = [];
        if (($handle = fopen(storage_path($this->file_path), 'r')) !== false) {
            while (($data = fgetcsv($handle, 0)) !== false) {

                $model_data['name']    = $data [0];
                $model_data['email']   = $data [1];
                $model_data['phone']   = $data [2];
                $model_data['address'] = trim(preg_replace('/\s+/', ' ', $data [3]));

                Organization::query()->create($model_data);
            }
            fclose($handle);
        }
    }
}
