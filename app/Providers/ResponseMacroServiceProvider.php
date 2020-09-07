<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider {

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot() {
        Response::macro('caps', function ($contents, $statusCode) {
            return
                Response::json(['message' => $contents], $statusCode);
        });
    }
}
