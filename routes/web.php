<?php

use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\SiteController;
use App\Http\Controllers\Backend\LocationController;
use App\Http\Controllers\Backend\DescriptionController;
use App\Http\Controllers\Backend\MaintenanceController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\SiteSettingController;

use App\Http\Controllers\Backend\SiteAdditionController;

Route::get('/', [FrontendController::class, 'index'])->name('index');

// add frontend name prefix
Route::name('frontend.')->group(function () {
    Route::get('/about', [FrontendController::class, 'about'])->name('about');
    Route::get('/ancient-place', [FrontendController::class, 'ancient_place'])->name('ancient.place');
    Route::get('/ancient-place/well-preserved', [FrontendController::class, 'well_preserved'])->name('ancient.preserved');
    Route::get('/ancient-place/vulnerable', [FrontendController::class, 'vulnerable'])->name('ancient.vulnerable');
    Route::get('/ancient-place/critical', [FrontendController::class, 'critical'])->name('ancient.critical');
    Route::get('/ancient-place/{id}', [FrontendController::class, 'show_place'])->name('show.place');
    Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
    Route::post('/store', [FrontendController::class, 'store'])->name('contact.store');
    Route::get('/search-sites', [FrontendController::class, 'searchResults'])->name('search.sites');
    Route::get('/search-catagory', [FrontendController::class, 'searchCatagory'])->name('search.catagory');
    Route::get('/get-search-thanas', [FrontendController::class, 'getThanasByZilla'])->name('get.thanas');
    Route::post('/gallery/upload', [GalleryController::class, 'uploadImages'])->name('gallery.upload');
    Route::get('/search-contact', [GalleryController::class, 'searchContact'])->name('contact.search');

});
 
// add backend name prefix
// Route::name('backend.')->group(function () {
//     Route::get('/adminDashboard', [BackendController::class, 'index'])->name('home.adminDashboard');

//     // Site Addition
//     Route::get('/siteAddition', [SiteAdditionController::class, 'index'])->name('siteAddition.siteAddition');
//     Route::get('/siteAddition/create', [SiteAdditionController::class, 'create'])->name('siteAddition.create');
//     Route::post('/siteAddition/store', [SiteAdditionController::class, 'store'])->name('siteAddition.store');
//     Route::get('/siteAddition/view/{id}', [SiteAdditionController::class, 'show'])->name('siteAddition.view');
//     Route::get('/siteAddition/edit/{id}', [SiteAdditionController::class, 'edit'])->name('siteAddition.edit');
//     Route::post('/siteAddition/update/{id}', [SiteAdditionController::class, 'update'])->name('siteAddition.update');
//     Route::get('/siteAddition/delete/{id}', [SiteAdditionController::class, 'destroy'])->name('siteAddition.delete');

//     //Site Setting
//     Route::get('/siteSetting', [SiteSettingController::class, 'editSiteSetting'])->name('siteSetting.editSiteSetting');
//     Route::post('/siteSetting/update', [SiteSettingController::class, 'updateSiteSetting'])->name('siteSetting.updateSiteSetting');
//     Route::get('/siteSetting/editAboutUs', [SiteSettingController::class, 'editAboutUs'])->name('siteSetting.editAboutUs');
//     Route::post('/siteSetting/updateAboutUs', [SiteSettingController::class, 'updateAboutUs'])->name('siteSetting.updateAboutUs');


//     // Site Routes
//     Route::get('/sites', [SiteController::class, 'index'])->name('site.sites');
//     Route::get('/sites/create', [SiteController::class, 'create'])->name('site.create'); // FIXED
//     Route::get('/get-thanas/{districtId}', [SiteController::class, 'getThanas']);
//     Route::post('/sites/store', [SiteController::class, 'store'])->name('site.store'); // FIXED

//     // Description Routes 
//     Route::get('/siteDescription', [DescriptionController::class, 'index'])->name('description.siteDescription');
//     Route::get('/siteDescription/getBySite', [DescriptionController::class, 'getBySite'])->name('description.getBySite');
//     Route::get('/siteDescription/create', [DescriptionController::class, 'create'])->name('description.create'); // FIXED
//     Route::post('/siteDescription/store', [DescriptionController::class, 'store'])->name('description.store'); // FIXED

//     // Maintenance Routes
//     Route::get('/siteMaintenance', [MaintenanceController::class, 'index'])->name('maintenance.siteMaintenance');
//     Route::get('/siteMaintenance/getBySite', [MaintenanceController::class, 'getBySite'])->name('maintenance.getBySite');
//     Route::get('/siteMaintenance/create', [MaintenanceController::class, 'create'])->name('maintenance.create'); // FIXED
//     Route::post('/siteMaintenance/store', [MaintenanceController::class, 'store'])->name('maintenance.store'); // FIXED

//     // Gallery Routes
//     Route::get('/siteGallery', [GalleryController::class, 'index'])->name('gallery.siteGallery');
//     Route::get('/siteGallery/getBySite', [GalleryController::class, 'getBySite'])->name('gallery.getBySite');
//     Route::get('/siteGallery/create', [GalleryController::class, 'create'])->name('gallery.create');
//     Route::post('/siteGallery/store', [GalleryController::class, 'store'])->name('gallery.store');

//     Route::get('/createDistrict', [LocationController::class, 'createDistrict'])->name('location.createDistrict');
//     Route::post('/storeDistrict', [LocationController::class, 'storeDistrict'])->name('location.storeDistrict');

//     Route::get('/createThana', [LocationController::class, 'createThana'])->name('location.createThana');
//     Route::post('/storeThana', [LocationController::class, 'storeThana'])->name('location.storeThana');

// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('user', UserController::class);
});

