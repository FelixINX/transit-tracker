<?php

namespace App\Console\Commands;

use App\Jobs\RealtimeData\DispatchAgencies;
use App\Models\Agency;
use Illuminate\Console\Command;

class QueueActiveAgencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'agency:refresh-actives';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will refresh all active agencies vehicles';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DispatchAgencies::dispatch(Agency::active()->get())->onQueue('vehicles');
    }
}
