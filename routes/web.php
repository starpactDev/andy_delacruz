<?php

use Braintree\Gateway;
use App\Models\Container;
use Illuminate\Http\Request;
use App\Models\ContainerNumber;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LangController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\DriverController;
use App\Http\Controllers\ReceiverInfoController;
use App\Http\Controllers\User\InvoiceController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\User\CalendarController;
use App\Http\Controllers\User\CustomerController;
use App\Http\Controllers\User\ShippingController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\BusinessExpenseCntroller;
use App\Http\Controllers\ClientFollowUpController;
use App\Http\Controllers\MarketingEmailController;
use App\Http\Controllers\User\ContainerController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\Admin\SecretaryController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Customer\CustomerDashboard;
use App\Http\Controllers\Seceretary\TruckController;
use App\Http\Controllers\User\ManagerRoleController;
use App\Http\Controllers\Admin\Due\PaymentController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\AddNotesByRdDriverController;
use App\Http\Controllers\Admin\AdminProjectCOntroller;
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
use App\Http\Controllers\Driver\DriverLoginController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Manager\OrderPickUpController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Customer\CustomerAuthConroller;
use App\Http\Controllers\Driver\DriverProfileController;
use App\Http\Controllers\Driver\PickupRequestController;
use App\Http\Controllers\Driver\ShippingFinalController;
use App\Http\Controllers\Driver\RouteDirectionController;
use App\Http\Controllers\RDDriverMoneyExchangeController;
use App\Http\Controllers\Driver\BarcodeShippingController;
use App\Http\Controllers\Driver\DriverDashboardController;
use App\Http\Controllers\SecretaryExpenseReportController;
use App\Http\Controllers\CustomerDashboard\SurveyController;
use App\Http\Controllers\Admin\Customer\profileCheckCOntroller;



// Customer Dashboard

