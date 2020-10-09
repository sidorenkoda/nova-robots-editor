<?php

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::get('/robots-file', function (Request $request) {
	$filepath = base_path('public/robots.txt');
	$contents = '';
	$updatedAt = null;
	if (file_exists($filepath)) {
		$contents = file_get_contents($filepath);
		$updatedAt = filemtime($filepath);
		$updatedAt = $updatedAt ? (new Carbon($updatedAt))->toIso8601String() : null;
	} else {
		file_put_contents($filepath, $contents);
	}
	return [
		'contents' => $contents,
		'updated_at' => $updatedAt,
	];
});

Route::post('/robots-file', function (Request $request) {
	$filepath = base_path('public/robots.txt');
	$contents = $request->get('contents');
	file_put_contents($filepath, $contents);
	$updatedAt = Carbon::now()->toIso8601String();
	return [
		'contents' => $contents,
		'updated_at' => $updatedAt,
	];
});
