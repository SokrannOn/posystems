<?php
use App\Customer;
use App\Usage;
use App\Product;
use App\TpmPurchaseOrder;
use App\Purchaseorder;
use App\Pricelist;
use Carbon\Carbon;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin','middleware'=>'auth'], function () {
   	Route::get('/','DashbordController@index');
	Route::resource('dashbords','DashbordController');
	Route::resource('positions','PositionController');
	Route::resource('zones','ZoneController');
	Route::resource('users','UserController');
	Route::get('/resets/{id}','UserController@reset');
	Route::get('/updatelogs1/{id}','UserController@updateLog1');
	Route::get('/updatelogs0/{id}','UserController@updateLog0');
	Route::patch('/updates/{id}','UserController@updatepw');
	Route::resource('customers','customerController');
	Route::resource('categories','CategoryController');
	Route::resource('products','ProductController');
	Route::resource('channels','ChannelController');
	Route::resource('provinces','ProvinceController');
	Route::resource('districts','DistrictController');
	Route::resource('communes','CommuneController');
	Route::resource('villages','VillageController');
	Route::resource('invoices','InvoiceController');
	Route::resource('usages','UsageController');
	Route::resource('purchaseOrders','PurchaseOrderController');
	Route::resource('suppliers','SupplierController');
	Route::resource('pricelists','PriceListController');
	Route::resource('purchaseOrdersSD','PurchaseOrderSDController');
	Route::resource('invoicePO','InvoicePOController');
	Route::resource('summaryInv','CraditPOController');
	Route::resource('stocks','StockController');
	Route::resource('setValues','SetValueController');
	Route::get('/inv','InvoiceController@inv');
	Route::get('/invoice','InvoiceController@invoice');
	Route::resource('summaryInvs','CraditPOController');
	Route::get('/details/{id}','CraditPOController@detail');
	Route::get('/showpaid/{id}','InvoicePOController@showInvoicePaid');
	
	
	
});
//endAdmin
//Route::post('/insert',array('as'=>'insert','invoices'=>'InvoiceController'));
Route::get('/getPopup','PurchaseOrderController@popupCus');
Route::get('/removeOrderCus/{id}',function($id){
	 	$tpmPurchaseOrders = TpmPurchaseOrder::where('id','=', $id)->first();
	 	$tpmPurchaseOrders->delete();
        return response()->json($id);
});
Route::get('/removeOrderSD/{id}',function($id){
	 	$tpmPurchaseOrders = TpmPurchaseOrder::where('id','=', $id)->first();
	 	$tpmPurchaseOrders->delete();
        return response()->json($id);
});
Route::get('/getProduct/{id}',function($id){
		$product_code = Product::where('id','=', $id)->value('product_code');
	 	$products = Product::findOrFail($id);
	 	foreach ($products->pricelists as $product) {
	 		$pricelist_id = $product->id;
	 		$sql = "SELECT sellingprice FROM pricelists WHERE id={$pricelist_id} AND now()>=startdate AND now()<=enddate";
		 	$result = DB::select($sql);
		 	foreach ($result as $row) {
		 		$price = $row->sellingprice;
		 	}
	 	}
	 	return response()->json(['pro_code'=>$product_code,'price'=>$price]);
	});

Route::get('/getProvince/{id}',function($id){
	 	$district = DB::table('districts')->select('id','name')->where('province_id','=', $id)->get();
        return response()->json($district);
});
Route::get('/getDistrict/{id}',function($id){
	 	$commune = DB::table('communes')->select('id','name')->where('district_id','=', $id)->get();
        //dd($commune);
        return response()->json($commune);
});
Route::get('/getCommune/{id}',function($id){
	 	$village = DB::table('villages')->select('id','name')->where('commune_id','=', $id)->get();
        //dd($commune);
        return response()->json($village);
});
Route::get('/getCustomer/{id}',function($id){
	 	$customers = Customer::where('id','=', $id)->first();
	 	//dump($cusemail);
	 	$channels = $customers->channel()->select('id','description')->first();
	 	//dd($channels);
        return response()->json([$customers,$channels]);
});

Route::get('/getEndNoCus/{customer_id}',function($customer_id){
	 	$endNo = Usage::select('endNo')->where('customer_id','=', $customer_id)->orderBy('created_at', 'desc')->value('endNo');
	 	if($endNo==''){
	 		return response()->json(0);
	 	}else{
	 		return response()->json($endNo);
	 	}
        
});
Route::get('/getPOInfo/{id}',function($id){
	 	$po = Purchaseorder::where('id','=', $id)->get();
        return response()->json($po);
});

Route::get('/addOrderCus/{proid}/{qty}/{price}/{amount}','PurchaseOrderController@addOrderCus');
Route::get('/showProductCus','PurchaseOrderController@showProductCus');
Route::get('/addOrderSD/{proid}/{qty}/{price}/{amount}','PurchaseOrderSDController@addOrderSD');
Route::get('/showProductSD','PurchaseOrderSDController@showProductSD');

// Route::get('/removeOrder/{id}','PurchaseOrderController@removeOrder');


Route::get('/updateGenerate/{id}','InvoicePOController@updateGenerate');



// Route::get('/getSelectGenerateInv/{generateInv}',function($generateInv){
// 	 	$isGenerateInv = Usage::where('isGenerateInv','=', $generateInv)->get();
// 	 	//dump($isGenerateInv);
// 	 	return response()->json($isGenerateInv);
        
// });
// Route::get('admin/getRequest',function(){
// 	if(request()->ajax()){
		
// 	}
// });
Route::get('/getTotalCus',function(){
	$tmp = App\TpmPurchaseOrder::all();
	$total= $tmp->where('user_id','=',Auth::user()->id)->sum('amount');
	return response()->json($total);
});

Route::get('/getTotalSD',function(){
	$tmp = App\TpmPurchaseOrder::all();
	$total= $tmp->where('user_id','=',Auth::user()->id)->sum('amount');
	return response()->json($total);
});
Route::get('/getPO/{id}',function($id){
	$po = Purchaseorder::with('customer')->where('customer_id','=',$id)->where('isPayment','=',0)->get();
	return response()->json($po);
});
Route::get('/getPopupEditPO/{id}','InvoicePOController@getPopupEditPO');
Route::get('/getPopupEditCradit/{id}','InvoicePOController@getPopupEditCradit');
Route::get('/getPopupEditInvoice/{id}','StockController@getPopupEditInvoice');