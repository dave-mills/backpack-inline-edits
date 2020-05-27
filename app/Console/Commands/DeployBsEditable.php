<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DeployBsEditable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy:editable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publishes the BS Editable package to the packages folder';

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

        $process = new Process('rsync -avP node_modules/x-editable-bs4/dist/bootstrap4-editable/ public/packages/bootstrap4-editable/');

        $process->run();

        if(!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }
}
