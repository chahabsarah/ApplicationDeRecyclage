<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClaimsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminRegisterController;
use App\Http\Controllers\MyWalletController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\MarketPlaceController;
use App\Http\Controllers\ActiveBidsController;
use App\Http\Controllers\AllSavedController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ClaimsPdfController;

use App\Http\Controllers\MessageController;
use App\Http\Controllers\FlorgotPasswordController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\MyCollectionController;
use App\Http\Controllers\MarketPlaceDetailsController;
use App\Http\Controllers\ProductUploadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CentreDeRecyclageController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\CollecteController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\BonnePratiqueController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\Auth\RegisterController;


Route::controller(HomeController::class)->group(function () {
Route::get('/', 'index')->name('centres.index');
Route::get('/index', [CentreDeRecyclageController::class, 'indexFrontOffice'])->name('centres.indexFrontOffice');
Route::get('/index2', 'index2')->name('index2');
Route::get('/index3', 'index3')->name('index3');
Route::get('/about', 'about')->name('about');
Route::get('/destination','destination')->name('destination');
Route::get('/destinationdetails','destinationdetails')->name('destinationdetails');
Route::get('/tour','tour')->name('tour');
Route::get('/tourdetails','tourdetails')->name('tourdetails');
Route::get('/blog','blog')->name('blog');
Route::get('/blogdetails','blogdetails')->name('blogdetails');
Route::get('/contact','contact')->name('contact');
});
Route::get('/',[CentreDeRecyclageController::class, 'index'])->name('centres.index');

Route::get('/load-login', [AdminLoginController::class, 'index']);
Route::post('/admin-login', [AdminLoginController::class, 'login'])->name('login');

Route::get('/load-register', [AdminRegisterController::class, 'index']);
Route::post('/register', [AdminRegisterController::class, 'register'])->name('register');

Route::get('/history',[HistoryController::class,'index']);


Route::get('/my-wallet',[MyWalletController::class,'index']);

Route::get('/sell',[SellController::class,'index']);


Route::get('/market-place',[MarketPlaceController::class,'index']);

Route::get('/active-bids',[ActiveBidsController::class,'index']);

Route::get('/all-saved',[AllSavedController::class,'index']);


Route::get('/my-profile',[profileController::class,'index']);

Route::get('/setting',[SettingController::class,'index']);

Route::get('/notification',[NotificationController::class,'index']);

Route::get('/message',[MessageController::class,'index']);

Route::get('/forgot-password',[FlorgotPasswordController::class,'index']);
Route::post('/find-password',[FlorgotPasswordController::class,'findPassword']);

Route::get('/verify',[VerifyController::class,'index']);
Route::post('/verification',[VerifyController::class,'verification']);

Route::get('/my-collection',[MyCollectionController::class,'index']);

Route::get('/market-place-details',[MarketPlaceDetailsController::class,'index']);

Route::get('/upload-product',[ProductUploadController::class,'index']);

Route::post('/change-password',[SettingController::class,'changePassword']);

Route::get('/centres/create', [CentreDeRecyclageController::class, 'create'])->name('centres.create');
Route::post('/centres', [CentreDeRecyclageController::class, 'store'])->name('centres.store');
Route::get('/centres', [CentreDeRecyclageController::class, 'index'])->name('centres.index');
Route::get('/centres/{id}', [CentreDeRecyclageController::class, 'show'])->name('centres.show');
Route::get('/centres/{id}/edit', [CentreDeRecyclageController::class, 'edit'])->name('centres.edit');
Route::put('/centres/{id}', [CentreDeRecyclageController::class, 'update'])->name('centres.update');
Route::delete('/centres/{id}', [CentreDeRecyclageController::class, 'destroy'])->name('centres.destroy');
Route::get('/generate-pdf', [PDFController::class, 'generatePDF'])->name('generatePDF');
Route::get('/centresfront/{id}', [CentreDeRecyclageController::class, 'showFrontOffice'])->name('centres.showFrontOffice');
Route::get('/centresfront', [CentreDeRecyclageController::class, 'indexFrontOffice'])->name('centres.indexFrontOffice');

