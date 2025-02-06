<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ConsultanceController;
use App\Http\Controllers\FamilyHeaderController;
use App\Http\Controllers\FamilyMemberController;
use App\Http\Controllers\IremboController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchFamilyController;
use App\Http\Controllers\SectorSettingsController;
use App\Http\Controllers\UserController;
use App\Http\Resources\SearchResource;
use App\Models\Consultance;
use App\Models\HospitalCard;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/test_sms', function () {

//     $message = "Muraho neza? ";
//     $data = array(

//         "sender" => 'Nigoote ltd',

//         "recipients" => "0727556378",
//         "message" => $message,
//     );

//     $url = "https://www.intouchsms.co.rw/api/sendsms/.json";
//     $data = http_build_query($data);
//     $username = "nigoote.ltd";
//     $password = "Enock@123";
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//     $result = curl_exec($ch);
//     $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//     curl_close($ch);
//     echo $result;

// });
Route::get('/test_sms', function () {
    $data=array(
        "sender"=>'ISMS',
        "recipients"=>"0727556378",
        "message"=>"Test sms AP",
      );

$url="https://www.intouchsms.co.rw/api/sendsms/.json";
$data=http_build_query($data);
$username="menyatips";
$password="Menyatips14";

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_USERPWD,$username.":".$password);
curl_setopt($ch,CURLOPT_POST,true);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
$result=curl_exec($ch);
$httpcode=curl_getinfo($ch,CURLINFO_HTTP_CODE);
curl_close($ch);

echo $result;

});

Route::get('/', function () {
    return to_route('login');
})->name('home');
Route::get('/dashboard', function () {
    $numbers = [
        'users' => User::count(),
        'cards' => HospitalCard::withTrashed()->count(),
        'admissions' => Consultance::count(),
    ];
    $cards = HospitalCard::withTrashed()->orderByDesc('id')->limit(10)->get();
    return Inertia::render('Dashboard', ['cards' => SearchResource::collection($cards), 'numbers' => $numbers]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('sector')->name('sector.')->group(function () {
    Route::resource('families', FamilyHeaderController::class);
    Route::get('families/getSectors/{district}', [FamilyHeaderController::class, 'getSectors'])->name('families.getSectors');
    Route::get('families/getCells/{sector}', [FamilyHeaderController::class, 'getCells'])->name('families.getCells');
    Route::get('families/getVillages/{cell}', [FamilyHeaderController::class, 'getVillages'])->name('families.getVillages');

    Route::resource('family-members', FamilyMemberController::class);
    Route::controller(SectorSettingsController::class)->prefix('mutual-categories')->name('mutual-categories.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::put('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });
});
Route::controller(IremboController::class)->prefix('irembo')->name('irembo.')->group(function () {
    Route::get('mutuelle', 'mutuelle')->name('mutuelle');
    Route::post('mutuelle', 'mutuelleSearch')->name('mutuelleSearch');
    Route::get('mutuelle/{family}', 'mutuelleShow')->name('mutuelleShow');
    Route::get('mutuelle-pay/success', 'mutuellePaySuccess')->name('mutuellePaySuccess');
    Route::post('mutuelleChechout', 'mutuelleChechout')->name('mutuelleChechout');
});

Route::controller(SearchFamilyController::class)->group(function () {
    Route::get('/smart-search', 'smartSearch')->name('smartSearch');
    Route::post('consultation-payment/{patient}', 'consultationPayment')->name('consultation-payment');
    Route::get('/search/departments', 'departments')->name('search.departments');
    Route::post('/consultanceSubmit', 'consultanceSubmit')->name('consultanceSubmit');
    Route::get('/search-person/{cardnumber}', 'searchPerson')->name('searchPerson');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class);
    Route::controller(SearchFamilyController::class)->group(function () {
        Route::get('/manual-search', 'manualSearch')->name('manualSearch');
        // Route::get('/smart-search', 'smartSearch')->name('smartSearch');
        Route::get('/family/{family}', 'showFamily')->name('showFamily');
        Route::post('/save-cardnumber', 'saveCardNumber')->name('saveCardNumber');
        // Route::get('/search-person/{cardnumber}', 'searchPerson')->name('searchPerson');
        // Route::get('/search/departments', 'departments')->name('search.departments');
    });
    Route::controller(CardController::class)->prefix('cards')->name('cards.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });
    Route::controller(ConsultanceController::class)->prefix('consultance')->name('consultance.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/treated', 'treated')->name('treated');
        Route::put('/{id}', 'approveTreatment')->name('approveTreatment');
        Route::get('/all', 'allAdmission')->name('allAdmission');
    });
});
require __DIR__ . '/auth.php';
