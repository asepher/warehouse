<?php
  
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VesselController;
use App\Http\Controllers\Wh\ManifestController;
use App\Http\Controllers\Wh\InvoiceController;
use App\Http\Controllers\Wh\WhInvoiceController;
use App\Http\Controllers\Wh\MemoController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\Si\SiController;
use App\Http\Controllers\Si\InvSiController;
use App\Http\Controllers\Si\CostSiController;
use App\Http\Controllers\KbController;
use App\Http\Controllers\KbEximpController;
use App\Http\Controllers\PdController;  
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\Wh\UploadController;
use App\Http\Controllers\Wh\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Wh\ExportController;
use App\Http\Controllers\Wh\ContainerController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Si\SoaController;
use App\Http\Controllers\LogController;
 
 
Route::get('/', function () {
    return view('welcome');
});

Route::get('my-notification/{type}', [DashboardController::class,'myNotification']);

//Verify Email
Auth::routes(['verify' => true]);

//DATATABLE
Route::get('/datatable', [DataTableController::class,'index'])->name('datatable.index');
Route::get('/chosen', [DataTableController::class,'chosen'])->name('chosen.index');

Route::get('/wh/vsl/create', [DashboardController::class,'DataPicker'])->name('datapicker');
Route::get('/wh/vsl/dttable', [DashboardController::class,'DataTable'])->name('dttable');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');


//modul sj
Route::get('/sj',[SjController::class,'index'])->name('sj.index');