Route::middleware(['auth'])->name('backend.')->group(function () {

    Route::get('/adminDashboard', [BackendController::class, 'index'])->name('home.adminDashboard');

    // Site Addition
    Route::get('/siteAddition', [SiteAdditionController::class, 'index'])->name('siteAddition.siteAddition');
    Route::get('/siteAddition/create', [SiteAdditionController::class, 'create'])->name('siteAddition.create');
    Route::post('/siteAddition/store', [SiteAdditionController::class, 'store'])->name('siteAddition.store');
    Route::get('/siteAddition/view/{id}', [SiteAdditionController::class, 'show'])->name('siteAddition.view');
    Route::get('/siteAddition/edit/{id}', [SiteAdditionController::class, 'edit'])->name('siteAddition.edit');
    Route::post('/siteAddition/update/{id}', [SiteAdditionController::class, 'update'])->name('siteAddition.update');
    Route::get('/siteAddition/delete/{id}', [SiteAdditionController::class, 'destroy'])->name('siteAddition.delete');
    Route::post('/site-addition/validate', [SiteAdditionController::class, 'validateFields'])->name('siteAddition.validate');


    // Site Setting
    Route::get('/siteSetting', [SiteSettingController::class, 'editSiteSetting'])->name('siteSetting.editSiteSetting');
    Route::post('/siteSetting/update', [SiteSettingController::class, 'updateSiteSetting'])->name('siteSetting.updateSiteSetting');
    Route::get('/siteSetting/editAboutUs', [SiteSettingController::class, 'editAboutUs'])->name('siteSetting.editAboutUs');
    Route::post('/siteSetting/updateAboutUs', [SiteSettingController::class, 'updateAboutUs'])->name('siteSetting.updateAboutUs');
    Route::get('/siteSetting/editContact', [SiteSettingController::class, 'editContact'])->name('siteSetting.editContact');
    Route::post('/siteSetting/updateContact', [SiteSettingController::class, 'updateContact'])->name('siteSetting.updateContact');

    // User Message
    Route::get('/messages', [BackendController::class, 'userMessages'])->name('user.messages');

    // Site Routes
    Route::get('/sites', [SiteController::class, 'index'])->name('site.sites');
    Route::get('/sites/create', [SiteController::class, 'create'])->name('site.create'); // FIXED
    Route::get('/get-thanas/{districtId}', [SiteController::class, 'getThanas'])->name('site.getThanas');
    Route::post('/sites/store', [SiteController::class, 'store'])->name('site.store'); // FIXED

    // Description Routes
    Route::get('/siteDescription', [DescriptionController::class, 'index'])->name('description.siteDescription');
    Route::get('/siteDescription/getBySite', [DescriptionController::class, 'getBySite'])->name('description.getBySite');
    Route::get('/siteDescription/create', [DescriptionController::class, 'create'])->name('description.create'); // FIXED
    Route::post('/siteDescription/store', [DescriptionController::class, 'store'])->name('description.store'); // FIXED

    // Maintenance Routes
    Route::get('/siteMaintenance', [MaintenanceController::class, 'index'])->name('maintenance.siteMaintenance');
    Route::get('/siteMaintenance/getBySite', [MaintenanceController::class, 'getBySite'])->name('maintenance.getBySite');
    Route::get('/siteMaintenance/create', [MaintenanceController::class, 'create'])->name('maintenance.create'); // FIXED
    Route::post('/siteMaintenance/store', [MaintenanceController::class, 'store'])->name('maintenance.store'); // FIXED

    // Gallery Routes
    Route::get('/siteGallery', [GalleryController::class, 'index'])->name('gallery.siteGallery');
    Route::get('/siteGallery/getBySite', [GalleryController::class, 'getBySite'])->name('gallery.getBySite');
    Route::get('/siteGallery/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('/siteGallery/store', [GalleryController::class, 'store'])->name('gallery.store');

    Route::get('/createDistrict', [LocationController::class, 'createDistrict'])->name('location.createDistrict');
    Route::post('/storeDistrict', [LocationController::class, 'storeDistrict'])->name('location.storeDistrict');

    Route::get('/createThana', [LocationController::class, 'createThana'])->name('location.createThana');
    Route::post('/storeThana', [LocationController::class, 'storeThana'])->name('location.storeThana');

    Route::get('backend/location/getDistrict/{id}', [LocationController::class, 'getDistrictData'])->name('location.getDistrictData');
    Route::put('backend/location/updateDistrict/{id}', [LocationController::class, 'updateDistrict'])->name('location.updateDistrict');
    Route::delete('backend/location/deleteDistrict/{id}', [LocationController::class, 'deleteDistrict'])->name('location.deleteDistrict');

    Route::get('backend/location/getThana/{id}', [LocationController::class, 'getThanaData'])->name('location.getThanaData');
    Route::put('backend/location/updateThana/{id}', [LocationController::class, 'updateThana'])->name('location.updateThana');
    Route::delete('backend/location/deleteThana/{id}', [LocationController::class, 'deleteThana'])->name('location.deleteThana');

    //settings routes
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

    //image routes
    Route::get('/admin/images', [GalleryController::class, 'getImages'])->name('admin.images');
    Route::post('/approve-image/{id}', [GalleryController::class, 'approveImage'])->name('admin.approveImage');
    Route::post('/reject-image/{id}', [GalleryController::class, 'rejectImage'])->name('admin.rejectImage');
    Route::post('/delete-image/{id}', [GalleryController::class, 'deleteImage'])->name('admin.deleteImage');
    Route::post('/delete-file/{id}', [SiteAdditionController::class, 'deleteFile'])->name('delete.file');
});
require __DIR__.'/auth.php';
