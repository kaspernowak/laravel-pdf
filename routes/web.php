<?php

use Illuminate\Support\Facades\Route;
use Spatie\LaravelPdf\Facades\Pdf;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-pdf', function () {
    $htmlContent = "<h1>Hello World!</h1><p>This is a test PDF generated from HTML.</p>";
    $pdfPath = '/home/www/appstaging.meinrad.ch/public/hello_world.pdf'; // Adjust the path as needed
    Pdf::html($htmlContent)
        ->withBrowsershot(function ($browsershot) {
            $browsershot
                ->setIncludePath('$PATH:'.env('BROWSERSHOT_INCLUDE_PATH'));
                /* ->noSandbox() // This method is often available in Browsershot to simplify the process.
                ->addChromiumArguments([
                    '--disable-setuid-sandbox', // Disables the setuid sandbox for the renderer process.
                    '--disable-dev-shm-usage',  // Overcome limitations with /dev/shm in certain environments like Docker.
                    '--disable-gpu'             // Disables GPU hardware acceleration. If software renderer is not in place, this can slow down the rendering and increase CPU usage.
                ]);  */
        })
        ->save('test-pdf.pdf');
    return view('welcome');
});
