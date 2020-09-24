<?php


namespace Lararole\Tests\Unit\Console\Commands;


use Illuminate\Support\Facades\File;
use Lararole\Tests\TestCase;

class LararoleModelsGenerateCommandTest extends TestCase
{
    public function testLararoleModelsGenerateCommand()
    {
        $targetModelsPath = $this->app->basePath('app');

        File::deleteDirectory($targetModelsPath);

        $this->artisan('lararole:generate:models')->assertExitCode(0);

        foreach (config('lararole.providers') as $key => $provider) {
            $modelPrefix = ucfirst($key);
            if (is_dir(app_path('Models'))) {

                $this->assertFileExists($targetModelsPath . "/Models/Lararole/${modelPrefix}Module.php");
                $this->assertFileExists($targetModelsPath . "/Models/Lararole/${modelPrefix}Role.php");
                $this->assertFileExists($targetModelsPath . "/Models/Lararole/${modelPrefix}Permission.php");
            } else {
                $this->assertFileExists($targetModelsPath . "/Lararole/${modelPrefix}Module.php");
                $this->assertFileExists($targetModelsPath . "/Lararole/${modelPrefix}Role.php");
                $this->assertFileExists($targetModelsPath . "/Lararole/${modelPrefix}Permission.php");
            }
        }
    }
}