<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ConvertionController;
use App\Http\Controllers\FabricController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvontryController;
use App\Http\Controllers\StakeholderController;
use App\Http\Controllers\SuitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VarietyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YarnController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'showLoginForm']);

Route::post('/login', [AuthController::class,'login']);
Route::get('/sendrequest', [AuthController::class, 'request']);
Route::post('/saverequest', [AuthController::class, 'saverequest'])->name('saverequest');



Route::middleware(['auth.user'])->group(function () {
    Route::get('/logout', [AuthController::class,'logout']);

    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/slae_yarn', [YarnController::class, 'Sale_Yarn'])->name('slae_yarn');
    Route::get('/add_slae_yarn', [YarnController::class, 'Add_slae_yarn']);
    Route::post('/addyarnsale', [YarnController::class, 'AddYarnSaleRecod'])->name('addyarnsale');
    Route::delete('/delete_yarnsale/{id}', [YarnController::class, 'deleteYarnSale'])->name('delete_yarnsale');
    Route::get('/edit_yarnsale/{id}', [YarnController::class, 'EditYarnSalePage'])->name('edit_yarnsale');
    Route::put('/updateSaleYarnRecord/{id}', [YarnController::class, 'updateSaleYarnRecord'])->name('updateSaleYarnRecord');
    Route::get('/sale_yarn_payments', [YarnController::class, 'Sale_Yarn_Payments'])->name('sale_yarn_payments');
    Route::post('/yarnsalefilter', [YarnController::class, 'yarnsalefilter'])->name('yarnsalefilter');
    Route::get('/print-invoice/{id}', [InvoiceController::class, 'showInvoice'])->name('print_invoice');

    Route::get('/purchace_yarn', [YarnController::class, 'Purchace_yarn'])->name('purchace_yarn');
    Route::get('/add_purchace_yarn', [YarnController::class, 'Add_purchace_yarn']);
    Route::post('/addyarnpurchace', [YarnController::class, 'AddYarnPurchaceRecod'])->name('addyarnpurchace');
    Route::delete('/delete_yarnPurchace/{id}', [YarnController::class, 'deleteYarnPurchace'])->name('delete_yarnPurchace');
    Route::get('/edit_yarnpurchace/{id}', [YarnController::class, 'EditYarnPurchcePage'])->name('edit_yarnpurchace');
    Route::put('/updatePurchaceYarnRecord/{id}', [YarnController::class, 'updatePurchaceYarnRecord'])->name('updatePurchaceYarnRecord');
    Route::get('/yarnpurchase-invoice/{id}', [InvoiceController::class, 'yarnpurchase_invoice'])->name('yarnpurchase-invoice');    
    Route::post('/yarnpurchasefilter', [YarnController::class, 'yarnpurchasefilter'])->name('yarnpurchasefilter');
   
    Route::get('/yarn_invontry', [InvontryController::class, 'yarn_invontry'])->name('yarn_invontry');


    Route::get('/slae_fabric', [FabricController::class, 'Sale_Fabric'])->name('slae_fabric');
    Route::get('/add_slae_fabric', [FabricController::class, 'Add_slae_fabric']);
    Route::post('/addfabricsale', [FabricController::class, 'AddFarbricSaleRecord'])->name('addfabricsale');
    Route::delete('/delete_fabricsale/{id}', [FabricController::class, 'DeleteFabricSale'])->name('delete_fabricsale');
    Route::get('/edit_fabricsale/{id}', [FabricController::class, 'EditFabricSalePage'])->name('edit_fabricsale');
    Route::put('/updatesalefabricrecord/{id}', [FabricController::class, 'Updatesalefabricrecord'])->name('updatesalefabricrecord');
    Route::post('/fabricsalefilter', [FabricController::class, 'fabricsalefilter'])->name('fabricsalefilter');
    Route::get('/Salefabricinvoice/{id}', [InvoiceController::class, 'Salefabricinvoice'])->name('Salefabricinvoice');
    
    Route::get('/purchase_fabric', [FabricController::class, 'Purchase_Fabric'])->name('purchase_fabric');
    Route::get('/add_purchase_fabric', [FabricController::class, 'Add_purchase_fabric']);
    Route::post('/addfabricpurchase', [FabricController::class, 'AddFarbricPurchaseRecord'])->name('addfabricpurchase');
    Route::delete('/delete_fabricpurchase/{id}', [FabricController::class, 'DeleteFabricPurchase'])->name('delete_fabricpurchase');
    Route::get('/edit_fabricpuracse/{id}', [FabricController::class, 'EditFabricPurchasePage'])->name('edit_fabricpuracse');
    Route::put('/updatefabricpurchase/{id}', [FabricController::class, 'Updatefabricpurchase'])->name('updatefabricpurchase');
    Route::post('/fabricpurchasefilter', [FabricController::class, 'fabricpurchasefilter'])->name('fabricpurchasefilter');
    Route::get('/fabricpurchaseinvoice/{id}', [InvoiceController::class, 'fabricpurchaseinvoice'])->name('fabricpurchaseinvoice');
     
    Route::get('/fabric_invontry', [InvontryController::class, 'fabric_invontry'])->name('fabric_invontry');

    
    

    
    Route::get('/slae_suit', [SuitController::class, 'Sale_Suit'])->name('slae_suit');
    Route::get('/add_slae_suit', [SuitController::class, 'Add_slae_suit'])->name('add_slae_suit');
    Route::post('/addsuitsale', [SuitController::class, 'AddSuitSaleeRecord'])->name('addsuitsale');
    Route::delete('/delete_suitsale/{id}', [SuitController::class, 'DeleteSuitSale'])->name('delete_suitsale');
    Route::get('/edit_suitsale/{id}', [SuitController::class, 'EditSuitSalePage'])->name('edit_suitsale');
    Route::put('/updatesuitsale/{id}', [SuitController::class, 'updatesuitsale'])->name('updatesuitsale');
    Route::post('/suitsalefilter', [SuitController::class, 'suitsalefilter'])->name('suitsalefilter');
    Route::get('/salesuitinvice/{id}', [InvoiceController::class, 'salesuitinvice'])->name('salesuitinvice');
    
    
    Route::get('/purchase_suit', [SuitController::class, 'Purchase_suit'])->name('purchase_suit');
    Route::get('/add_purchase_suit', [SuitController::class, 'Add_purchase_suit']);
    Route::post('/addsuitpurachase', [SuitController::class, 'AddSuitPurchaseRecord'])->name('addsuitpurachase');
    Route::delete('/delete_suitpurchase/{id}', [SuitController::class, 'DeleteSuitPurchase'])->name('delete_suitpurchase');
    Route::get('/edit_suitpurchase/{id}', [SuitController::class, 'EditSuitPurchasePage'])->name('edit_suitpurchase');
    Route::put('/updatesuitpurchase/{id}', [SuitController::class, 'updatesuitpurchase'])->name('updatesuitpurchase');
    Route::post('/suitpurchasefilter', [SuitController::class, 'suitpurchasefilter'])->name('suitpurchasefilter');
    Route::get('/purchasesuitinvoice/{id}', [InvoiceController::class, 'purchasesuitinvoice'])->name('purchasesuitinvoice');
    
    Route::get('/suitinvontry', [InvontryController::class, 'suitinvontry'])->name('suitinvontry');
    Route::get('/editsuitinvontry/{id}', [VarietyController::class, 'editsuitinvontry'])->name('editsuitinvontry');
    
    
    Route::delete('/deletesuitinvontory/{id}', [VarietyController::class, 'Deletevarirty'])->name('deletesuitinvontory');
    Route::put('/updatevarity/{id}', [VarietyController::class, 'updatevarity'])->name('updatevarity');
    
    
    
    
    
    Route::get('yarntofabric', [ConvertionController::class, 'yarntofabric'])->name('yarntofabric');
    Route::get('addyarntofabric', [ConvertionController::class, 'AddYarnToFabricContract'])->name('addyarntofabric');
    Route::get('addnewqaulity', [ConvertionController::class, 'addnewqaulity'])->name('addnewqaulity');
    Route::post('/storequality', [ConvertionController::class, 'storequality'])->name('storequality');
    Route::post('saveyarntofabric', [ConvertionController::class, 'saveyarntofabric'])->name('saveyarntofabric');
    Route::delete('/delete_yarntofabric/{id}', [ConvertionController::class, 'DeleteYarntoFabric'])->name('delete_yarntofabric');
    Route::get('/fabricetoYarninvoice/{id}', [InvoiceController::class, 'fabricetoYarninvoice'])->name('fabricetoYarninvoice');

    Route::get('fabrictosuit', [ConvertionController::class, 'fabrictosuit'])->name('fabrictosuit');
    Route::get('addfabrictosuit', [ConvertionController::class, 'Addfabrictosuit'])->name('addfabrictosuit');
    Route::post('/savefabrictosuit', [ConvertionController::class, 'savefabrictosuit'])->name('savefabrictosuit');
    Route::get('/editfarictosuit/{id}', [ConvertionController::class, 'editfarictosuit'])->name('editfarictosuit');
    Route::put('/updatefabrictosuit/{id}', [ConvertionController::class, 'updatefabrictosuit'])->name('updatefabrictosuit');
    Route::delete('/deletefabrictosuit/{id}', [ConvertionController::class, 'deletefabrictosuit'])->name('deletefabrictosuit');
    Route::get('/fabrictosuitinvoice/{id}', [InvoiceController::class, 'fabrictosuitinvoice'])->name('fabrictosuitinvoice');
   
 

    Route::get('/addstakeholders', [StakeholderController::class, 'stackholderpage'])->name('addstakeholders');
    Route::post('supplierstore', [StakeholderController::class, 'supplierstore'])->name('supplierstore');
    Route::post('purchaserstore', [StakeholderController::class, 'purchaserstore'])->name('purchaserstore');
    Route::post('brokerstore', [StakeholderController::class, 'brokerstore'])->name('brokerstore');

    
   

    Route::get('/addnewvariety', [VarietyController::class, 'Addvariety'])->name('addnewvariety');
    Route::post('savevarity', [VarietyController::class, 'savevarity'])->name('savevarity');
    
});

