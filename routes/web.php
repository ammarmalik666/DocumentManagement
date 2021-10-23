<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Client\ClientAuthController;
use App\Http\Controllers\Client\ClientMainController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::GET('/admin/login', [AdminAuthController::class,'login_view']);
Route::POST('/admin/login', [AdminAuthController::class,'login'])->name('admin.login');


Route::group(['middleware' => ['AdminAuth']], function(){
	
	Route::GET('/admin', [AdminMainController::class,'dashboard_view']);
	Route::GET('/admin/add-client', [AdminMainController::class,'add_client_view']);
	Route::POST('/admin/add-client', [AdminMainController::class,'add_client'])->name('add.client');
	Route::GET('/admin/all-clients', [AdminMainController::class,'all_client_view']);
	Route::POST('/admin/client/delete', [AdminMainController::class,'delete_client'])->name('delete.client');


	Route::GET('/admin/{id}/access-folder', [AdminMainController::class,'access_folder_view']);
	Route::GET('/admin/{id}/member-files', [AdminMainController::class,'member_files']);
	Route::POST('/admin/member-files/upload', [AdminMainController::class,'upload_member_files'])->name('member.uploadfiles');
	
	Route::POST('/admin/member/create-folder', [AdminMainController::class,'create_member_folder'])->name('member.create_folder');
	Route::POST('/admin/create-folder', [AdminMainController::class,'create_admin_folder'])->name('admin.create_folder');
	Route::GET('/admin/{id}/admin-files/{salt}', [AdminMainController::class,'admin_folder_files']);
	Route::POST('/admin/create-admin-folder/folder', [AdminMainController::class,'create_admin_folder_in_folder'])->name('admin.create_folderinfolder');
	Route::POST('/admin/admin-files/folder/upload', [AdminMainController::class,'upload_admin_files_in_folder'])->name('admin.uploadfiles_inFolder');


	Route::GET('/admin/{id}/member-files/{salt}', [AdminMainController::class,'member_folder_files']);
	Route::POST('/admin/create-folder/folder', [AdminMainController::class,'create_member_folder_in_folder'])->name('member.create_folderinfolder');
	Route::POST('/admin/member-files/folder/upload', [AdminMainController::class,'upload_member_files_in_folder'])->name('member.uploadfiles_inFolder');

	Route::GET('/admin/{id}/admin-files', [AdminMainController::class,'admin_files']);
	Route::POST('/admin/admin-files/upload', [AdminMainController::class,'upload_admin_files'])->name('admin.uploadfiles');


	Route::POST('/member-files/delete', [AdminMainController::class,'delete_member_files'])->name('delete.member-file');
	Route::POST('/admin-files/delete', [AdminMainController::class,'delete_admin_files'])->name('delete.admin-file');
	Route::POST('/admin-folders/delete', [AdminMainController::class,'delete_admin_folders'])->name('delete.admin-folder');
	Route::POST('/member-folders/delete', [AdminMainController::class,'delete_member_folders'])->name('delete.member-folder');


	Route::GET('/admin/setting', [AdminAuthController::class,'setting']);
	Route::POST('admin/change-password', [AdminAuthController::class,'change_password'])->name('admin.change_password');
	Route::GET('/admin/logout', [AdminAuthController::class,'logout']);

});

Route::GET('/login', [ClientAuthController::class,'login_view']);
Route::POST('/login', [ClientAuthController::class,'login'])->name('client.login');

Route::group(['middleware' => ['ClientAuth']], function(){

	Route::GET('/dashboard', [ClientMainController::class,'dashboard_view']);
	Route::GET('/my-folder/files/{slug}', [ClientMainController::class,'folder_files_view']);
	Route::GET('/', [ClientMainController::class,'index']);
	Route::GET('/setting', [ClientAuthController::class,'setting']);
	Route::POST('/change-password', [ClientAuthController::class,'change_password'])->name('client.change_password');
	Route::GET('/client/logout', [ClientAuthController::class,'logout']);

});