//MODUL MASTER CUSTOMER
Route::group(['prefix' => 'ms','middleware' => ['auth']],function(){ 


    //CUSTOMER RULE
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');

    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create'); 
    Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');
    Route::put('/customer/{id}/update', [CustomerController::class, 'update'])->name('customer.update');

    Route::get('/customer/{id}/show', [CustomerController::class, 'show'])->name('customer.show');
    Route::get('/customer/{id}/destroy', [CustomerController::class, 'destroy'])->name('customer.destroy');

    Route::get('/list', [CustomerController::class, 'list'])->name('customer.list');
    Route::get('/list_datatable', [CustomerController::class, 'listDatatable'])->name('customer.listDatatable');


// Modul Charge 
    Route::get('/charge/', [ChargeController::class, 'index'])->name('charge.index');
    Route::post('/charge/store', [ChargeController::class, 'store'])->name('charge.store');
    Route::get('/charge/edit/{id}', [ChargeController::class, 'edit'])->name('charge.edit');
    Route::put('/charge/update', [ChargeController::class, 'update'])->name('charge.update');
    Route::post('/charge/delete/{id}', [ChargeController::class, 'destroy'])->name('charge.destroy');

    Route::get('/country', [CountryController::class, 'index'])->name('country.index');
    Route::post('/country/store', [CountryController::class, 'store'])->name('country.store');
    Route::get('/country/edit/{id}', [CountryController::class, 'edit'])->name('country.edit');
    Route::put('/country/update/{id}', [CountryController::class, 'update'])->name('country.update');
    Route::get('/country/delete/{id}', [CountryController::class, 'destroy'])->name('country.destroy');

    Route::get('/tarif', [TarifController::class, 'index'])->name('tarif.index');
    Route::post('/tarif/store',  [TarifController::class, 'store'])->name('tarif.store');
    Route::get('/tarif/edit/{id}',  [TarifController::class, 'edit'])->name('tarif.edit');
    Route::post('/tarif/update/',  [TarifController::class, 'update'])->name('tarif.update');
    Route::get('/delete/{id}',  [TarifController::class, 'delete'])->name('tarif.delete');

});


 
//MODUL WH
Route::group(['prefix' => 'wh','middleware' => ['auth']],function(){ 

   //VESSEL
   Route::get('/',[WhController::class,'index'])->name('wh.index');   
   Route::get('/vessel',[VesselController::class,'index'])->name('wh.vessel.index');    
   Route::get('/vessel/create',[VesselController::class,'create'])->name('wh.vessel.create');
   Route::post('/vessel/store',[VesselController::class,'store'])->name('wh.vessel.store');
   Route::get('/vessel/edit/{id}',[VesselController::class,'edit'])->name('wh.vessel.edit');
   Route::put('/vessel/update/{id}',[VesselController::class,'update'])->name('wh.vessel.update');   
   Route::post('/vessel/delete/{id}',[VesselController::class,'update'])->name('wh.vessel.delete');

   Route::get('/container',[ContainerController::class,'index'])
                ->name('wh.container.index');

   Route::get('/container/view_pdf',[ContainerController::class,'ViewPdf'])
                ->name('wh.container.view_pdf');

   Route::get('/container/report/{cont}',[ContainerController::class,'ReportByContainer'])
                ->name('wh.container.report');
 
 
   Route::get('/satuan',[ManifestController::class,'SatuanIndex'])->name('wh.satuan.index');    
   Route::post('/satuan',[ManifestController::class,'SatuanStore'])->name('wh.satuan.store');    
   Route::get('/satuan/{id}/edit',[ManifestController::class,'SatuanEdit'])->name('wh.satuan.edit');    
   Route::post('/satuan/{id}destroy',[ManifestController::class,'SatuanDestroy'])->name('wh.satuan.destroy');    
  
    
   //MANIFEST
   Route::get('/manifest/{vsl}',[ManifestController::class,'index'])->name('wh.manifest.index'); 
   Route::get('/manifest/{vsl}/create',[ManifestController::class,'create'])->name('wh.manifest.create');
   Route::get('/manifest/{vsl}/{seq}/edit',[ManifestController::class,'edit'])->name('wh.manifest.edit');
   Route::post('/manifest/{vsl}/create',[ManifestController::class,'store'])->name('wh.manifest.store');
   Route::put('/manifest/{vsl}/update',[ManifestController::class,'update'])->name('wh.manifest.update');
   Route::post('/manifest/{vsl}/destroy',[ManifestController::class,'destroy'])->name('wh.manifest.destroy');
   Route::get('/manifest/{vsl}/show',[ManifestController::class,'show'])->name('wh.manifest.show');

 
 
   //INVOICE CR
   Route::get('/invoice/{kdinv}',[WhInvoiceController::class,'InvoiceView'])->name('wh.invoice.view');  
   Route::post('/invoice/generate/{kdinv}',[WhInvoiceController::class,'InvoiceGen'])
         ->name('wh.invoice.generate');         
  //   Route::get('/invoice/view/{kdinv}',[WhInvoiceController::class,'InvoicePdfView'])
  //         ->name('wh.invoice.pdfview');         
   Route::post('/invoice/pdf/cr/{kdinv}',[WhInvoiceController::class,'DownloadCrPdf'])
         ->name('wh.invoice.crpdf');     
   Route::post('/invoice/{kdinv}/unposting',[WhInvoiceController::class,'unPosting'])
         ->name('wh.invoice.uposting');     
     

   Route::post('/invoice/{vsl}',[WhInvoiceController::class,'FormPaid'])   
         ->name('wh.invoice.formpaid');     

   Route::post('/invoice/{vsl}/paid',[WhInvoiceController::class,'paid'])
         ->name('wh.invoice.paid');     

   Route::post('/invoice/{vsl}/unpaid',[WhInvoiceController::class,'Unpaid'])
         ->name('wh.invoice.unpaid');     
    
  
   //INVOICE DN-NEW  OK
   Route::get('/invoice/{vsl}/generate-dn',[InvoiceController::class,'genInvoiceDn'])
    ->name('wh.generate.invoicedn'); 

  //Route::post('/invoce/{vsl}/generate-vessel/view',[InvoiceController::class,'generateVesselView'])
  //  ->name('wh.invoice.generate-vessel.view');   
  Route::post('/invoice/{vls}/genpdf-dn',[InvoiceController::class,'genPdfInvDn'])
    ->name('wh.generate-pdf.invoicedn');
    
  // dengan input tanggal 
  Route::post('/invoice/{vls}/form-tgldn',[InvoiceController::class,'genFormTglDn'])
    ->name('wh.generate-pdf.form-tgldn');
  Route::post('/invoice/{vls}/genpdf-tgldn',[InvoiceController::class,'genPdfInvTglDn'])
    ->name('wh.generate-pdf.inv-tgldn');
  



   //INVOICE CN
   Route::get('/invoice/{vsl}/generate-cn',[InvoiceController::class,'genInvoiceCn'])
    ->name('wh.generate.invoicecn');
  Route::post('/invoce/{vsl}/genpdf-cn/view',[InvoiceController::class,'genCnPdfView'])
    ->name('wh.invoice.genpdf-cn.view');
  Route::post('/invoce/{vsl}/gen-cn/pdf',[InvoiceController::class,'genCnPdfPrint'])
    ->name('wh.invoice.genpdf-cn.print');


   //Route::post('/invoce/{vsl}/generate-vessel',[InvoiceController::class,'generateVesselPdf'])
   // ->name('wh.invoice.generate-vessel-pdf');
 
  
    //query
  //Route::get('/invoice',[ReportController::class,'WhInvoice'])
  //       ->name('wh.invoice');    
     
  // QUERY DATA
   Route::get('/invoice/query/byvessel',[ReportController::class,'InvoiceByVessel'])
    ->name('wh.invoice.byvessel');
   Route::post('/invoice/query/byvessel',[ReportController::class,'QueryByVessel'])
    ->name('wh.invoice.querybyvessel');

   Route::get('/invoice/query/bydate',[ReportController::class,'InvoiceByDate'])
    ->name('wh.invoice.bydate');    
   Route::post('/invoice/query/qbydate',[ReportController::class,'QueryByDate'])
    ->name('wh.invoice.querybydate');

  Route::post('/vessel/manifest_bydate/',[ExportController::class,'IwhDetailByDate'])
            ->name('vessel.manifest_bydate');

   Route::get('/invoice/query/bycustomer',[ReportController::class,'InvoiceByCustomer'])
    ->name('wh.invoice.bycustomer');

   Route::post('/invoice/query/bycustomer',[ReportController::class,'QueryByCustomer'])
    ->name('wh.invoice.querybycustomer');
 
   Route::get('/invoice/query/bynom',[ReportController::class,'InvoiceByNom'])
    ->name('wh.invoice.bynom');
     
   Route::post('/invoice/query/bynom',[ReportController::class,'QueryByNom'])
    ->name('wh.invoice.querybynom');
 
   Route::get('/manifest/query/hbl',[ManifestController::class,'searchHbl'])
    ->name('wh.manifest.byhbl');

   Route::post('/manifest/querybyhbl',[ManifestController::class,'QueryByHbl'])
    ->name('wh.manifest.qbyhbl');
 
   Route::get('/manifest/query/bycontainer',[ContainerController::class,'InvByContainer'])
    ->name('wh.manifest.bycontainer');
   Route::post('/manifest/query/bycontainer',[ContainerController::class,'QueryByContainer'])
    ->name('wh.invoice.qbycontainer');
   Route::post('/manifest/query/bycontainer/pdf',[ContainerController::class,'PdfByContainer'])
    ->name('wh.invoice.qbycontpdf');

   Route::post('/manifest/query/qbysoapdf',[ContainerController::class,'PdfBySoa'])
    ->name('wh.manifest.qbysoapdf');
   Route::post('/report/soa/excel',[ExportController::class,'ReportSoaExcel'])
            ->name('manifest.soa.excel');    

 


   Route::post('/manifest/query/bysinglecont',[ContainerController::class,'QueryBySingleCont'])
    ->name('wh.invoice.qbysinglecont');
   Route::post('/manifest/query/singlecontpdf',[ContainerController::class,'PdfBySingleCont'])
    ->name('wh.invoice.singlecontpdf');
 
 
   Route::get('/invoice/query/bymonth',[ManifestController::class,'InvByMonth'])
    ->name('wh.invoice.bymonth');

   Route::post('/invoice/query/bymonth',[ManifestController::class,'QueryByMonth'])
    ->name('wh.invoice.qbymonth');
  
  Route::post('/report/montly/vsl_excel',[ExportController::class,'ReportMontlyVsl'])
    ->name('manifest.montly.vsl_excel');      

  Route::post('/report/montly/cont_excel',[ExportController::class,'ReportMontlyCont'])
    ->name('manifest.montly.cont_excel'); 

   //MEMO CNF  
    Route::get('/memo/{vsl}/view',[MemoController::class,'MemoView'])->name('wh.memo.view');
    Route::post('/memo/{vsl}/generate-memo',[MemoController::class,'MemoGen'])->name('wh.memo.generate-memo');    
    Route::post('/memo/{vsl}/unposting',[MemoController::class,'MemoUnPosting'])
         ->name('wh.memo.uposting');     

  //MEMO FOB 
  Route::get('/memo/{vsl}/viewfob',[MemoController::class,'MemoViewFob'])->name('wh.memo.viewfob');
  Route::post('/memo/{vsl}/generate-memofob',[MemoController::class,'MemoFobGen'])->name('wh.memo.generate-memofob');    

   //INVOICE DN 
   Route::post('/container/{cont}/view',[InvoiceController::class,'genContainer'])
    ->name('wh.generate-container.view');
   Route::post('/container/{cont}/invoice',[InvoiceController::class,'genInvoiceByCont'])
    ->name('wh.generate-invoice.bycont');


    //UPLOAD TEMPLATE
   Route::get('/upload/{vsl}',[UploadController::class,'uploadVessel'])->name('wh.upload.vessel');           
   Route::post('/upload/manifest/store/{vsl}',[UploadController::class,'manifestStore'])
            ->name('wh.upload.store');    
   Route::get('/upload/results/{vsl}',[UploadController::class,'uploadResults'])
            ->name('wh.upload.results');
   Route::get('/upload/{vsl}/{seq}/edit',[UploadController::class,'uploadEdit'])
            ->name('wh.upload.edit');
   Route::post('/upload/add-one/{id}',[UploadController::class,'addOneManifest'])
            ->name('wh.upload.addOne');
   //
   Route::post('/upload/add-all/',[UploadController::class,'addAllManifest'])
            ->name('wh.upload.addAll');
   Route::delete('/upload/delete/{id}',[UploadController::class,'uploadDelete'])
            ->name('wh.upload.delete');
   Route::get('/upload/manifest/{vsl}',[UploadController::class,'manifest'])
            ->name('wh.upload.manifest');
   Route::post('/upload/add_manifest',[UploadController::class,'AddManifest'])
            ->name('wh.upload.add_manifest');
  
 

  Route::get('/uploadview/',[UploadController::class,'ViewUploadVessel'])
            ->name('wh.upload.viewUploadvessel');
  Route::post('/uploadview/',[UploadController::class,'ViewDataResult'])
            ->name('wh.upload.viewdata');

  Route::get('/import',[UploadController::class,'import'])->name('wh.upload.import');
 

  
  // Invoice Manual
  Route::get('/vessel/{vsl}/container',[VesselController::class,'InfoContainer'])->name('wh.container');

  Route::get('/vsl/{vsl}/{cnt}/create',[VesselController::class,'CreateInvMan'])
          ->name('wh.container.baru');
  Route::post('/vessel/{vsl}/{cnt}/store/',[VesselController::class,'VesselDataInv'])
            ->name('vessel.storeinv');
  Route::get('/cnt/{cnt}/{id}/edit/',[VesselController::class,'VslCntEdit'])
            ->name('vessel.container_edit');
  Route::get('/cnt/{cnt}/{id}/delete/',[VesselController::class,'VslCntDelete'])
            ->name('vessel.container_delete');
  Route::post('/{vsl}/{cnt}/pdf/',[VesselController::class,'VesselInvPdf'])
            ->name('vessel.invcntpdf');
 
 
  //Manual By Container
  Route::get('/vsl/{cnt}/createnew',[VesselController::class,'CreateInvoceManualNew'])
          ->name('wh.container.invoicenew');
          
  Route::post('/vsl/{cnt}/storenew',[VesselController::class,'StoreInvoceManualNew'])
          ->name('wh.container.storenew');
          
  Route::post('/{cnt}/pdf/',[VesselController::class,'ContainerInvPdf'])
            ->name('vessel.invcntnewpdf');

  Route::get('/{cnt}/pdf/{inv}',[VesselController::class,'ContainerInvPdfPosting'])
            ->name('vessel.invman.posting');
 
  //MORE        
  Route::get('/vsl/{cnt}/createmore/{inv}',[VesselController::class,'CreateInvoceManualMore'])
          ->name('wh.container.createmore');
  Route::post('/vsl/{cnt}/storemore/{inv}',[VesselController::class,'StoreInvoceManualMore'])
          ->name('wh.container.storemore');
  Route::get('/cnt/{inv}/{id}/contmore_edit/',[VesselController::class,'EditContainerMore'])
            ->name('vessel.contmore_edit');
  Route::post('/cnt/{inv}/{id}/contmore_update/',[VesselController::class,'UpdateContainerMore'])
            ->name('wh.container.updatemore');
  Route::get('/cnt/{inv}/{id}/contmore_dele/',[VesselController::class,'DeleContainerMore'])
            ->name('vessel.contmore_dele');

  Route::post('/{cnt}/pdfmore/{inv}',[VesselController::class,'ContainerInvPdfMore'])
            ->name('vessel.invcntmore_pdf');



 // Invoi manual menu
   Route::get('/invoice/manual/create',[ReportController::class,'ManCreate'])
    ->name('wh.manual.create');     
   Route::get('/invoice/manual/{cnt}/new',[ReportController::class,'ManCreateNew'])
    ->name('wh.manual.createnew');    
    
   Route::post('/invoice/manual/store',[ReportController::class,'ManualStore'])
    ->name('wh.manual.store');    
   Route::get('/invoice/manual/detail/{id}',[ReportController::class,'ManEditDetail'])
    ->name('wh.manual.edit_detail');    
   Route::get('/invoice/manual/delete/{id}',[ReportController::class,'ManDeleteDetail'])
    ->name('wh.manual.delete_detail');    
           

  //EXPORT EXCEL
  Route::get('/vessel/view_data',[VesselController::class,'VslViewData'])
            ->name('vessel.view_data');  
  Route::get('/vessel/export_excel',[VesselController::class,'VslExportExcel'])
            ->name('vessel.export_excel');

  Route::get('/vessel/manifest_excel/{vsl}',[ExportController::class,'ManifestExcel'])
            ->name('vessel.manifest_excel');
  
  // REPORT 
  Route::get('/report/daily',[ReportController::class,'ReportDaily'])
            ->name('report.daily'); 
  Route::post('/report/daily/view',[ReportController::class,'ReportDailyView'])
            ->name('report.daily.view');  
  Route::post('/report/daily/excel',[ExportController::class,'ReportDailyExcel'])
            ->name('manifest.daily.excel');      

  Route::post('/report/montly/excel',[ExportController::class,'ReportMontlyExcel'])
            ->name('manifest.montly.excel');      

  // STRIPPING
  Route::get('/stripping/{vsl}',[ReportController::class,'StrippingVsl'])
            ->name('wh.stripping.vessel'); 
  Route::post('/stripping/cancel',[ReportController::class,'StrippingStore'])
            ->name('wh.stripping.cancel'); 

  Route::post('/stripping',[ReportController::class,'StrippingStore'])
            ->name('wh.stripping.store'); 
  Route::get('/stripping/view/{vsl}',[ReportController::class,'StrippingView'])
            ->name('wh.stripping.view'); 

  Route::get('/stripping/edit/{vsl}/{id}',[ReportController::class,'StrippingEdit'])
            ->name('wh.stripping.edit'); 

  Route::post('/stripping/update/{vsl}',[ReportController::class,'StrippingUpdate'])
            ->name('wh.stripping.update'); 
            
  Route::post('/stripping/delete/{id}',[ReportController::class,'StrippingDelete'])
            ->name('wh.stripping.delete'); 

  Route::get('/datalog',[LogController::class,'DataLog'])
            ->name('wh.invoice.log'); 
  Route::post('/datalog/search',[LogController::class,'LogSearch'])
            ->name('wh.log.search'); 





     
  Route::get('error',function(){
        return view('wh.error');        
    });

});


