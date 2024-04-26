<?php

use Illuminate\Support\Facades\Route;

Route::get('create-newsletter','HomeController@createNewletter')->name('ajax.newsletter.get');
Route::get('create-partner','HomeController@createPartner')->name('ajax.create.partner.get');
Route::get('submit-contact-form','HomeController@submitForm')->name('ajax.submit.form.get');
