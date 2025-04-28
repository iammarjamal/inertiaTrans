<?php

namespace Iammarjamal\InertiaTrans\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class InertiaTransCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inertiaTrans:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the inertia-translations npm package';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $result = Process::run('npm install inertia-translations');

        if (! $result->successful()) {
            $this->error('Failed to install inertia-translations package.');
            return self::FAILURE;
        }

        $this->info('inertia-translations package installed successfully.');

        return self::SUCCESS;
    }
}
