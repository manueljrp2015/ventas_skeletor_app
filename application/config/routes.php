<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller']                = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override']                      = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes']              = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']                    = 'Welcome';
$route['404_override']                          = '';
$route['translate_uri_dashes']                  = FALSE;

$route['login']                                 = '/app/login/appLoginController/indexLogin';
$route['login/signUpLogin']                     = '/app/login/appLoginController/signUp';
$route['login/forgotPass']                      = '/app/login/appLoginController/forgotPass';

$route['register-new']                          = '/app/register/appRegisterController/indexRegister';
$route['register/register-user-exec']           = '/app/register/appRegisterController/store';

$route['validate-user']                         = '/app/validation/appValidationController/validateUser';
$route['validate-mail']                         = '/app/validation/appValidationController/validateEmail';
$route['validate-mail-recovery']                = '/app/validation/appValidationController/validateEmailRecovery';

$route['dashboard/welcome']                     = '/app/dashboard/appDashboardController/indexDashboard';
$route['dashboard/get-analisis-store']          = '/app/dashboard/appDashboardController/getAnalisisStore';

$route['shutdown/session']                      = '/app/dashboard/appDashboardController/destroySession';

$route['user/myaccount']                        = '/app/user/appUserController/indexMyAccount';
$route['user/myaccount/store-data']             = '/app/user/appUserController/storeData';
$route['user/validate-user']                    = '/app/validation/appValidationController/validateUser';
$route['user/validate-mail']                    = '/app/validation/appValidationController/validateEmail';
$route['user/validate-mail-recovery']           = '/app/validation/appValidationController/validateEmailRecovery';
$route['user/change-user']                      = '/app/user/appUserController/changeUser';
$route['user/generate-key']                     = '/app/user/appUserController/generateKey';
$route['user/change-key']                       = '/app/user/appUserController/changeKey';
$route['user/change-mail']                      = '/app/user/appUserController/changeMail';
$route['user/change-mail-recovery']             = '/app/user/appUserController/changeMailRecovery';
$route['user/upload-avatar']                    = '/app/files/appFileProcessController/setFileAvatar';

$route['empresa/registrar']                     = '/app/business/appBusinessController/indexBusinnes';
$route['empresa/registrar-exec']                = '/app/business/appBusinessController/storeBusiness';
$route['empresa/validate-idb']                  = '/app/validation/appValidationController/validateIdb';

$route['empresa-admin/gestionar']               = '/app/business/appBusinessAdminController/indexBusinnesAdm';
$route['empresa-admin/registrar-exec']          = '/app/business/appBusinessController/storeBusinessAdmin';
$route['empresa-admin/validate-idb']            = '/app/validation/appValidationController/validateIdb';
$route['empresa-admin/information-business']    = '/app/business/appBusinessAdminController/informationBusiness';
$route['empresa-admin/activate-business']       = '/app/business/appBusinessAdminController/getActivateBusiness';
$route['empresa-admin/configuration-business']  = '/app/business/appBusinessAdminController/getConfigBusiness';

$route['empresa-admin/register-cfg']            = '/app/business/appBusinessAdminController/storeBusinessCfg';
$route['empresa-admin/update-business-exec']    = '/app/business/appBusinessAdminController/updateBusinessExec';
$route['empresa-admin/block-business']          = '/app/business/appBusinessAdminController/blockBusiness';

$route['user-admin/user-managment']             = '/app/user/appUserAdminController/indexUserAdmin';
$route['user-admin/change-keya']                = '/app/user/appUserAdminController/changeKeyAdmin';
$route['user-admin/information-user-a']         = '/app/user/appUserAdminController/getInfoUserAdmin';
$route['user-admin/validate-user']              = '/app/validation/appValidationController/validateUser';
$route['user-admin/validate-mail']              = '/app/validation/appValidationController/validateEmail';
$route['user-admin/validate-mail-recovery']     = '/app/validation/appValidationController/validateEmailRecovery';
$route['user-admin/user-managment']             = '/app/user/appUserAdminController/indexUserAdmin';
$route['user-admin/store-data']                 = '/app/user/appUserAdminController/storeData';
$route['user-admin/block-u']                    = '/app/user/appUserAdminController/blockUser';
$route['user-admin/register-user-exec']         = '/app/user/appUserAdminController/store';
$route['user-admin/get-store-from-user']        = '/app/user/appUserAdminController/getStoreForUser';
$route['user-admin/asigned-store-for-user']     = '/app/user/appUserAdminController/asignedStoreForUser';


