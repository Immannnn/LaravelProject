<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

// Default route (welcome page)
Route::get('/', function () {
    return view('welcome');
});

// Route para ma-load ang table.php mula sa resources/views/components/
Route::get('/table-data', function () {
    $path = resource_path('views/components/table.php');
    if (File::exists($path)) {
        include $path;
    } else {
        return response('File not found.', 404);
    }
});
