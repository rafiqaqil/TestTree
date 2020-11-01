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

use App\Http\Controllers;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect('/login');
});

use App\Http\Controllers\ShopController;
use App\Http\Controllers\DM3treeController;
use App\Http\Controllers\DM5treeController;
use App\Http\Controllers\HomeController;


Route::get('/New', [ShopController::class , 'index']);


use App\Http\Controllers\newContol;

Route::get('/NewC', [newContol::class , 'index']);
Route::get('/sponsor', [newContol::class , 'index2']);

Route::get('/{aku}/keluargaku', [newContol::class , 'keluargaku']);
Route::get('/{parent}/buatanak/', [newContol::class , 'buatanak']);
Route::get('/{aku}/punyaAtok/', [newContol::class , 'punyaAtok']);
Route::get('/{aku}/UntungSponsor/', [newContol::class , 'UntungSponsor']);
//Route::get('/New', 'ShopController@index');
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/register/{sponsor}', [App\Http\Controllers\PublicController::class, 'registerWithSponsor']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
  //DM5 ROUTESSS

Route::get('/DM5', [DM5treeController::class , 'index']);
Route::get('/DM5/INSERT/{namaDia}/{ownerID}', [DM5treeController::class , 'AddOneTestV2']);

Route::get('/DM5/Update', [DM5treeController::class , 'updateBalance']);
Route::get('/DM5-G', [DM5treeController::class , 'index2']);
Route::get('/DM5/tambahMember/{namaDia}', [DM5treeController::class , 'tambahMember']);
Route::get('/DM5/tambahMemberSoftly/{namaDia}', [DM5treeController::class , 'tambahMemberSoftly']);
Route::get('/DM5/BasicUpdate', [DM5treeController::class , 'updateBalance']);
Route::get('/DM5/updateBalanceMINMAX/{min}/{max}', [DM5treeController::class , 'updateBalanceMINMAX']);


//Route::get('/A-DM5', [DM5treeController::class , 'ArrangeTree']);
  //DM3 ROUTESSS

Route::get('/DM3', [DM3treeController::class , 'index']);
Route::get('/DM3/Update', [DM3treeController::class , 'updateBalance']);
Route::get('/DM3-G', [DM3treeController::class , 'index2']);
//Route::get('/DM3/tambahMember/{namaDia}', [DM3treeController::class , 'tambahMember']);
//Route::get('/DM3/tambahMemberSoftly/{namaDia}', [DM3treeController::class , 'tambahMemberSoftly']);
Route::get('/DM3/INSERT/{namaDia}/{ownerID}', [DM3treeController::class , 'DM3addSilently']);
use App\Http\Controllers\ProfileController;

//PROFILE ROUTE
Route::get('/Myprofile', [ProfileController::class , 'index']);
Route::get('/editMyProfile', [ProfileController::class , 'edit']);
Route::patch('/UpdateProfile/{user}', [ProfileController::class , 'UpdateProfile']);

use App\Http\Controllers\UserViews;
//USERViewSummary 


Route::get('/logoutNow', [UserViews::class , 'logoutNowToLink']);
Route::get('/ShowMyDM3', [UserViews::class , 'ShowMyDM3']);
Route::get('/ShowMySponsor', [UserViews::class , 'ShowMySponsor']);
Route::get('/ShowMyDM5', [UserViews::class , 'ShowMyDM5']);
Route::get('/MyDM3/{DM3}', [UserViews::class , 'OneOfMyDM3']);
Route::get('/MyDM5/{DM5}', [UserViews::class , 'OneOfMyDM5']);
Route::get('/ShowMySponsorTree', [UserViews::class , 'ShowMySponsorTree']);


//USER MINI TREE VIEWS
Route::get('/MyDM3', [ProfileController::class , 'MyDM3']);
Route::get('/MyDM5', [ProfileController::class , 'MyDM5']);

Route::get('/MySponsorData', [ProfileController::class , 'MySponsorData']);
//User Widthdraw Functions