$route['inventory/warehouse']                   = '/app/inventory/appInventoryController/indexWarehouse';
$route['inventory/store-warehouse']             = '/app/inventory/appInventoryController/storeWarehouse';
$route['inventory/get-warehouse-id']            = '/app/inventory/appInventoryController/getWarehouseId';
$route['inventory/update-warehouse']            = '/app/inventory/appInventoryController/editWarehouse';

$route['inventory/materials']                   = '/app/inventory/appInventoryController/indexMaterials';
$route['inventory/transfers']                   = '/app/inventory/appInventoryController/indexTransfers';
$route['inventory/inventary']                   = '/app/inventory/appInventoryController/indexInventary';
$route['inventory/analysis']                    = '/app/inventory/appInventoryController/indexAnalysis';

$route['finance/Payments']                      = '/app/finance/appFinanceAdminController/indexPayments';
$route['finance/Sales']                         = '/app/finance/appFinanceAdminController/indexSales';
$route['finance/Orders']                        = '/app/finance/appFinanceAdminController/indexOrders';
$route['finance/Analysis']                      = '/app/finance/appFinanceAdminController/indexAnalysis';

$route['process/orders']                        = '/app/orders/appOrdersController';
$route['process/find-store']                    = '/app/orders/appOrdersController/findStore';
$route['process/free-orders']                   = '/app/orders/appOrdersController/freeOrder';
$route['process/store']                         = '/app/orders/appOrdersController/storeTempIndex';
$route['process/create-store-temp']             = '/app/orders/appOrdersController/putStore';
$route['process/verify-user']                   = '/app/orders/appOrdersController/verifyUserKey';
$route['process/validate-user']                 = '/app/orders/appOrdersController/verifyUser';
$route['process/validate-email']                = '/app/orders/appOrdersController/verifyEmail';
$route['process/create-user-temp']              = '/app/orders/appOrdersController/putUserStore';
$route['process/generate-key']                  = '/app/user/appUserController/generateKey';
$route['process/find-produt-store']             = '/app/orders/appOrdersController/getAnalisisListProduct';
$route['process/process-charge-list']           = '/app/orders/appOrdersController/processChargeList';
$route['process/upload-files-excel']            = '/app/orders/appOrdersController/uploadFileExcelList';
$route['process/verify-rut']                    = '/app/orders/appOrdersController/verifyRut';
$route['process/relationships-user']            = '/app/orders/appOrdersController/relationshipsUserIndex';
$route['process/process-change-user']           = '/app/orders/appOrdersController/processChangeUser';
$route['process/get-catalog-country']           = '/app/orders/appOrdersController/getCatalogsCountry';
$route['process/change-states-lotes']           = '/app/orders/appOrdersController/changeStateLote';
$route['process/change-states']                 = '/app/orders/appOrdersController/stateOrdersIndex';
$route['process/change-states-time']            = '/app/orders/appOrdersController/indexChangeTime';
$route['process/change-states-time-exec']       = '/app/orders/appOrdersController/changeStateTime';
$route['process/inprice']                       = '/app/orders/appOrdersController/inPriceStore';
$route['process/delete-prod']                   = '/app/orders/appOrdersController/deleteProd';
$route['process/upprice']                       = '/app/orders/appOrdersController/upPriceStore';
$route['process/view-prices']                   = '/app/prices/appPricesController/indexPrices';

