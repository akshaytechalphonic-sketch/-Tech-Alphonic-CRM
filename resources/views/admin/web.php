<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\loginController;
use App\Http\Controllers\admin\WebPageController;
use App\Http\Controllers\admin\TestimonialController;


Route::get('cache', function () {

    Artisan::call('optimize');

    Artisan::call('cache:clear');

    Artisan::call('route:cache');

    Artisan::call('route:clear');

    Artisan::call('view:clear');

    Artisan::call('config:clear');
});







Route::any('/admin', [loginController::class, 'login'])->name('login');



Route::prefix('admin')->name('admin.')->group(function () {

    Route::any('/add-schema', [dashboardController::class, 'addSchema'])->name('add.schema');

    Route::any('/banner', [dashboardController::class, 'banner'])->name('banner');
    Route::any('/banner-delete/{id}', [dashboardController::class, 'bannerDelete'])->name('banner.delete');
    Route::any('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

    Route::any('/social-media', [dashboardController::class, 'socialMedia'])->name('social');

    Route::any('/footer-texts', [dashboardController::class, 'footeroption'])->name('footer.option');


    Route::any('/upcoming-trip-seo-option', [dashboardController::class, 'upcomingtripseooption'])->name('upcomingtripseooption');
    Route::any('/home-seo', [dashboardController::class, 'seooption'])->name('seooption');







    Route::any('add-destination', [dashboardController::class, 'adddestination'])->name('Adddestination');

    Route::any('updatedestination', [dashboardController::class, 'updatedestination'])->name('updatedestination');



    Route::any('/destination', [dashboardController::class, 'destination'])->name('destination');

    Route::any('/delete-destination/{id}', [dashboardController::class, 'deleteDestination'])->name('delete.destination');



    Route::any('add-post', [dashboardController::class, 'addpost'])->name('add.post');

    Route::any('/post', [dashboardController::class, 'Viewpost'])->name('view.post');

    Route::any('/edit-post/{id}', [dashboardController::class, 'editPost'])->name('edit.post');

    Route::any('updatepost', [dashboardController::class, 'updatepost'])->name('updatepost');



    Route::any('add-testimonial', [dashboardController::class, 'addtestimonial'])->name('add-testimonial');

    Route::any('view-testimonial', [dashboardController::class, 'viewtestimonial'])->name('view-testimonial');

    Route::any('edit-testimonial/{id}', [dashboardController::class, 'edittestimonial'])->name('edit.testimonials');

    Route::any('delete-testimonial/{id}', [dashboardController::class, 'deletetestimonial'])->name('delete-testimonial');



    Route::any('event', [dashboardController::class, 'addEvent'])->name('event');
    Route::any('update-event', [dashboardController::class, 'updateEvent'])->name('update.event');
    Route::any('delete-event/{id}', [dashboardController::class, 'destroy'])->name('delete');


    Route::any('add-package', [dashboardController::class, 'addpackage'])->name('add-package');
    Route::any('delete-package/{id}', [dashboardController::class, 'deletePackage'])->name('delete.package');

    Route::any('reason', [dashboardController::class, 'reason'])->name('reason.section');
    Route::any('delete-reason/{id}', [dashboardController::class, 'reasonDelete'])->name('reason.delete');



    Route::any('view-package', [dashboardController::class, 'viewpackage'])->name('view-package');

    Route::any('edit-package/{id}', [dashboardController::class, 'editpackage'])->name('edit-package');



    Route::any('delete-package-cost/{id}', [dashboardController::class, 'deletePackageCost'])->name('deletePackageCost');





    Route::any('view-enquiry', [dashboardController::class, 'viewenquiry'])->name('view-enquiry');
    Route::any('contact-enquiry', [dashboardController::class, 'contactEnquiry'])->name('contact-enquiry');
    Route::any('request-callback', [dashboardController::class, 'requestCallback'])->name('request.callback');
    Route::any('delete-request-callback/{id}', [dashboardController::class, 'deleterequestCallback'])->name('delete.request.callback');




    Route::any('gallery', [dashboardController::class, 'gallery'])->name('view.gallery');
    Route::any('storeGallery', [dashboardController::class, 'storeGallery'])->name('store.gallery');

    Route::any('deleteGallery/{id}', [dashboardController::class, 'deleteGallery'])->name('delete.gallery');





    Route::any('contact', [dashboardController::class, 'contact'])->name('contact');
    Route::any('/update-contact', [dashboardController::class, 'updateContact'])->name('updateContact');


    Route::any('term-condition', [dashboardController::class, 'termCondition'])->name('term-condition');



    Route::any('return', [dashboardController::class, 'return'])->name('return');

    Route::any('disclaimer', [dashboardController::class, 'disclaimer'])->name('disclaimer');



    Route::any('privacy-policy', [dashboardController::class, 'privacyPolicy'])->name('privacy-policy');



    Route::any('share-you-travel', [dashboardController::class, 'shareYouTravel'])->name('share-you-travel');
    Route::any('delete-share-you-travel/{id}', [dashboardController::class, 'deleteshareYouTravel'])->name('delete-share-you-travel');
});
