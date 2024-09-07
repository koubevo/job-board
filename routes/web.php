<?php

use App\Http\Controllers\OfferController;
use Illuminate\Support\Facades\Route;

Route::resource('jobs', OfferController::class)->only(['index']);