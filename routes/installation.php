<?php

use App\Http\Controllers\Install\InstallerController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('installation')->middleware('already.installed')->group(function () {

    // Start
    Route::get('/', function () {
        $detectedUrl = Request::root();
        Config::write('app.url', $detectedUrl);
        return view('Installation.start');
    })->name('install');

    // Database
    Route::get('/database', function () {
        return view('Installation.database');
    })->name('database');

    // Cron Job
    Route::get('/cron-job', function () {
        return view('Installation.crontab');
    })->name('cron.job');

    // Administrator
    Route::get('/administrator', function () {
        return view('Installation.administrator');
    })->name('administrator');

    // Finish
    Route::get('/finish', function () {
        Config::write('app.installed', true);
        Artisan::call('optimize:clear');
        Artisan::call('storage:link');
        return view('Installation.finish');
    })->name('finish');


    // Installer Controller
    Route::controller(InstallerController::class)->group(function () {
        // Connect DB
        Route::post('/administrator', 'connectDB')->name('connect.db');

        // Start
        Route::post('/check', 'check')->name('check');

        // Admin
        Route::post('/admin', 'createAdmin')->name('create.admin');
        Route::get('/admin', 'createAdmin')->name('create.admin');
    });
});