$route['(:any)/get-country-tnt']                = '/app/orders/appOrdersController/getCountryTnt';
$route['(:any)/get-pueblo-tnt']                 = '/app/orders/appOrdersController/getPuebloTnt';
$route['(:any)/get-cost-tnt']                   = '/app/orders/appOrdersController/getCostTnt';
$route['(:any)/get-giro-relationship']          = '/app/orders/appOrdersController/getGiroRelationship';

$route['prices/view-list-prices']               = '/app/prices/appPricesController/indexListProductos';
$route['prices/get-product-active-for-store']   = '/app/prices/appPricesController/getListProductForStoreActive';
$route['prices/get-product-inactive-for-store'] = '/app/prices/appPricesController/getListProductForStoreInactive';
$route['prices/find-produt-store']              = '/app/orders/appOrdersController/getAnalisisListProduct';
$route['information/information-store']         = '/app/information/appTempInfoController';
$route['information/get-information-add']       = '/app/information/appTempInfoController/getInfoAdd';
$route['orderuser/orders-management']           = '/app/orderuser/appOrderuserController';
$route['orderuser/orders-getdet-orders']        = '/app/orderuser/appOrderuserController/getDetOrdersUser';
$route['orderuser/orders-getfact-orders']       = '/app/orderuser/appOrderuserController/getListFactureForOrders';
$route['orderuser/orders-change-state']         = '/app/orderuser/appOrderuserController/changeState';

$route['orderuser/orders-gif-promo']            = '/app/orderuser/appOrderuserController/gifPromo';

$route['process/adjust-courier']                = '/app/orders/appOrdersController/indexChangeAjust';
$route['process/get-cost-order']                = '/app/orders/appOrdersController/getCostOrder';
$route['process/save-cost-order']               = '/app/orders/appOrdersController/saveCostOrder';

$route['process/analysis']                      = '/app/analysis/AppAnalysisController/indexTemp';
$route['process/get-analisis-store']            = '/app/analysis/AppAnalysisController/getAnalisisStore';

$route['odbc-test']                             = '/app/odbc/appOdbcController/testConn';
$route['odbc/view-odbc']                        = '/app/odbc/appOdbcController/viewOdbc';
$route['odbc/process-query']                    = '/app/odbc/appOdbcController/queryOdbc';

$route['store/welcome']                         = '/app/store/appStoreController/indexStore';
$route['store/findProduct']                     = '/app/store/appStoreController/findProductStore';
$route['store/get-list-product-store']          = '/app/store/appStoreController/findProductStoreAllLimit';
$route['store/put-product-orders']              = '/app/store/appStoreController/putProductOrder';
$route['store/find-product-for-name']           = '/app/store/appStoreController/findProductForName';
$route['(:any)/find-order-pending-store']       = '/app/store/appStoreController/findOrderPending';

$route['mi-carrito']                            = '/app/cart/appCartController/indexCart';
$route['mi-carrito/get-list-cart']              = '/app/cart/appCartController/getListCart';
$route['mi-carrito/update-cart']                = '/app/cart/appCartController/updateCart';
$route['mi-carrito/delete-item']                = '/app/cart/appCartController/deleteItemsCart';

$route['(:any)/process-order']                  = '/app/transactions/appTransactionsController/consolidateOrder';
$route['(:any)/order-courier']                  = '/app/cart/appCartController/orderCourier';

$route['(:any)/calculate-tnt']                  = '/app/tnt/appTntController/calculateTnt';
$route['(:any)/save-courier-order']             = '/app/transactions/appTransactionsController/saveCourierOrder';
$route['(:any)/according-order']                = '/app/transactions/appTransactionsController/accordingOrder';

$route['mis-compras/purchases']                 = '/app/purchases/appPurchasesController/indexPurchases';
$route['mis-compras/my-purchases']              = '/app/purchases/appPurchasesController/getPurchasesForStore';
$route['mis-compras/get-courier-order']         = '/app/purchases/appPurchasesController/getCourierOrder';
$route['mis-compras/get-item-order']            = '/app/purchases/appPurchasesController/getItemOrder';
$route['mis-compras/get-timeline-order']        = '/app/purchases/appPurchasesController/getTimeLine';
$route['mis-compras/get-comment-order']         = '/app/purchases/appPurchasesController/getComment';
$route['mis-compras/put-comment-order']         = '/app/purchases/appPurchasesController/PutComment';

