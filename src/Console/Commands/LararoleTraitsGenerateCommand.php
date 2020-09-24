<?php

namespace Lararole\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class LararoleTraitsGenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lararole:generate:traits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate all the traits related lararole';

    public function handle()
    {
        foreach (config('lararole.providers') as $key => $provider) {
            $modelPrefix = ucfirst($key);
            Artisan::call("lararole:make:trait ${modelPrefix}HasRoles");
        }
    }
}
