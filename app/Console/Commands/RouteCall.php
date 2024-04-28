<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;

class RouteCall extends Command
{
    protected $signature = 'route:call {uri}';
    protected $description = 'Call route from CLI';

    public function handle()
    {
        $uri = $this->argument('uri');

        // Set the PATH environment variable manually if needed
        putenv('PATH=' . getenv('PATH') . ':/your/custom/path');
        $request = Request::create($uri, 'GET');
        $this->info(app()->make(\Illuminate\Contracts\Http\Kernel::class)->handle($request)->getContent());
    }
}