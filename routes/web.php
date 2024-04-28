<?php

use Illuminate\Support\Facades\Route;
use Spatie\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-pdf', function () {
    $htmlContent = "<h1>Hello World!</h1><p>This is a test PDF generated from HTML.</p>";
    $pdfPath = public_path('hello_world.pdf');

    Pdf::html($htmlContent)
        ->withBrowsershot(function ($browsershot) {
            $browsershot
                ->setIncludePath('$PATH:'.config('browsershot.browsershot_include_path'))
                /* ->noSandbox() // This method is often available in Browsershot to simplify the process.
                ->addChromiumArguments([
                    '--disable-setuid-sandbox',
                    '--enable-logging', // Enables logging
                    '--v=1', // Sets the verbosity level of logging
                    '--enable-features=NetworkService,NetworkServiceInProcess'        // Disables GPU hardware acceleration. If software renderer is not in place, this can slow down the rendering and increase CPU usage.
                ]) */; 
        }) 
        ->save($pdfPath);
        
        return 'PDF generated and saved to ' . $pdfPath;
    //return view('welcome');
});

Route::get('/test-node', function () {
    // Path to your Node.js script
    $scriptPath = base_path('test-pptr.cjs');

    // Get the Node.js PATH from .env file
    $nodePath = config('browsershot.browsershot_include_path');
    $currentPath = env('PATH');

    // Set the full path to include Node.js executable
    $fullPath = $nodePath . ':' . $currentPath;

    // Create the process and set the environment variables
    $process = new Process(['node', $scriptPath], null, ['PATH' => $fullPath]);
    $process->setTimeout(3600);

    try {
        // Execute the process
        $process->mustRun();

        // Return the output
        return nl2br($process->getOutput());
    } catch (ProcessFailedException $exception) {
        // Process failed to execute
        return response('The node script did not run successfully: ' . $exception->getMessage(), 500);
    }
});



