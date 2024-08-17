<?php

use App\Events\AdmissionPayment;
use App\Events\ReadCardNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/get-cardnumber', function (Request $request) {

    $UIDresult = $request->input('UIDresult');
    Log::info('Received card number: ' . $UIDresult);

    broadcast(new ReadCardNumber($UIDresult));

    return response()->json([
        'success' => true,
        'card_number' => $UIDresult,
    ]);
});
Route::post('/admission-payment', function () {

    broadcast(new AdmissionPayment(1));

    return response()->json([
        'success' => true]);
});