//MODUL SI 
Route::group(['prefix' => 'si','middleware' => ['auth']],function(){ 
  
   Route::get('/', [SiController::class,'index'])->name('si.index');
 
   Route::get('/create/job',[SiController::class,'createJob'])->name('si.create.job');
   Route::post('/create/job',[SiController::class,'getJob'])->name('si.job.get');

   //Route::get('/create/job/{job}',[SiController::class,'JobNew'])->name('si.job.new');

   Route::post('/create',[SiController::class,'createSi'])->name('si.create');
   Route::post('/store',[SiController::class,'storeSi'])->name('si.store');
   
   Route::get('/edit/{id}',[SiController::class,'editSi'])->name('si.edit');
   Route::get('/show/{id}',[SiController::class,'showSi'])->name('si.show');
   Route::post('/update/{id}',[SiController::class,'updateSi'])->name('si.update');
   Route::get('/destroy/{id}',[SiController::class,'destroySi'])->name('si.destroy');
 
  
   Route::get('/view/{si}',[SiController::class,'SiViewDetail'])->name('si.view.detail');
   Route::get('/aju/{si}',[SiController::class,'InputAju'])->name('si.aju.input');
   Route::post('/aju/{si}/store',[SiController::class,'StoreAju'])->name('si.aju.store');

   
   Route::get('/inv/all',[InvSiController::class,'InvSiAll'])->name('si.inv.all');
   Route::post('/inv/search',[InvSiController::class,'InvSiSeach'])->name('si.inv.search');
 
   Route::get('/inv/{jenis}/{id}',[InvSiController::class,'createInv'])->name('si.inv.create');
   Route::post('/inv/store/{id}/{jenis}',[InvSiController::class,'storeInv'])->name('si.inv.store');
   Route::get('/inv/edit/{si}/{id}',[InvSiController::class,'editInv'])->name('si.inv.edit');
   Route::post('/inv/update/{si}/{id}',[InvSiController::class,'updateInv'])->name('si.inv.update');
   Route::delete('/inv/delete/{id}',[InvSiController::class,'deleDetail'])->name('si.detail.delete');
  
   Route::post('/inv/preview',[InvSiController::class,'preview'])->name('si.inv.preview');
   Route::post('/inv/viewpdf',[InvSiController::class,'viewpdf'])->name('si.inv.viewpdf');
   Route::post('/inv/printpdf',[InvSiController::class,'printpdf'])->name('si.inv.printpdf');
 
   Route::get('/inv/{kd_si}/test/pdf',[InvSiController::class,'testpdf'])->name('si.inv.testpdf');

   //Route::post('/inv/exportpdf',[InvSiController::class,'exportpdf'])->name('si.inv.exportpdf');
  
   Route::get('/cost/{si}',[CostSiController::class,'Create'])->name('si.cost.create');
   Route::post('/cost/store/{si}',[CostSiController::class,'CostStore'])->name('si.cost.store');
   Route::get('/cost/edit/{id}',[CostSiController::class,'CostEdit'])->name('si.cost.edit');
   Route::post('/cost/destroy/{id}',[CostSiController::class,'CostDestroy'])->name('si.cost.destroy');
   Route::post('/cost/update/{si}',[CostSiController::class,'CostUpdate'])->name('si.cost.update');
   

    Route::get('/cost/exportpdf',[CostSiController::class,'ExportPdf'])->name('si.cost.exportpdf');
    Route::get('/cost/posting',[CostSiController::class,'CostPosting'])->name('si.cost.posting');

    Route::get('/soa',[SoaController::class,'soaIndex'])->name('si.data.index');;


    //Route::resource('customer', CustomerController::class);
    Route::get('/{tipe}/{inv}/posting',[InvSiController::class,'posting'])->name('si.inv.posting');


});




