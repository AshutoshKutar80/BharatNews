<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/services', 'services')->name('services');
Route::view('/contact', 'contact')->name('contact');

Route::view('/privacy-policy', 'policies.privacy-policy')->name('privacy-policy');
Route::view('/our-rules', 'policies.our-rules')->name('our-rules');
Route::view('/terms-of-service', 'policies.terms-of-service')->name('terms-of-service');
Route::view('/refund-policy', 'policies.refund-policy')->name('refund-policy');
 