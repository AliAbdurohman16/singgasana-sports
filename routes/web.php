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
Route::post('membership/personal', [App\Http\Controllers\Frontend\MembershipController::class, 'storePersonal'])->name('membership.personal');
Route::post('membership/couple', [App\Http\Controllers\Frontend\MembershipController::class, 'storeCouple'])->name('membership.couple');
Route::post('membership/triple', [App\Http\Controllers\Frontend\MembershipController::class, 'storeTriple'])->name('membership.triple');
Route::post('membership/family', [App\Http\Controllers\Frontend\MembershipController::class, 'storeFamily'])->name('membership.family');
Route::post('membership/student', [App\Http\Controllers\Frontend\MembershipController::class, 'storeStudent'])->name('membership.student');
Route::post('membership/community', [App\Http\Controllers\Frontend\MembershipController::class, 'storeCommunity'])->name('membership.community');

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
    Route::resources([
        'category' => App\Http\Controllers\Backend\CategoryController::class,
        'write_articles' => App\Http\Controllers\Backend\WriteArticlesController::class,
        'article' => App\Http\Controllers\Backend\ArticleController::class,
        'page' => App\Http\Controllers\Backend\PageController::class,
        'facility' => App\Http\Controllers\Backend\FacilityController::class,
        'gallery_categories' => App\Http\Controllers\Backend\GalleryCategoriesController::class,
        'gallery_images' => App\Http\Controllers\Backend\GalleryController::class,
        'profile' => App\Http\Controllers\Backend\ProfileController::class,
        'change_password' => App\Http\Controllers\Backend\ChangePasswordController::class,
        'setting' => App\Http\Controllers\Backend\SettingController::class,
        'membership' => App\Http\Controllers\Backend\MembershipController::class,
    ]);
});
