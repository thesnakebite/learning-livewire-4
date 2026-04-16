<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::livewire('/post', 'pages::post.index');
Route::livewire('/post/create', 'pages::post.create');

Route::livewire('/analytics', 'pages::analytics.index');