Route::middleware(['auth', 'isSuperuser'])->group(function () {
    Route::get('/supplieraccounts', [AccountController::class, 'Supplieraccounts'])->name('supplieraccounts');
    Route::get('/purchaseraccounts', [AccountController::class, 'Purchaseraccounts'])->name('purchaseraccounts');
    Route::post('supplieraccountfilter', [AccountController::class, 'supplieraccountfilter'])->name('supplieraccountfilter');
    Route::post('purchaseraccountfilter', [AccountController::class, 'purchaseraccountfilter'])->name('purchaseraccountfilter');
    Route::get('/addpurchaseramount', [AccountController::class, 'addpurchaseramount'])->name('addpurchaseramount');
    Route::post('savepurchaseramout', [AccountController::class, 'savepurchaseramout'])->name('savepurchaseramout');
    Route::get('/purchaserdetail/{name}', [AccountController::class, 'showPurchaserDetail']);
    Route::get('/purchaserreport/{name}', [AccountController::class, 'purchaerreport']);
    Route::get('/purchaserlastreport/{name}', [AccountController::class, 'purchaerlastreport']);

    Route::get('/addsupplieramount', [AccountController::class, 'addsupplieramount'])->name('addsupplieramount');
    Route::post('savesupplieramout', [AccountController::class, 'savesupplieramout'])->name('savesupplieramout');
    Route::get('/supplierdetail/{name}', [AccountController::class, 'showsupplierdetail']);
    Route::delete('/deletesupplierdetail/{id}', [AccountController::class, 'deletesupplierdetail'])->name('deletesupplierdetail');
    Route::delete('/deletepurchaserdetail/{id}', [AccountController::class, 'deletepurchaserdetail'])->name('deletepurchaserdetail');
    Route::get('/supplierreport/{name}', [AccountController::class, 'supplierreport']);
    Route::get('/supplierlastreport/{name}', [AccountController::class, 'supplierlastreport']);


    Route::get('/user', [UserController::class,'index']);
    Route::put('changsuperstatus/{id}', [UserController::class, 'changsuperstatus'])->name('changsuperstatus');
    Route::put('changactivatestatus/{id}', [UserController::class, 'changactivatestatus'])->name('changactivatestatus');
});