use App\Http\Controllers\WidthdrawController;
Route::get('/MyWallet', [WidthdrawController::class , 'MyWallet']);
Route::get('/Show/MyWidthdraw', [WidthdrawController::class , 'MyWidthdraw']);
Route::get('/Create/Widthdraw', [WidthdrawController::class , 'CreateWidthdraw']);
Route::post('/Store/Widthdraw', [WidthdrawController::class , 'StoreWidthdraw']);
Route::get('/CancelMyWidthdraw/{withdraw}', [WidthdrawController::class , 'Cancel']);

use App\Http\Controllers\TransferController;
Route::get('/Create/Transfer', [TransferController::class , 'create']);
Route::post('/Store/Transfer', [TransferController::class , 'store']);
Route::get('/CancelTransfer/{transfer}', [TransferController::class , 'Cancel']);
Route::get('/ConfirmTransdfer/{transfer}', [TransferController::class , 'Approve']);



use App\Http\Controllers\MembershipController;
//Memebership ROUTES
Route::get('/MyMembership', [MembershipController::class , 'index']);
Route::get('/PurchaseMembership/Clear', [MembershipController::class , 'buyMembershipClear']);
Route::get('/PurchaseMembership/X', [MembershipController::class , 'buyMembershipX']);
Route::get('/PurchaseMembership/X1', [MembershipController::class , 'buyMembershipX1']);
Route::get('/PurchaseMembership/X5', [MembershipController::class , 'buyMembershipX5']);
Route::patch('/UpdateSponsor/{profile}', [MembershipController::class , 'UpdateSponsor']);
Route::get('/ActivateAccount', [MembershipController::class , 'ActivateAccount']);
Route::post('/ActivateAccount/ConfirmPayment', [MembershipController::class , 'ConfirmPayment']);
Route::post('/Placement/ConfirmPayment', [MembershipController::class , 'ConfirmPlacementPayment']);




use App\Http\Controllers\AdminMembershipController;
//Admin Controllers
Route::get('/manageNewPlans', [AdminMembershipController::class , 'manageNewPlans']);
Route::get('/adminAction/{profile}/ApprovePayment', [AdminMembershipController::class , 'ApprovePlanPayment']);
Route::get('/ManagePlacements', [AdminMembershipController::class , 'ManagePlacements']);
Route::get('/adminAction/{profile}/ApprovePlacement', [AdminMembershipController::class , 'ApprovePlacement']);

Route::get('/ControlPanel', [App\Http\Controllers\AdminMembershipController::class , 'ControlPanel']);

Route::get('/sponsor-G', [App\Http\Controllers\SponsorController::class , 'index3']);

Route::get('/ShowNewUsers', [App\Http\Controllers\AdminMembershipController::class , 'ListActivateAccount']);
Route::get('/adminAction/{id}/ActivateAccount', [AdminMembershipController::class , 'ActivateAccountThisID']);
Route::get('/adminAction/{id}/CancelActivateAccount', [AdminMembershipController::class , 'CancelActivateAccountThisID']);
Route::get('/adminAction/{profile}/CancelApprovePayment', [AdminMembershipController::class , 'CancelApprovePayment']);

use App\Http\Controllers\AdminWithdrawController;
//Admin Withdrawal System
Route::get('/ManageWithdrawal', [AdminWithdrawController::class , 'index']);
Route::get('/adminAction/{withdraw}/Credited', [AdminWithdrawController::class , 'Credited']);
Route::get('/adminAction/{withdraw}/Cancel', [AdminWithdrawController::class , 'Cancel']);





use App\Http\Controllers\MidnightEngine;
//Midnight Calculator
Route::get('/MDC/Update/Sponsor', [MidnightEngine::class , 'UpdateSponsor']);
Route::get('/MDC/Update/DM5', [MidnightEngine::class , 'UpdateDM5']);
Route::get('/MDC/Update/DM3', [MidnightEngine::class , 'UpdateDM3']);
Route::get('/MDC/Credit4More', [MidnightEngine::class , 'MidnightCreditForDM5']);
Route::get('/MDC/SHOW/Credit4More', [MidnightEngine::class , 'ShowMidnightCreditForDM5']);



use App\Http\Controllers\AdminMasterView;
Route::get('/Audit/Users', [AdminMasterView::class , 'index']);
Route::get('/Audit/View/{user}', [AdminMasterView::class , 'showUser']);
Route::get('/Audit/View/{user}/SponsorTree', [AdminMasterView::class , 'ShowOneSponsorTree']);







