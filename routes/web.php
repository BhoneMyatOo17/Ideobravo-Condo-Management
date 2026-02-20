<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ParcelController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CondominiumController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailSubscriptionController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/team', function () {
    return view('team');
})->name('team');

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy.policy');

Route::get('/legal-notice', function () {
    return view('legal-notice');
})->name('legal.notice');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/logout-page', function () {
    return view('logout');
});

//500 Error TEST ONLY route
Route::get('/test-500', function () {
    abort(500);
});

Route::get('/form', function () {
    return view('samples.form');
});

Route::get('/test-loading', function () {
    session()->flash('show_loading', true);
    return view('test-loading');
});

Route::get('/confirmed', function () {
    return view('samples.confirmed');
});

Route::get('/payment', function () {
    return view('samples.payment');
});

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::post('/subscribe', [EmailSubscriptionController::class, 'store']);


/*
|--------------------------------------------------------------------------
| Google OAuth Routes
|--------------------------------------------------------------------------
*/

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

/*
|--------------------------------------------------------------------------
| Authenticated Routes (All Users)
|--------------------------------------------------------------------------
*/

// Condo Code Registration Flow - Only for users WITHOUT roles
Route::middleware('auth')->group(function () {
    Route::get('/condo-code', [\App\Http\Controllers\Auth\CondoCodeController::class, 'show'])->name('condo-code');
    Route::post('/condo-code/verify', [\App\Http\Controllers\Auth\CondoCodeController::class, 'verify'])->name('condo-code.verify');
    Route::get('/resident/details', [\App\Http\Controllers\Auth\CondoCodeController::class, 'showDetails'])->name('resident.details');
    Route::post('/resident/complete', [\App\Http\Controllers\Auth\CondoCodeController::class, 'complete'])->name('resident.complete');
});

// Profile Management - View/Edit own profile (All users WITH roles)
Route::middleware(['auth', 'ensure.user.has.role'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User Management - Index/Create/Show users (Staff & Admin only)
Route::middleware(['auth', 'verified', 'ensure.user.has.role', 'role:staff,admin'])->group(function () {
    Route::get('/users', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/users/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/users', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/users/{user}', [ProfileController::class, 'showUser'])->name('profile.showUser');
    Route::get('/users/{user}/edit', [ProfileController::class, 'editUser'])->name('profile.editUser');
    Route::patch('/users/{user}', [ProfileController::class, 'updateUser'])->name('profile.updateUser');
    Route::delete('/users/{user}/delete-resident', [ProfileController::class, 'deleteResident'])->name('profile.deleteResident');
});
/*
|--------------------------------------------------------------------------
| Dashboard & Core Features (Requires Role Assignment)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'ensure.user.has.role'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Announcements - List view (All users can view)
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    
    // Staff/Admin announcement management routes MUST come before the {announcement} wildcard
    Route::middleware(['role:staff,admin'])->group(function () {
        Route::get('/announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
        Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');
        Route::get('/announcements/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
        Route::patch('/announcements/{announcement}', [AnnouncementController::class, 'update'])->name('announcements.update');
        Route::delete('/announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');
    });
    
    // This wildcard route must come LAST
    Route::get('/announcements/{announcement}', [AnnouncementController::class, 'show'])->name('announcements.show');
});

/*
|--------------------------------------------------------------------------
| Resident Routes (Requires Resident Role)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'ensure.user.has.role', 'role:resident'])->group(function () {
    
    // My Parcels (Resident view of their own parcels)
    Route::get('/my-parcels', [ParcelController::class, 'myParcels'])->name('parcels.my-parcels');
    Route::get('/my-parcels/{parcel}', [ParcelController::class, 'myParcelShow'])->name('parcels.my-parcel-show');

    // My Bills (Resident view of their own bills)
    Route::prefix('my-bills')->name('my-bills.')->group(function () {
    Route::get('/', [BillController::class, 'myBills'])->name('index');
    Route::get('/{bill}', [BillController::class, 'myBillShow'])->name('show');
    Route::post('/{bill}/upload-payment', [BillController::class, 'uploadPayment'])->name('upload-payment');
    Route::post('/{bill}/card-payment', [BillController::class, 'submitCard'])->name('card.submit');
});
});

/*
|--------------------------------------------------------------------------
| Staff & Admin Routes (Parcel, Bill, Resident Management)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'ensure.user.has.role', 'role:staff,admin'])->group(function () {
    
    // Parcel Management (Staff can receive and manage parcels)
    Route::get('/parcels', [ParcelController::class, 'index'])->name('parcels.index');
    Route::get('/parcels/create', [ParcelController::class, 'create'])->name('parcels.create');
    Route::post('/parcels', [ParcelController::class, 'store'])->name('parcels.store');
    Route::get('/parcels/{parcel}', [ParcelController::class, 'show'])->name('parcels.show');
    Route::get('/parcels/{parcel}/edit', [ParcelController::class, 'edit'])->name('parcels.edit');
    Route::put('/parcels/{parcel}', [ParcelController::class, 'update'])->name('parcels.update');
    Route::delete('/parcels/{parcel}', [ParcelController::class, 'destroy'])->name('parcels.destroy');
    Route::post('/parcels/{parcel}/mark-picked-up', [ParcelController::class, 'markPickedUp'])->name('parcels.mark-picked-up');

    // Bill Management (Staff can generate and manage bills)
    Route::prefix('bills')->name('bills.')->group(function () {
        Route::get('/', [BillController::class, 'index'])->name('index');
        Route::get('/create', [BillController::class, 'create'])->name('create');
        Route::post('/', [BillController::class, 'store'])->name('store');
        Route::get('/{bill}', [BillController::class, 'show'])->name('show');
        Route::get('/{bill}/edit', [BillController::class, 'edit'])->name('edit');
        Route::put('/{bill}', [BillController::class, 'update'])->name('update');
        Route::delete('/{bill}', [BillController::class, 'destroy'])->name('destroy');
        Route::post('/{bill}/mark-as-paid', [BillController::class, 'markAsPaid'])->name('mark-as-paid');
    });

    // Resident Management (Staff can view and manage residents)
    Route::resource('residents', ResidentController::class);

    Route::prefix('newsletter')->name('newsletter.')->group(function () {
        Route::get('/', [App\Http\Controllers\NewsletterController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\NewsletterController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\NewsletterController::class, 'store'])->name('store');
        Route::delete('/{subscriber}', [App\Http\Controllers\NewsletterController::class, 'destroy'])->name('destroy');
    });

    // Contact Requests Management (Staff & Admin only)
    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::get('/{contact}', [ContactController::class, 'show'])->name('show');
        Route::patch('/{contact}/resolve', [ContactController::class, 'resolve'])->name('resolve');
    });

});

/*
|--------------------------------------------------------------------------
| Admin Only Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'ensure.user.has.role', 'role:admin'])->group(function () {
    
    // Staff Management (Admin only)
    Route::resource('staff', StaffController::class);

    // Condominium Management (Admin only)
    Route::resource('condominiums', CondominiumController::class);
    Route::post('/condominiums/{condominium}/regenerate-code', [CondominiumController::class, 'regenerateCode'])->name('condominiums.regenerate-code');

   // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/', [App\Http\Controllers\ReportController::class, 'index'])->name('index');
    Route::get('/bills', [App\Http\Controllers\ReportController::class, 'bills'])->name('bills');
    Route::get('/parcels', [App\Http\Controllers\ReportController::class, 'parcels'])->name('parcels');
    Route::get('/residents', [App\Http\Controllers\ReportController::class, 'residents'])->name('residents');
});

});


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';