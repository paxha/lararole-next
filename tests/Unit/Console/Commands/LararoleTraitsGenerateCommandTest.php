<?php


namespace Lararole\Tests\Unit\Console\Commands;


use Illuminate\Support\Facades\File;
use Lararole\Tests\TestCase;

class LararoleTraitsGenerateCommandTest extends TestCase
{
    public function testLararoleTraitGenerateCommand()
    {
        $targetModelsPath = $this->app->basePath('app');

        File::deleteDirectory($targetModelsPath);

        $this->artisan('lararole:generate:traits')->assertExitCode(0);

        foreach (config('lararole.providers') as $key => $provider) {
            $modelPrefix = ucfirst($key);
            $this->assertFileExists($targetModelsPath . "/Traits/Lararole/${modelPrefix}HasRoles.php");
        }
    }
}