Route::resource('centres', CentreDeRecyclageController::class);

Route::get('/collectes/create', [CollecteController::class, 'create'])->name('collectes.create');
Route::post('/collectes', [CollecteController::class, 'store'])->name('collectes.store');
Route::get('/collectes', [CollecteController::class, 'index'])->name('collectes.index');
Route::get('/collectes/{id}', [CollecteController::class, 'show'])->name('collectes.show');
Route::get('/collectes/{id}/edit', [CollecteController::class, 'edit'])->name('collectes.edit');
Route::put('/collectes/{id}', [CollecteController::class, 'update'])->name('collectes.update');
Route::delete('/collectes/{id}', [CollecteController::class, 'destroy'])->name('collectes.destroy');
Route::get('/collectes/{etat?}', [CollecteController::class, 'index'])->name('collectes.index');
Route::get('/collectes/{id}/flux-de-donnees', [CollecteController::class, 'showFluxDeDonnees'])->name('collectes.show_flux_de_donnees');
Route::get('/collectesfront', [CollecteController::class, 'indexFrontOffice'])->name('collectes.indexFrontOffice');
Route::get('/collectesfront/{id}', [CollecteController::class, 'showFrontOffice'])->name('collectes.showFrontOffice');
Route::get('/collectesfront/{id}/flux-de-donnees', [CollecteController::class, 'showFluxDeDonneesFrontOffice'])->name('collectes.showFluxDeDonneesFrontOffice');
Route::get('/collectes/{collecte}', [CollecteController::class, 'show'])->name('collectes.show');

Route::resource('collectes', CollecteController::class);

Route::post('/email', [MailController::class, 'sendEmail'])->name('send.email');

Route::get('/qrcode', function () {

    return QrCode::size(300)
                    ->backgroundColor(255,55,0)
                    ->generate('A simple example of QR code');
});

Route::post('/facebook/post/{id}', [FacebookController::class, 'postToFacebook'])->name('facebook.post');

Route::get('/claims', [ClaimsController::class,'index'])->name('claims.index');

Route::post('/claims', [ClaimsController::class,'store'])->name('claims.store');
Route::get('viewClaims', [ClaimsController::class,'view'])->name('claims.view');
Route::delete('/claims/{id}', [ClaimsController::class, 'destroy'])->name('claims.destroy');
Route::get('/claims/{id}/edit', [ClaimsController::class, 'edit'])->name('claims.edit');
Route::put('/claims/{id}', [ClaimsController::class, 'update'])->name('claims.update');
Route::get('/search', [ClaimsController::class, 'search'])->name('claims.search');

Route::get('/categories', [CategoriesController::class,'index'])->name('categories.index');
Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
Route::delete('/categories/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');
Route::get('/categories/{id}/claims', [CategoryController::class, 'getClaims']);


Route::resource('bonne_pratiques', BonnePratiqueController::class);

Route::post('/bonne_pratiques/{id}/commentaires', [CommentaireController::class, 'store'])->name('commentaires.store');
Route::get('/frontoffice/bonne_pratiques', [BonnePratiqueController::class, 'indexFrontOffice'])->name('bonne_pratiques.indexFrontOffice');

Route::post('/bonne_pratiques/{id}/commentaires', [CommentaireController::class, 'store'])->name('commentaires.store');
Route::get('/frontoffice/bonne_pratiques', [BonnePratiqueController::class, 'indexFrontOffice'])->name('bonne_pratiques.indexFrontOffice');


Route::get('/export-pdf', [BonnePratiqueController::class, 'exportPDF'])->name('bonne_pratiques.exportPDF');
Route::get('/pdfclaim', [ClaimsPdfController::class, 'claimsPDF'])->name('claimsPdf');


Route::resource('roles', RolesController::class);
Route::resource('permissions', PermissionsController::class);
// Other routes...