//MODULE PD

  Route::group(['prefix' => 'pd','middleware' => ['auth']], function(){

     //Module PD
     Route::get('/', [PdController::class,'index'])->name('pd.index');
     Route::get('/create', [PdController::class,'create'])->name('pd.create');
     Route::post('/store', [PdController::class,'store'])->name('pd.store');
     Route::get('/edit/{id}', [PdController::class,'edit'])->name('pd.edit');
     Route::put('/update/{id}', [PdController::class,'update'])->name('pd.update');
     Route::post('/delete/{id}', [PdController::class,'delete'])->name('pd.delete');

     Route::get('/detail/{id}', [PdController::class,'detail'])->name('pd.detail');
     Route::post('/storedetail/', [PdController::class,'StoreDetail'])->name('pd.storedetail');
     Route::get('/detail/edit/{pd}/{id}', [PdController::class,'Editdetail'])
      ->name('pd.editdetail');
     Route::put('/detail/update/', [PdController::class,'Updatedetail'])->name('pd.updatedetail');
     Route::post('/detail/{id}/delete/', [PdController::class,'Deletedetail'])->name('pd.deletedetail');
     Route::post('/printpdf', [PdController::class,'PrintPdf'])->name('pd.printpdf');
     Route::post('/posting', [PdController::class,'Posting'])->name('pd.posting');
     Route::get('/export-excel', [PdController::class,'exportToExcel'])->name('pd.exportexcel');

     Route::get('/pdpdf/{id}', [PdController::class,'Pdpdf'])->name('pd.pdpdf');

     //Route::post('/savePdfpdf/{id}', [PdController::class,'SavePdf'])->name('pd.printpdf');

     Route::get('/query', [PdController::class,'PdQuery'])->name('pd.query');
     Route::get('/query/{pd}/view_detail', [PdController::class,'QueryDetail'])
     ->name('pd.query.detail');

});


