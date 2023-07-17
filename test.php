<?php 
use Illuminate\Console\Command;
use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Illuminate\Foundation\Inspiring;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\Facades\Facade;
use Laravel\Lumen\Application as LumenApplication;
class Test extends Command
{ 
    // ...
    
    protected function loadLaravel()
    {
        $app = require __DIR__.'/../../bootstrap/app.php';
        $app->make(LoadEnvironmentVariables::class)->bootstrap();
        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        return $app;
    }
    
   public function handle()
    {
        $input = $this->argument('input');
        $output = $this->runScript($input);
        $this->line($output);
    }
    
    protected function runScript($input)
    {
        ob_start();
        eval($input);
        $output = ob_get_clean();
        return $output;
    }
}
?>