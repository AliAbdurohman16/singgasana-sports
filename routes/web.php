<?php


use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\Frontend\HomepageController::class, 'index'])->name('/');
Route::get('blog', [App\Http\Controllers\Frontend\BlogController::class, 'index'])->name('blog.index');
Route::get('blog/{slug}', [App\Http\Controllers\Frontend\BlogController::class, 'single'])->name('blog.single');
Route::get('blog/author/{id}', [App\Http\Controllers\Frontend\BlogController::class, 'author'])->name('blog.author');
Route::get('blog/date/{date}', [App\Http\Controllers\Frontend\BlogController::class, 'date'])->name('blog.date');
Route::get('blog/category/{slug}', [App\Http\Controllers\Frontend\BlogController::class, 'category'])->name('blog.category');
Route::get('blog/tag/{slug}', [App\Http\Controllers\Frontend\BlogController::class, 'tag'])->name('blog.tag');
Route::get('search', [App\Http\Controllers\Frontend\BlogController::class, 'search'])->name('blog.search');
Route::get('facilities/{slug}', [App\Http\Controllers\Frontend\FacilityController::class, 'index'])->name('facilities.index');
Route::get('pages/{slug}', [App\Http\Controllers\Frontend\PageController::class, 'index'])->name('pages.index');
Route::get('gallery', [App\Http\Controllers\Frontend\GalleryController::class, 'index'])->name('gallery.index');
Route::get('contact', [App\Http\Controllers\Frontend\ContactController::class, 'index'])->name('contact.index');
Route::get('booking/daily', [App\Http\Controllers\Frontend\BookingController::class, 'index'])->name('booking.daily');
Route::post('booking/daily', [App\Http\Controllers\Frontend\BookingController::class, 'store'])->name('booking.store');
Route::get('booking/member', [App\Http\Controllers\Frontend\BookingController::class, 'member'])->name('booking.member');
Route::post('booking/member', [App\Http\Controllers\Frontend\BookingController::class, 'storeMember'])->name('booking.storeMember');
Route::get('booking/schedule', [App\Http\Controllers\Frontend\BookingController::class, 'schedule'])->name('booking.schedule');

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
    Route::resources([
        'profile' => App\Http\Controllers\Backend\ProfileController::class,
        'change_password' => App\Http\Controllers\Backend\ChangePasswordController::class,
    ]);

    Route::middleware('checkUserRole:user')->group(function () {
        Route::get('booking/histories', [App\Http\Controllers\Backend\BookingController::class, 'index'])->name('booking.histories');
        Route::get('booking/create', [App\Http\Controllers\Backend\BookingController::class, 'create'])->name('booking.createMembers');
        Route::post('booking/store', [App\Http\Controllers\Backend\BookingController::class, 'store'])->name('booking.storeMembers');
    });

    Route::middleware('checkUserRole:admin,cashier')->group(function () {
        Route::get('booking/dailies', [App\Http\Controllers\Backend\BookingController::class, 'daily'])->name('booking.dailies');
        Route::get('booking/dailies/{id}', [App\Http\Controllers\Backend\BookingController::class, 'showDaily'])->name('booking.showDaily');
        Route::put('booking/dailies/{id}', [App\Http\Controllers\Backend\BookingController::class, 'validationDaily'])->name('booking.validationDaily');
        Route::get('booking/members', [App\Http\Controllers\Backend\BookingController::class, 'member'])->name('booking.members');
        Route::get('booking/members/{id}', [App\Http\Controllers\Backend\BookingController::class, 'showMember'])->name('booking.showMembers');
        Route::put('booking/members/{id}', [App\Http\Controllers\Backend\BookingController::class, 'validationMember'])->name('booking.validationMember');
        Route::resources([
            'category' => App\Http\Controllers\Backend\CategoryController::class,
            'write_articles' => App\Http\Controllers\Backend\WriteArticlesController::class,
            'article' => App\Http\Controllers\Backend\ArticleController::class,
            'page' => App\Http\Controllers\Backend\PageController::class,
            'facility' => App\Http\Controllers\Backend\FacilityController::class,
            'gallery_categories' => App\Http\Controllers\Backend\GalleryCategoriesController::class,
            'gallery_images' => App\Http\Controllers\Backend\GalleryController::class,
            'setting' => App\Http\Controllers\Backend\SettingController::class,
            'services' => App\Http\Controllers\Backend\ServiceController::class,
            'officers' => App\Http\Controllers\Backend\OfficerController::class,
            'users' => App\Http\Controllers\Backend\UserController::class,
        ]);
    });
});