Route::middleware('auth:sender')->group(function () {
    Route::get('/customer-dashboard', [CustomerDashboard::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/customer-new-package-request', [CustomerDashboard::class, 'new_package_request_form'])->name('new_package_request_form');
    Route::post('/logout', [CustomerDashboard::class, 'logout'])->name('sender.logout');

    Route::get('/how-was-my-experience/{order_pickup_id}', [SurveyController::class, 'survey_form'])->name('survey_from_customer');
    Route::post('/feedback', [SurveyController::class, 'store'])->name('feedback.store');
    Route::get('/survey/view/{orderId}', [SurveyController::class, 'showSurvey'])->name('survey.view');

    Route::post('/update-sender', [CustomerDashboard::class, 'updateSender'])->name('update.sender');

    Route::get('/collect-payment/{order_pickup_id}', [ContainerController::class, 'collect_by_customer'])->name('collect_payment');

    Route::get('/paypal-store-payment-by-customer', [PaymentController::class, 'createPayment'])->name('store_payment_new');
    Route::get('/customers-order-overview/{order_pickup_id}', [UserController::class, 'custom_order_overview'])->name('custom.order_overview');

});







Route::get('/get-cities-by-province', [ManagerController::class, 'getCitiesByProvince'])->name('get.cities.by.province');


Route::get('/', function () {
    return view('login_dashboard');
})->name('login_dashboard');

Route::post('/check-email', [PasswordResetController::class, 'checkEmail'])->name('check.email');
Route::get('/reset-password', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');


Route::get('/view-invoice/{order_number}', [InvoiceController::class, 'invoice_index'])->name('invoice.index');
Route::post('/fetch-invoices', [InvoiceController::class, 'fetchInvoices'])->name('fetch.invoices');
Route::get('/fetch-invoices-for-print', [InvoiceController::class, 'fetchInvoicesPrint'])->name('fetch.invoices.print');
Route::get('/fetch-start-invoices-for-print', [InvoiceController::class, 'fetchStartInvoicesPrint'])->name('fetch.start.invoices.print');


Route::get('/get-client-token', function () {
    $gateway = new Gateway([
        'environment' => env('BRAINTREE_ENV'),
        'merchantId' => env('BRAINTREE_MERCHANT_ID'),
        'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
        'privateKey' => env('BRAINTREE_PRIVATE_KEY'),
    ]);

    return response()->json(['clientToken' => $gateway->clientToken()->generate()]);
})->name('get.client.token'); // Assign a name to the route

Route::get('/get-payment-details/{id}', [PaymentController::class, 'getPaymentDetails'])->name('get.payment.details');

//for language
Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');

Route::get('/login', [DriverLoginController::class, 'driver_login'])->name('driver_login')->middleware('auth.redirect');
Route::post('driver-login-check', [DriverLoginController::class, 'driver_login_check'])->name('driver_login_check')->middleware('auth.redirect');

Route::post('/save-signature', [SignatureController::class, 'saveSignature'])->name('save-signature');
Route::post('receiver/save-signature', [SignatureController::class, 'receiver_saveSignature'])->name('receiver-save-signature');
Route::get('/api/get-receiver-signature/{receiverId}', [SignatureController::class, 'getReceiverSignature'])
    ->name('get.receiver.signature');


Route::get('/api/get-receiver-id-images/{order_pickup_id}', [ReceiverInfoController::class, 'getReceiverIdImages'])
    ->name('api.get-receiver-id-images');


Route::get('payment/paypal/success', [PaymentController::class, 'successPayment'])->name('paypal.success');
Route::get('payment/paypal/cancel', [PaymentController::class, 'cancelPayment'])->name('paypal.cancel');
Route::get('invoice/payment/paypal/success', [ShippingFinalController::class, 'successPayment'])->name('invoice.paypal.success');
Route::get('invoice/payment/paypal/cancel', [ShippingFinalController::class, 'cancelPayment'])->name('invoice.paypal.cancel');

Route::get('/customers-order-overview/{order_pickup_id}', [UserController::class, 'order_overview'])->name('order_overview');
Route::get('/order-overview-from-customer-dashboard/{order_pickup_id}', [UserController::class, 'order_overview_from_customer'])->name('order_overview_from_customer');




Route::post('/notifications/decrement', [NotificationController::class, 'decrementNotificationCount'])
    ->name('notifications.decrement')
    ->middleware('auth'); // Ensure the user is authenticated



Route::group(["as" => "driver.", "middleware" => ["driver-access"]], function () {
    Route::get('/paypal-store-payment-for-driver', [PaymentController::class, 'createPayment'])->name('store_payment_new');

//Money Exchange in Peso
Route::get('/money-exchange/in-peso', [RDDriverMoneyExchangeController::class, 'index'])->name('money_exchange_peso.index');


    // Profile
    Route::get('/driver-profile', [DriverProfileController::class, 'index'])->name('profile');
    Route::post('driver/profile/update', [DriverProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('driver/update-password', [DriverProfileController::class, 'updatePassword'])->name('update.password');




    // Rd-Profile
    Route::post('/add-note', [AddNotesByRdDriverController::class, 'store'])->name('add.note');
    Route::get('/get-notes/{orderPickupId}', [AddNotesByRdDriverController::class, 'getNotes'])->name('get.notes');
    Route::delete('/notes/{id}', [AddNotesByRdDriverController::class, 'destroy'])->name('notes.destroy');

    Route::get('/rd-driver-pending-delivery', [AddNotesByRdDriverController::class, 'rd_pending_list'])->name('rd_pending.list');
    Route::get('/rd-driver-completed-delivery', [AddNotesByRdDriverController::class, 'rd_completed_list'])->name('rd_completed.list');

    // Dashboard
    Route::get('/driver-dashboard', [DriverDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/driver-logout', [DriverLoginController::class, 'driver_logout'])->name('driver_logout');

    // Pickup Request -USA Dashboard
    Route::get('/pickup-request-list', [PickupRequestController::class, 'pickup_list'])->name('pickup.list');
    Route::post('/update-status/{eventId}', [PickupRequestController::class, 'update_status'])->name('update-status');

    // Route Direction - Dom REP Dashboard
    Route::get('/route-direction-list', [RouteDirectionController::class, 'rd_route_list'])->name('rd_route.list');

    Route::post('/driver-store-payment', [ContainerController::class, 'storePayment'])->name('store_payment');

    //Users
    //  Route::get('/admin-manage-users', [UserController::class, 'index'])->name('users.index');
    //  Route::get('/admin-users-earning', [UserController::class, 'ongoing_projects'])->name('users.earning');
    //  Route::get('/admin-users-performance', [UserController::class, 'add_projects'])->name('users.performance');
    //  Route::get('/admin-users-orders', [UserController::class, 'add_projects'])->name('users.orders');

    //Shipping
    // Route::get('/driver-view-shipping-details', [UserController::class, 'add_projects'])->name('shipping.index');

    //Customers
    Route::get('/driver-view-customers-transactions', [UserController::class, 'transaction_history'])->name('customers.transaction');
    Route::get('/driver-view-customers-due-amount', [UserController::class, 'customer_due_amount'])->name('customers.due_amount');
    Route::get('/rd-driver-view-customers-due-amount', [UserController::class, 'customer_due_amount_rd'])->name('customers.rd_due_amount');
    Route::get('/my-customer-order-overview/{order_pickup_id}', [UserController::class, 'order_overview'])->name('driver_order_overview');

    //shipping
    Route::get('/usa-employee-create-new-shipment', [ShippingController::class, 'add_form'])->name('shipping.add');
    Route::get('/search-customers', [ShippingController::class, 'searchCustomers'])->name('search.customers');
    Route::get('/receiver/details', [ShippingController::class, 'fetchReceiverDetails'])->name('fetch.receiverDetails');
    Route::post('/order-pickup/store', [ShippingController::class, 'store'])->name('order-pickup.store');
    Route::get('/driver/fetch/repeatReceivers', [ShippingController::class, 'fetchRepeatReceivers'])->name('fetch.repeatReceivers');
    Route::post('/drivers/senders/{id}', [CustomerController::class, 'sender_update'])->name('sender.update.data');
    Route::post('/drivers/receivers/{id}', [CustomerController::class, 'receiver_update'])->name('receiver.update.data');


    Route::get('/invoice-shipment-list', [ShippingController::class, 'invoice_list'])->name('invoice.list');
    Route::get('/us-invoice-shipment-list', [ShippingController::class, 'us_invoice_list'])->name('us_invoice.list');
    Route::get('/rd-invoice-shipment-list', [ShippingController::class, 'rd_invoice_list'])->name('rd_invoice.list');

    Route::post('/save-sender-details', [CustomerController::class, 'saveSenderDetails'])->name('save.sender.details');
    Route::post('/receiver/save', [CustomerController::class, 'saveReceiverDetails'])->name('receiver.save');
    // Sender-id
    Route::post('/upload-id-images', [CustomerController::class, 'uploadIdImages'])->name('upload.id.images');
    Route::post('/upload-receiver-id-images', [ReceiverInfoController::class, 'uploadReciverIdImages'])->name('upload.reciver.id.images');
    Route::post('/upload-package-images', [CustomerController::class, 'uploadPackageImages'])->name('upload.package.images');
    Route::post('/upload-receiver-package-images', [ReceiverInfoController::class, 'uploadReceiverPackageImages'])->name('upload.receiver.package.images');

    Route::get('/driver/fetch-uploaded-images', [ReceiverInfoController::class, 'fetchUploadedImages'])->name('fetch.uploaded.package.images');
    Route::get('/check-missing-data', [ReceiverInfoController::class, 'checkMissingData'])->name('check.missing.data');


    //Order Pickup Submission
    Route::post('/store-items', [ShippingFinalController::class, 'storeItems'])->name('store.items');
    Route::post('/store-all', [ShippingFinalController::class, 'storeAll'])->name('store.all');
    // Reminder
    Route::get('/employee-view-reminders', [NotificationController::class, 'reminders'])->name('reminders.index');


    //Invoice
    Route::get('/usa-employee-create-new-invoice', [InvoiceController::class, 'add_form'])->name('invoice.add');
    Route::get('/usa-employee-edit-invoice/{order_number}', [InvoiceController::class, 'edit_form'])->name('invoice.edit');

    Route::get('/employee-print-invoice-preview/{order_number}', [InvoiceController::class, 'preview'])->name('invoice.preview');
    Route::get('/employee-generate-invoice/{order_number}', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/employee-share-invoice/{order_number}', [InvoiceController::class, 'share_index'])->name('invoice.share_index');
    Route::get('/employee-pdf-invoice/{order_number}', [InvoiceController::class, 'invoice_pdf'])->name('invoice.pdf_index');
    Route::get('/employee-print-shipping-preview/{order_number}', [InvoiceController::class, 'shipping'])->name('invoice.shipping.preview');
    Route::get('/barcode/generate-and-redirect/{order_number}', [BarcodeShippingController::class, 'generateBarcodeAndRedirect'])
        ->name('barcode.generateAndRedirect');
    Route::get('/driver-employee-collect-payment/{order_pickup_id}', [InvoiceController::class, 'collect'])->name('collect_payment');

    //
    Route::post('/start-route', [RouteController::class, 'startRoute'])->name('start.route');

});

Route::get('/fetch-notes/{orderNumber}', [RouteController::class, 'fetchNotes'])->name('fetch.notes');


//Users Route



Route::get('/user-login', [UserLoginController::class, 'user_login'])->name('user_login')->middleware('auth.redirect');
Route::post('user-login-check', [UserLoginController::class, 'user_login_check'])->name('user_login_check')->middleware('auth.redirect');
Route::post('/submit-truck', [TruckController::class, 'store'])->name('trucks.store');
Route::post('/update-truck', [TruckController::class, 'update'])->name('trucks.update');
Route::post('/delete-truck', [TruckController::class, 'destroy'])->name('trucks.destroy');

Route::group(
    ["as" => "user.", "middleware" => ["user-access"]],
    function () {

        Route::get('/paypal-store-payment', [PaymentController::class, 'createPayment'])->name('store_payment_new');
        Route::get('/employee-view-pdf-invoice/{order_number}', [InvoiceController::class, 'invoice_pdf'])->name('invoice.pdf_index');

        //Survey
        Route::get('/survey/view/from/admin-manager/{orderId}', [SurveyController::class, 'showSurveybyAdmin'])->name('survey.view');
        // Secretary
        Route::get('/secretary/manage/dominican/expense-report', [TruckController::class, 'index'])->name('secretary.expense_report');

        // manager

        Route::get('/distribution-of-packagers', [ManagerController::class, 'distribution_of_packagers'])->name('distribution_of_packagers');
        Route::post('/assign-orders', [ManagerController::class, 'assignOrders'])->name('assigned_orders');

        //manage_role.manager
        Route::get('/manage-role-manager', [ManagerRoleController::class, 'role_list'])->name('manage_role.manager')->middleware('not_for_manager');
        Route::post('/manage-permission', [ManagerRoleController::class, 'store'])->name('manage.permission.store');
        Route::delete('delete/manage-permission', [ManagerRoleController::class, 'destroy'])->name('manage.permission.delete');
        Route::get('/manage-permission/check', [ManagerRoleController::class, 'checkPermission'])->name('manage.permission.check');
        Route::get('/get-client-list-status', [ManagerRoleController::class, 'getClientListStatus'])->name('get-client-list-status');
        Route::get('/get-docs-status', [ManagerRoleController::class, 'getDocsStatus'])->name('get-docs-status');

        // Update the client list status to 'off'
        Route::post('/update-client-list-permission', [ManagerRoleController::class, 'updateClientListPermission'])->name('update-client-list-permission');
        Route::post('/update-docs-list-permission', [ManagerRoleController::class, 'updateDocsPermission'])->name('update-docs-list-permission');

        // Delete the client list row when toggled on
        Route::delete('/delete-client-list-permission', [ManagerRoleController::class, 'deleteClientListPermission'])->name('delete-client-list-permission');
        Route::delete('/delete-docs-list-permission', [ManagerRoleController::class, 'deleteDocsListPermission'])->name('delete-docs-list-permission');
        Route::post('/send-marketing-email', [MarketingEmailController::class, 'send'])->name('send.marketing.email');
        // CUstomer Dashboard
        Route::get('/customer-profile-visit', [profileCheckCOntroller::class, 'checking'])->name('customer.profile_check');
        Route::post('/check-sender-email', [profileCheckCOntroller::class, 'checkEmail'])->name('check.sender.email');

        Route::get('/admin-visit-customer-dashboard/{sender}', [profileCheckCOntroller::class, 'visit_dashboard'])->name('customer.visit_dashboard');

        // Dashboard
        Route::get('/employee-dashboard', [UserDashboardController::class, 'dashboard'])->name('dashboard');
        // Manager Dashboard
        Route::get('/order-pickups-by-province', [OrderPickUpController::class, 'getOrderPickupsByProvince'])->name('order.pickups.by.province');
        Route::post('/assign-driver', [OrderPickUpController::class, 'assignDriver'])->name('assign.driver');
        Route::get('/assign-driver-packages', [OrderPickUpController::class, 'assignDriverPackages'])->name('driver.packages');



        Route::post('/update-package-status', [ContainerController::class, 'updatePackageStatus'])->name('update.package.status');
        Route::get('/get-container-status', [ContainerController::class, 'getContainerStatus'])->name('get.container.status');



        Route::get('/user-logout', [UserLoginController::class, 'user_logout'])->name('user_logout');

        //Profile
        Route::post('/profile/update', [UserDashboardController::class, 'updateProfile'])->name('profile.update');
        Route::post('/update-password', [UserDashboardController::class, 'updatePassword'])->name('update-password');

        Route::get('/employee-profile', [UserDashboardController::class, 'manage_profile'])->name('profile');
        //Calendar
        Route::get('/employee-view-calendar', [CalendarController::class, 'index'])->name('calendar.index');
        Route::get('/package-pickup-report', [CalendarController::class, 'report'])->name('calendar.report');
        Route::post('/employee-store-event-on-calendar', [CalendarController::class, 'store'])->name('calendar.events.store');
        Route::post('/employee-update-event-on-calendar', [CalendarController::class, 'update'])->name('calendar.events.update');
        Route::get('/calendar-events', [CalendarController::class, 'getEvents'])->name('calendar.events.get');
        //Containers
        Route::get('/employee-container-add', [ContainerController::class, 'add'])->name('container.add');
        Route::post('/employee-container-order-move', [ContainerController::class, 'move'])->name('move.order');
        Route::post('/employee-container-order-move-to-held-by-custom', [ContainerController::class, 'move_status'])->name('move.order_status_to_held_by_custom');
        Route::post('/employee-container-order-move-to-distribution', [ContainerController::class, 'move_status_distribution'])->name('move.order_status_to_distribution');
        Route::get('/leftover-packages/{container_number}', [ContainerController::class, 'leftoverPackages'])->name('leftover.packages');
        Route::get('/held-by-custom-packages/{container_number}', [ContainerController::class, 'heldPackages'])->name('held.custom.packages');
        Route::get('/employee-container-distribution', [ContainerController::class, 'distribution'])->name('container.distribution');
        Route::get('/employee-follow-up-clients', [ClientFollowUpController::class, 'showGroupedOrders'])->name('client_follow_up.index');
        Route::get('/employee-packages-distribution', [ContainerController::class, 'package_distribute'])->name('packages.distribution');
        Route::get('/orders/assigned', [ContainerController::class, 'showAssignedOrders'])->name('orders.assigned');
        Route::post('/update-customs-status/{orderId}', [ContainerController::class, 'updateCustomsStatus'])->name('order.updateCustomsStatus');

        Route::get('/employee-container-manage', [ContainerController::class, 'close'])->name('container.close');
        Route::post('/update-container-number', function (Request $request) {

            $currentNumber = $request->input('currentNumber');
            $formattedNumber = 'EPG ' . $currentNumber;
            // Update or insert the current container number in the database
            ContainerNumber::updateOrInsert(
                ['key' => 'currentContainerNumber'], // Key for identifying the container number
                ['value' => 'EPG ' . $currentNumber]          // New container number value
            );
            Container::create(

                ['name' => $formattedNumber]             // Set the name field
            );
            return response()->json(['success' => true]);
        })->name('container.update');
        Route::get('/get-orders', [ContainerController::class, 'getOrders'])->name('get.orders');
        Route::get('/employee-view-container-history', [ContainerController::class, 'history'])->name('container.history');
        Route::get('/employee-view-container-details', [ContainerController::class, 'view'])->name('container.view');
        Route::get('/employee-container-details/{id}', [ContainerController::class, 'details'])->name('container.details');
        Route::get('/container/search', function (Request $request) {
            $search = $request->get('term', '');
            $results = Container::where('name', 'LIKE', "%$search%")
                ->pluck('name'); // Retrieve only the names
            return response()->json($results);
        })->name('container.search');

        //Due Amount
        Route::get('/view-due-amount', [ContainerController::class, 'due_amount'])->name('due_amount');
        Route::get('/view-pending-orders', [ContainerController::class, 'pending_order'])->name('pending_order');
        Route::get('/view-delivered-orders', [ContainerController::class, 'delivered_order'])->name('delivered_order');

        Route::get('/view-total-earnings', [ContainerController::class, 'total_earnings'])->name('total_earnings')->middleware('not_for_manager');

        Route::get('/view-packages-and-id-info/{order_pickup_id}', [ContainerController::class, 'packages_info'])->name('packages_info');
        Route::get('/customer-order-overview/{order_pickup_id}', [ContainerController::class, 'order_overview'])->name('order_overview');
        Route::get('/get-total-amount', [ContainerController::class, 'getTotalAmount'])->name('getTotalAmount');
        Route::get('/get-containers', [ContainerController::class, 'getContainers'])->name('getContainers');
        Route::post('/store-note', [ContainerController::class, 'storeNote'])->name('store.note');

        Route::get('/employee-collect-payment/{order_pickup_id}', [ContainerController::class, 'collect'])->name('collect_payment');
        Route::post('/store-payment', [ContainerController::class, 'storePayment'])->name('store_payment');

        // Manage Accounts
        Route::get('/admin-manage-managers', [CustomerController::class, 'index'])->name('customer.index');
        Route::get('/employee-manage-drivers', [DriverController::class, 'index'])->name('driver.index');

        Route::post('/employee-create-driver', [DriverController::class, 'store'])->name('driver.store');
        Route::get('/drivers/{id}/edit', [DriverController::class, 'edit'])->name('driver.edit');
        Route::post('/drivers/{id}', [DriverController::class, 'update'])->name('driver.update');
        Route::delete('/drivers/{id}', [DriverController::class, 'destroy'])->name('driver.destroy');
        Route::get('/drivers/{id}/show', [DriverController::class, 'show'])->name('driver.show');

        // Manage Secretary
        Route::get('/admin-manage-secretary', [SecretaryController::class, 'index'])->name('secretary.index');
        Route::post('/secretary/store', [SecretaryController::class, 'store'])->name('secretary.store');
        Route::post('/secretary/update', [SecretaryController::class, 'update'])->name('secretary.update');
        Route::delete('/secretary/{id}', [SecretaryController::class, 'destroy'])->name('secretary.destroy');

        //manager
        Route::post('/manager/store', [CustomerController::class, 'store'])->name('manager.store');
        Route::post('/managers/update', [CustomerController::class, 'update'])->name('manager.update');
        Route::delete('/manager/{id}', [CustomerController::class, 'destroy'])->name('manager.destroy');
        //Sender
        Route::get('/senders/{id}/edit', [CustomerController::class, 'sender_edit'])->name('sender.edit');
        Route::post('/senders/{id}', [CustomerController::class, 'sender_update'])->name('sender.update');
        Route::delete('/senders/{id}', [CustomerController::class, 'sender_destroy'])->name('sender.destroy');


        // employee
        Route::get('/admin-manage-employees', [CustomerController::class, 'employee_index'])->name('employee.index');
        Route::get('/admin-employees-credentials', [CustomerController::class, 'employee_credentials'])->name('employee.credentials');
        Route::post('/employees-store', [CustomerController::class, 'employee_store'])->name('employee.store');
        Route::get('/api/employees/fetch/{id}', [CustomerController::class, 'employee_show'])->name('employee.show');
        Route::put('/employees-update/{id}', [CustomerController::class, 'employee_update'])->name('employee.update');
        Route::delete('/employees/destroy/{id}', [CustomerController::class, 'employee_destroy'])->name('employee.destroy');


        Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])->name('team.edit');
        Route::post('/employee/edit/{id}', [EmployeeController::class, 'update'])->name('team.update');
        Route::delete('/employee/delete/{id}', [EmployeeController::class, 'destroy'])->name('team.delete');
        Route::post('/convert-to-sender/{id}', [CustomerController::class, 'convertToSender'])->name('convert.to.sender');

        Route::get('/employee-view-my-customers-list', [CustomerController::class, 'potential_customer_index'])->middleware('check.client.list')->name('potential_customer.index');
        Route::get('/employee-add-potential-customers', [CustomerController::class, 'potential_customer_add'])->name('add_potential_customer.index');
        Route::get('/admin-view-potential-customers-list', [CustomerController::class, 'potential_customer_view'])->name('potential_customer.view');
        Route::post('/potential-customers', [CustomerController::class, 'potential_customer_store'])->name('potentialCustomer.store');
        Route::get('/potential-customers/edit/{id}', [CustomerController::class, 'potential_customer_edit'])->name('potentialCustomer.edit');
        Route::post('/potential-customers/update/{id}', [CustomerController::class, 'potential_customer_update'])->name('potentialCustomer.update');
        Route::delete('/potential-customers/{id}', [CustomerController::class, 'potential_customer_destroy'])->name('potentialCustomer.destroy');
        Route::get('/fetch-orders', [CustomerController::class, 'fetchOrders'])->name('orders.fetch');
        Route::get('/fetch-payments', [CustomerController::class, 'fetchPayments'])->name('payments.fetch');
        Route::get('/fetch-receiver-info', [CustomerController::class, 'fetchReceiverInfo'])->name('fetch.receiver.info');


        Route::get('/employee-view-customers', [CustomerController::class, 'customer_index'])->name('new_customer.index');

        // Notification
        Route::get('/employee-view-notifications', [NotificationController::class, 'index'])->name('notification.index');
        //Suppliers
        Route::get('/view-profile', [SupplierController::class, 'index'])->name('supplier.index');
        Route::post('/supplier/store', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('/suppliers/{id}', [SupplierController::class, 'show'])->name('supplier.show');
        Route::post('/suppliers/update', [SupplierController::class, 'update'])->name('supplier.update');

        Route::delete('/supplier/destroy/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

        // Expenses

        Route::get('/view-business-expense', [BusinessExpenseCntroller::class, 'index'])->name('business.expense');
        Route::post('/expenses/update', [BusinessExpenseCntroller::class, 'updateExpense'])->name('expenses.update');
        Route::delete('expenses/{id}', [BusinessExpenseCntroller::class, 'destroy'])->name('expenses.destroy');
        Route::post('expenses', [BusinessExpenseCntroller::class, 'store'])->name('expenses.store');
        Route::get('/expenses/filter', [BusinessExpenseCntroller::class, 'filterExpensesByMonth'])->name('expenses.filterByMonth');
        // Sender Password Manage

        Route::post('/update-password/{id}', [CustomerController::class, 'updatePassword'])->name('update.password');


    }
);
