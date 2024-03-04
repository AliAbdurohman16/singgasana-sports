<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

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
        Route::get('booking/histories/{id}', [App\Http\Controllers\Backend\BookingController::class, 'show'])->name('booking.show');
        Route::get('booking/create', [App\Http\Controllers\Backend\BookingController::class, 'create'])->name('booking.createMembers');
        Route::post('booking/store', [App\Http\Controllers\Backend\BookingController::class, 'store'])->name('booking.storeMembers');
    });

    Route::middleware('checkUserRole:admin,cashier, superadmin')->group(function () {
        Route::get('booking/dailies', [App\Http\Controllers\Backend\BookingController::class, 'daily'])->name('booking.dailies');
        Route::get('booking/dailies/{id}', [App\Http\Controllers\Backend\BookingController::class, 'showDaily'])->name('booking.showDaily');
        Route::put('booking/dailies/{id}', [App\Http\Controllers\Backend\BookingController::class, 'validationDaily'])->name('booking.validationDaily');
        Route::get('booking/members', [App\Http\Controllers\Backend\BookingController::class, 'member'])->name('booking.members');
        Route::get('booking/members/{id}', [App\Http\Controllers\Backend\BookingController::class, 'showMember'])->name('booking.showMembers');
        Route::put('booking/members/{id}', [App\Http\Controllers\Backend\BookingController::class, 'validationMember'])->name('booking.validationMember');
        Route::get('booking/schools', [App\Http\Controllers\Backend\BookingController::class, 'school'])->name('booking.schools');
        Route::get('booking/schools/{id}', [App\Http\Controllers\Backend\BookingController::class, 'showSchool'])->name('booking.showSchools');
        Route::put('booking/schools/{id}', [App\Http\Controllers\Backend\BookingController::class, 'validationSchool'])->name('booking.validationSchool');
        Route::put('booking/schools/not-present/{id}', [App\Http\Controllers\Backend\BookingController::class, 'notPresent'])->name('booking.notPresent');
        Route::get('service/swimming-pool', [App\Http\Controllers\Backend\SwimmingPoolController::class, 'index'])->name('swimmingPool');
        Route::get('service/swimming-pool/daily/{id}', [App\Http\Controllers\Backend\SwimmingPoolController::class, 'dailyEdit'])->name('swimmingPoolDaily.edit');
        Route::put('service/swimming-pool/daily/{id}', [App\Http\Controllers\Backend\SwimmingPoolController::class, 'dailyUpdate'])->name('swimmingPoolDaily.update');
        Route::get('service/swimming-pool/member/{id}', [App\Http\Controllers\Backend\SwimmingPoolController::class, 'memberEdit'])->name('swimmingPoolMember.edit');
        Route::put('service/swimming-pool/member/{id}', [App\Http\Controllers\Backend\SwimmingPoolController::class, 'memberUpdate'])->name('swimmingPoolMember.update');
        Route::get('service/basket', [App\Http\Controllers\Backend\BasketController::class, 'index'])->name('basket');
        Route::get('service/basket/daily/{id}', [App\Http\Controllers\Backend\BasketController::class, 'dailyEdit'])->name('basketDaily.edit');
        Route::put('service/basket/daily/{id}', [App\Http\Controllers\Backend\BasketController::class, 'dailyUpdate'])->name('basketDaily.update');
        Route::get('service/basket/member/{id}', [App\Http\Controllers\Backend\BasketController::class, 'memberEdit'])->name('basketMember.edit');
        Route::put('service/basket/member/{id}', [App\Http\Controllers\Backend\BasketController::class, 'memberUpdate'])->name('basketMember.update');
        Route::get('service/badminton', [App\Http\Controllers\Backend\BadmintonController::class, 'index'])->name('badminton');
        Route::get('service/badminton/daily/{id}', [App\Http\Controllers\Backend\BadmintonController::class, 'dailyEdit'])->name('badmintonDaily.edit');
        Route::put('service/badminton/daily/{id}', [App\Http\Controllers\Backend\BadmintonController::class, 'dailyUpdate'])->name('badmintonDaily.update');
        Route::get('service/badminton/member/{id}', [App\Http\Controllers\Backend\BadmintonController::class, 'memberEdit'])->name('badmintonMember.edit');
        Route::put('service/badminton/member/{id}', [App\Http\Controllers\Backend\BadmintonController::class, 'memberUpdate'])->name('badmintonMember.update');
        Route::get('service/tennis', [App\Http\Controllers\Backend\TennisController::class, 'index'])->name('tennis');
        Route::get('service/tennis/daily/{id}', [App\Http\Controllers\Backend\TennisController::class, 'dailyEdit'])->name('tennisDaily.edit');
        Route::put('service/tennis/daily/{id}', [App\Http\Controllers\Backend\TennisController::class, 'dailyUpdate'])->name('tennisDaily.update');
        Route::get('service/tennis/member/{id}', [App\Http\Controllers\Backend\TennisController::class, 'memberEdit'])->name('tennisMember.edit');
        Route::put('service/tennis/member/{id}', [App\Http\Controllers\Backend\TennisController::class, 'memberUpdate'])->name('tennisMember.update');
        Route::get('service/table-tennis', [App\Http\Controllers\Backend\TableTennisController::class, 'index'])->name('tableTennis');
        Route::get('service/table-tennis/daily/{id}', [App\Http\Controllers\Backend\TableTennisController::class, 'dailyEdit'])->name('tableTennisDaily.edit');
        Route::put('service/table-tennis/daily/{id}', [App\Http\Controllers\Backend\TableTennisController::class, 'dailyUpdate'])->name('tableTennisDaily.update');
        Route::get('service/table-tennis/member/{id}', [App\Http\Controllers\Backend\TableTennisController::class, 'memberEdit'])->name('tableTennisMember.edit');
        Route::put('service/table-tennis/member/{id}', [App\Http\Controllers\Backend\TableTennisController::class, 'memberUpdate'])->name('tableTennisMember.update');
        Route::get('service/squash', [App\Http\Controllers\Backend\SquashController::class, 'index'])->name('squash');
        Route::get('service/squash/daily/{id}', [App\Http\Controllers\Backend\SquashController::class, 'dailyEdit'])->name('squashDaily.edit');
        Route::put('service/squash/daily/{id}', [App\Http\Controllers\Backend\SquashController::class, 'dailyUpdate'])->name('squashDaily.update');
        Route::get('service/squash/member/{id}', [App\Http\Controllers\Backend\SquashController::class, 'memberEdit'])->name('squashMember.edit');
        Route::put('service/squash/member/{id}', [App\Http\Controllers\Backend\SquashController::class, 'memberUpdate'])->name('squashMember.update');
        Route::resources([
            'category' => App\Http\Controllers\Backend\CategoryController::class,
            'write_articles' => App\Http\Controllers\Backend\WriteArticlesController::class,
            'article' => App\Http\Controllers\Backend\ArticleController::class,
            'page' => App\Http\Controllers\Backend\PageController::class,
            'facility' => App\Http\Controllers\Backend\FacilityController::class,
            'gallery_categories' => App\Http\Controllers\Backend\GalleryCategoriesController::class,
            'gallery_images' => App\Http\Controllers\Backend\GalleryController::class,
            'setting' => App\Http\Controllers\Backend\SettingController::class,
            'officers' => App\Http\Controllers\Backend\OfficerController::class,
            'users' => App\Http\Controllers\Backend\UserController::class,
        ]);
    });
});


// Auto Expired
Route::get('auto-expired', [App\Http\Controllers\AutoExpiredController::class, 'index'])->name('auto-expired');