$route['settings/index']                        = '/app/settings/appSettingsController';
$route['settings/get-params-store']             = '/app/settings/appSettingsController/getSettingsParamStore';
$route['settings/get-list-params-store']        = '/app/settings/appSettingsController/getPaymentConditions';
$route['settings/put-payment']                  = '/app/settings/appSettingsController/putPayment';
$route['settings/update-payment']               = '/app/settings/appSettingsController/updatePayment';
$route['settings/get-list-reload']              = '/app/settings/appSettingsController/getReloadCredict';
$route['settings/get-reload-id']                = '/app/settings/appSettingsController/getReloadCredictId';
$route['settings/put-reload']                   = '/app/settings/appSettingsController/putReload';

$route['client/index-client-create']            = '/app/client/AppClientController/indexStoreCreate';
$route['client/get-store-id']                   = '/app/client/AppClientController/getStoreId';
$route['client/store-update']                   = '/app/client/AppClientController/updateStore';
$route['client/get-catalog-country']            = '/app/client/AppClientController/getCatalogsCountry';
$route['client/verify-rut']                     = '/app/client/AppClientController/verifyRut';
$route['client/get-giro-relationship']          = '/app/orders/appOrdersController/getGiroRelationship';
$route['client/put-client']                     = '/app/client/AppClientController/putStore';
$route['(:any)/get-client-update']              = '/app/client/AppClientController/getClientUpdate';
$route['client/update-client']                  = '/app/client/AppClientController/updateStoreComplete';

$route['products/index']                        = '/app/product/AppProductController';
$route['products/put-product']                  = '/app/product/AppProductController/putProduct';
$route['products/update-product']               = '/app/product/AppProductController/updateProduct';
$route['products/get-product-from-id']          = '/app/product/AppProductController/getProductFromId';

$route['prices/prices-managment']               = '/app/prices/appPricesNewController';
$route['prices/update-price']                   = '/app/prices/appPricesNewController/updatePrices';
$route['prices/upload-files-excel']             = '/app/prices/appPricesNewController/uploadFileExcelList';
$route['prices/get-prices-for-client']          = '/app/prices/appPricesNewController/getPricesForClient';
$route['prices/update-price-client']            = '/app/prices/appPricesNewController/updatePriceClient';
$route['prices/transfer-prices']                = '/app/prices/appPricesNewController/transferPrices';
$route['prices/transfer-prices-multiple']       = '/app/prices/appPricesNewController/transferPricesMultiple';
$route['prices/get-list-price']                 = '/app/prices/appPricesNewController/getListPrice';

$route['(:any)/invoice']                        = '/app/pdf/appPdfController/invoice';
$route['(:any)/comprobante']                    = '/app/pdf/appPdfController/comprobanteRegistro';
$route['(:any)/clientes']                       = '/app/pdf/appPdfController/listaCLientes';
$route['(:any)/productos']                      = '/app/pdf/appPdfController/listaProduct';
$route['(:any)/precios-cliente']                = '/app/pdf/appPdfController/listaPriceClient';
$route['(:any)/precios-lista']                  = '/app/pdf/appPdfController/listaPrice';
$route['(:any)/reporte-credito']                = '/app/pdf/appPdfController/listaReporteCredito';
$route['(:any)/reporte-recargas-balance']       = '/app/pdf/appPdfController/listaReporteRecargasBalance';
$route['(:any)/checklist-picking']              = '/app/pdf/appPdfController/checklistPickig';
$route['(:any)/checklist-verify']               = '/app/pdf/appPdfController/checklistVerify';
$route['(:any)/pagos-print']                          = '/app/pdf/appPdfController/reportePagos';

