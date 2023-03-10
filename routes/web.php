<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// TEST CONTACTS ARRAY
function getContacts() {
    return [
        1 => ['name' => 'Name 1', 'phone' => '1234567890'],
        2 => ['name' => 'Name 2', 'phone' => '2345678901'],
        3 => ['name' => 'Name 3', 'phone' => '3456789012'],
    ];
};

// HOMEPAGE
Route::get('/', function () {
    return view('welcome');
});



// ROUTES
Route::get('/contacts', function() {
    $contacts = getContacts();
    return view('contacts.index', compact('contacts'));
})->name('contacts.index');


Route::get('/contacts/create', function() {
    return view('contacts.create');
})->name('contacts.create');


Route::get('/contacts/{id}', function($id) {
    $contacts = getContacts();
    abort_if(!isset($contacts[$id]), 404);
    $contact = $contacts[$id];
    return view('contacts.show')->with('contact', $contact);
})->name('contacts.show');



// FALLBACK ROUTE
Route::fallback(function() {
    return "<h1>This page doesn't exist</h1>";
});
