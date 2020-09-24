<?php


namespace Lararole\Tests\Unit\Console\Commands;


use Illuminate\Support\Facades\File;
use Lararole\Tests\TestCase;

class LararoleModelMakeCommandTest extends TestCase
{
    public function testLararoleModelMakeCommand()
    {
        $targetModelsPath = $this->app->basePath('app');

        File::deleteDirectory($targetModelsPath);

        $this->artisan('lararole:make:model MyModel')->assertExitCode(0);

        if (is_dir(app_path('Models'))) {
            $this->assertFileExists($targetModelsPath . '/Models/Lararole/MyModel.php');
        } else {
            $this->assertFileExists($targetModelsPath . '/Lararole/MyModel.php');
        }
    }
}