$route['cellar/cellar-order-management']        = '/app/cellar/appCellarController';
$route['cellar/cellar-picking']                 = '/app/cellar/appCellarController/indexCellarPicking';
$route['cellar/cellar-verify']                  = '/app/cellar/appCellarController/indexCellarVerify';
$route['cellar/cellar-tranport']                = '/app/cellar/appCellarController/indexCellarTransport';
$route['cellar/cellar-deleteitem-order']        = '/app/cellar/appCellarController/deleteItemOrder';
$route['cellar/purchases']                      = '/app/cellar/appCellarController/getPurchasesForStore';
$route['cellar/get-courier-order']              = '/app/cellar/appCellarController/getCourierOrder';
$route['cellar/get-item-order']                 = '/app/cellar/appCellarController/getItemOrder';
$route['cellar/get-timeline-order']             = '/app/cellar/appCellarController/getTimeLine';
$route['cellar/get-comment-order']              = '/app/cellar/appCellarController/getComment';
$route['cellar/update-order']                   = '/app/cellar/appCellarController/updateOrder';
$route['cellar/get-list-product']               = '/app/cellar/appCellarController/getListProduct';
$route['cellar/include-product']                = '/app/cellar/appCellarController/includeProduct';
$route['cellar/calculate-tnt-manual']           = '/app/cellar/appCellarController/calculateTntManual';
$route['cellar/save-transport-manual']          = '/app/cellar/appCellarController/asignedTransportManual';
$route['(:any)/get-state-order']                = '/app/cellar/appCellarController/getOrderState';
$route['cellar/change-state-order']             = '/app/cellar/appCellarController/changeState';
$route['cellar/picking']                        = '/app/cellar/appCellarController/indexPicking';
$route['cellar/get-order-for-pickin']           = '/app/cellar/appCellarController/getOrderForPicking';
$route['cellar/get-item-order-for-pickin']      = '/app/cellar/appCellarController/getItemOrderForPicking';
$route['cellar/picking-order']                  = '/app/cellar/appCellarController/pickingOrder';
$route['cellar/change-state']                   = '/app/cellar/appCellarController/changeStateGeneric';
$route['cellar/verify']                         = '/app/cellar/appCellarController/indexVerify';
$route['cellar/get-order-for-verify']           = '/app/cellar/appCellarController/getOrderForVerify';
$route['cellar/get-item-order-for-verify']      = '/app/cellar/appCellarController/getItemOrderForVerify';
$route['cellar/verify-order']                   = '/app/cellar/appCellarController/verifyOrder';


$route['administration/pay']                    = '/app/administration/appAdministrationController/indexPay';
$route['administration/get-pay-month']          = '/app/administration/appAdministrationController/getPayMonth';
$route['administration/get-pay-client']         = '/app/administration/appAdministrationController/getPayClient';
$route['administration/get-pay-id']             = '/app/administration/appAdministrationController/getPayClientId';
$route['administration/get-state-pay']          = '/app/administration/appAdministrationController/getOrderState';
$route['administration/change-state-pay']       = '/app/administration/appAdministrationController/changeStateGeneric';

$route['(:any)/upload-files-payment']           = '/app/payment/appPaymentController/uploadFileSupport';
$route['mis-pagos/pagos']                       = '/app/payment/appPaymentController/indexPay';

$route['api-ionic']                             = '/app/ionic/appIonicController/getAuthorized';
$route['api-ionic/recovery-authorized']         = '/app/ionic/appIonicController/getApiIonic';
$route['api-ionic/get-mystore-old']             = '/app/ionic/appIonicController/geMyStoreOld';
$route['api-ionic/get-mystore-old-for-free']    = '/app/ionic/appIonicController/geMyStoreForFree';
$route['api-ionic/unlocked-store']              = '/app/ionic/appIonicController/unLockedStore';
$route['api-ionic/analysis-old']                = '/app/ionic/appIonicController/getAnalisisStore';
$route['api-ionic/get-list-prices-store']       = '/app/ionic/appIonicController/getListPricesStore';
$route['api-ionic/change-prices-store']         = '/app/ionic/appIonicController/changePrice';
$route['api-ionic/activate-prices-store']       = '/app/ionic/appIonicController/activateProduct';