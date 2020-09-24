<?php

namespace Lararole\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class LararoleModelsGenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lararole:generate:models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'generate all the models related lararole';

    public function handle()
    {
        foreach (config('lararole.providers') as $key => $provider) {
            $modelPrefix = ucfirst($key);
            Artisan::call("lararole:make:model ${modelPrefix}Module --module");
            Artisan::call("lararole:make:model ${modelPrefix}Role --role");
            Artisan::call("lararole:make:model ${modelPrefix}Permission --permission");
        }
    }
}