//MODUL DL
//Route::group(['prefix' => 'dl','middleware' => ['auth']],function(){ 
 
//Module KB
Route::group(['prefix' => 'kb','middleware' => ['auth']], function(){

         Route::get('/', [KbController::class,'index'])->name('kb.index');
         Route::get('/create', [KbController::class,'create'])->name('kb.create');
         Route::post('/store', [KbController::class,'store'])->name('kb.store');
         Route::get('/edit/{id}', [KbController::class,'edit'])->name('kb.edit');
         Route::put('/update/{id}', [KbController::class,'update'])->name('kb.update');
         Route::get('/delete/{id}', [KbController::class,'destroy'])->name('kb.delete');
         Route::post('/posting', [KbController::class,'posting'])->name('kb.posting');
         Route::post('/unposting', [KbController::class,'Unposting'])->name('kb.unposting');
         Route::get('/export-excel', [KbController::class,'exportToExcel'])->name('kb.exportexcel');   

         Route::get('/eximp', [KbEximpController::class,'index'])->name('kb.eximp.index');
         Route::get('/eximp/create', [KbEximpController::class,'create'])->name('kb.eximp.create');
         Route::post('/eximp/store', [KbEximpController::class,'store'])->name('kb.eximp.store');   
         Route::get('/eximp/edit/{id}', [KbEximpController::class,'edit'])->name('kb.eximp.edit');
         Route::put('/eximp/update/{id}', [KbEximpController::class,'update'])->name('kb.eximp.update');
         
         Route::post('/eximp/posting', [KbEximpController::class,'posting'])->name('kb.eximp.posting');
         Route::post('/eximp/delete/{id}', [KbEximpController::class,'delete'])->name('kb.eximp.delete');

         Route::get('/harian/view', [KbController::class,'HarianView'])->name('kb.harian.view');


      });



    //});
    /// User Profile and Change Password       

    Route::prefix('profile')->group(function(){

    Route::get('/view', [ProfileController::class, 'ProfileView'])->name('profile.view');
    Route::get('/edit', [ProfileController::class, 'ProfileEdit'])->name('profile.edit');
    Route::post('/store', [ProfileController::class, 'ProfileStore'])->name('profile.store');
    Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');
    Route::post('/password/update', [ProfileController::class, 'PasswordUpdate'])->name('password.update');

}); 

  

 // User Management All Routes 

Route::prefix('users')->group(function(){
    Route::get('/view', [UserController::class, 'UserView'])->name('user.view');
    Route::get('/add', [UserController::class, 'UserAdd'])->name('users.add');
    Route::post('/store', [UserController::class, 'UserStore'])->name('users.store');
    Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('users.edit');
    Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('users.update');
    Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('users.delete');

}); 


Route::get('email', [EmailController::class, 'kirim'])->name('form.email');
Route::post('email/send', [EmailController::class, 'send'])->name('send.email');
 



//MODULE AJAX 
Route::get('test/jquery', [TestController::class, 'jquery'])->name('jquery.index');
Route::get('test/jquery2', [TestController::class, 'jquery2'])->name('jquery.index2');
Route::get('ajax/crud', [TestController::class, 'AjaxCrud'])->name('ajax.index');
Route::post( 'ajax/addItem',[TestController::class, 'addItem'])->name('ajax.additem');

//MODULE JQUERY
Route::get('jquery',[TestController::class, 'jqueryIndex'])->name('jquery.index');
Route::get('jquery/dropdown',[TestController::class, 'jqueryDropdown'])->name('jquery.dropdown');




