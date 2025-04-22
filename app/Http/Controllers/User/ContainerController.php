<?php

namespace App\Http\Controllers\User;
use App\Models\Container;
use App\Models\OrderPickUp;
use PayPal\Rest\ApiContext;
use App\Models\OrderPayment;
use App\Models\PaymentModel;
use Illuminate\Http\Request;
use App\Models\UserDriverInfo;
use App\Models\ContainerStatus;
use App\Models\LeftoverPackage;
use App\Models\SignatureSender;
use App\Services\PayPalService;
use App\Models\ReceiverSignature;
use App\Models\AddNotesByRdDriver;
use App\Models\SenderIdentityCard;
use Illuminate\Support\Facades\DB;
use App\Models\SenderPackagesImage;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ContainerOrderDetail;
use App\Models\ReceiverIdentityCard;
use Illuminate\Support\Facades\Auth;
use App\Models\AssignedOrderToDriver;
use App\Models\ReceiverPackagesImage;
use Illuminate\Pagination\LengthAwarePaginator;


class ContainerController extends Controller
{
    public function updateCustomsStatus(Request $request, $orderId)
    {
        $order = OrderPickUp::where('order_number', $orderId)->first();
        $left = LeftoverPackage::where('order_id', $orderId)->first();

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found']);
        }
        if (!$left) {
            return response()->json(['success' => false, 'message' => 'Order not found']);
        }
        $left->delete();
        // Update the package status to "CUSTOMS"
        $order->package_status = 'CUSTOMS';
        $order->save();

        return response()->json(['success' => true, 'message' => 'Package status updated']);
    }

    public function package_distribute()
    {
        $provinces = [
            ['name' => 'AZUA'],
            ['name' => 'BAHORUCO'],
            ['name' => 'BARAHONA'],
            ['name' => 'DAJABON'],
            ['name' => 'DISTRITO NACIONAL'],
            ['name' => 'DUARTE'],
            ['name' => 'EL SEYBO'],
            ['name' => 'ELIAS PIÑA'],
            ['name' => 'ESPAILLAT'],
            ['name' => 'HATO MAYOR'],
            ['name' => 'HERMANAS MIRABAL'],
            ['name' => 'INDEPENDENCIA'],
            ['name' => 'LA ALTAGRACIA'],
            ['name' => 'LA ROMANA'],
            ['name' => 'LA VEGA'],
            ['name' => 'MARIA TRINIDAD SANCHEZ'],
            ['name' => 'MONSEÑOR NOUEL'],
            ['name' => 'MONTE PLATA'],
            ['name' => 'MONTECRISTI'],
            ['name' => 'PEDERNALES'],
            ['name' => 'PERAVIA'],
            ['name' => 'PUERTO PLATA'],
            ['name' => 'SAMANA'],
            ['name' => 'SAN CRISTOBAL'],
            ['name' => 'SAN JOSE DE OCOA'],
            ['name' => 'SAN JUAN'],
            ['name' => 'SAN PEDRO DE MACORIS'],
            ['name' => 'SANCHEZ RAMIREZ'],
            ['name' => 'SANTIAGO'],
            ['name' => 'SANTIAGO RODRIGUEZ'],
            ['name' => 'SANTO DOMINGO'],
            ['name' => 'VALVERDE'],
        ];

        $currentContainerNumber = config('global.currentContainerNumber');
        $orderPickups = OrderPickUp::where('container_number', $currentContainerNumber)->get();
        $notesCount = AddNotesByRdDriver::whereIn('order_pickup_id', $orderPickups->pluck('id'))->count();
        $groupedOrders = $orderPickups->groupBy(function ($order) {
            return $order->receiver->province ?? 'Unknown'; // Fallback to 'Unknown' if province is null
        });

        $dominicanTeamDrivers = UserDriverInfo::where('team', 'Dominican Team')->get();
        return view('user.container.package.distribution', compact('notesCount', 'groupedOrders', 'provinces', 'dominicanTeamDrivers'));


    }

    public function showAssignedOrders()
    {
        // Fetch the assigned orders or handle the logic here.
        $currentContainerNumber = config('global.currentContainerNumber');

        $assignedOrders = AssignedOrderToDriver::with('orderPickup', 'driver')
            ->whereHas('orderPickup', function ($query) {
                $query->where('container_number', config('global.currentContainerNumber'));
            })
            ->get()
            ->groupBy('driver_id'); // Group by driver_id
        return view('user.container.orders.assigned', compact('assignedOrders', 'currentContainerNumber'));
    }
    public function move(Request $request)
    {
        $request->validate([
            'order_number' => 'required|exists:order_pickups,order_number', // Validate order_number
        ]);

        $order = OrderPickUp::where('order_number', $request->order_number)->firstOrFail();

        // Update the container_number by incrementing its numeric part
        $currentContainer = $order->container_number;
        preg_match('/EPG (\d+)/', $currentContainer, $matches);
        if (!isset($matches[1])) {
            return response()->json(['success' => false, 'message' => 'Invalid container number format.'], 400);
        }
        $newContainerNumber = 'EPG ' . ($matches[1] + 1);

        // Update the order_number by adding "A" before the last 4 digits
        $originalOrderNumber = $request->order_number;
        $lastFourDigits = substr($originalOrderNumber, -4);
        $updatedOrderNumber = substr($originalOrderNumber, 0, -4) . "A" . $lastFourDigits;

        // Update the order
        $oldContainerNumber = $order->container_number;
        $order->update([
            'container_number' => $newContainerNumber,
            'order_number' => $updatedOrderNumber,
        ]);

        // Record the leftover package
        LeftoverPackage::create([
            'order_id' => $updatedOrderNumber, // Use updated order_number as order_id
            'old_container_id' => $oldContainerNumber,
            'new_container_id' => $newContainerNumber,
        ]);

        return response()->json(['success' => true, 'message' => 'Order moved and updated successfully.']);
    }

    public function move_status_distribution(Request $request)
    {
        $request->validate([
            'order_number' => 'required|exists:order_pickups,order_number', // Validate order_number
        ]);

        $order = OrderPickUp::where('order_number', $request->order_number)->firstOrFail();

        $order->update([
            'package_status'=> 'IN DISTRIBUTION'
        ]);
        return response()->json(['success' => true, 'message' => 'Order status changed and updated successfully.']);
    }

    public function move_status(Request $request)
    {
        $request->validate([
            'order_number' => 'required|exists:order_pickups,order_number', // Validate order_number
        ]);

        $order = OrderPickUp::where('order_number', $request->order_number)->firstOrFail();

        $order->update([
            'package_status'=> 'HELD BY CUSTOMS'
        ]);
        return response()->json(['success' => true, 'message' => 'Order status changed and updated successfully.']);
    }
    public function distribution()
    {
        $currentContainerNumber = config('global.currentContainerNumber');
        // Fetch all orders with the same container number
        $orders = OrderPickUp::where('container_number', $currentContainerNumber)
        ->where('package_status','!=','HELD BY CUSTOMS')
            ->with('receiver') // Ensure the receiver relationship is loaded
            ->get();
        $count_orders = OrderPickUp::where('container_number', $currentContainerNumber)
            ->with('receiver') // Ensure the receiver relationship is loaded
            ->count();

        // Group orders by the receiver's province
        $groupedOrders = $orders->groupBy(function ($order) {
            return $order->receiver->province ?? 'Unknown Province';
        });

        $leftoverPackages = LeftoverPackage::with('orderPickup')->where('old_container_id', $currentContainerNumber)->get();
        $investigation_orders = OrderPickUp::where('container_number', $currentContainerNumber)
        ->where('package_status','HELD BY CUSTOMS')
            ->with('receiver') // Ensure the receiver relationship is loaded
            ->get();
        return view('user.pages.container.distribution', compact('groupedOrders', 'currentContainerNumber', 'count_orders', 'investigation_orders'));

    }
    public function leftoverPackages($container_number)
    {
        // You can use these parameters (container_number, currentContainerNumber) in your logic
        $leftoverPackages = LeftoverPackage::with('orderPickup')->where('old_container_id', $container_number)->get();
        $currentContainer = $container_number;
        preg_match('/EPG (\d+)/', $currentContainer, $matches);

        $newContainerNumber = 'EPG ' . ($matches[1] + 1);
        // Example: Passing data to the view
        return view('user.pages.container.leftoverPackages', [
            'container_number' => $container_number,
            'newContainerNumber' => $newContainerNumber,
            'leftoverPackages' => $leftoverPackages
        ]);
    }
    public function heldPackages($container_number)
    {
        $held_packages= OrderPickup::where('container_number',$container_number)->where('package_status','HELD BY CUSTOMS')->get();


        // Example: Passing data to the view
        return view('user.pages.container.heldPackages', [
            'investigation_orders' => $held_packages,
            'container_number' => $container_number,


        ]);
    }
    public function add()
    {
        $currentContainerNumber = config('global.currentContainerNumber');

        // Check if the container number exists in the ContainerStatus table
        $containerStatus = ContainerStatus::where('container_number', $currentContainerNumber)->where('status', 'IN DISTRIBUTION')->first();

        if ($containerStatus) {
            // The container exists
            $hideMoveOrderButton = true;  // Set a flag to hide the last column
        } else {
            // The container does not exist
            $hideMoveOrderButton = false;
        }
        return view('user.pages.container.index', ['containerStatus' => $containerStatus, 'hideMoveOrderButton' => $hideMoveOrderButton]);
    }
    public function packages_info($order_pickup_id)
    {
        $order = OrderPickUp::find($order_pickup_id);

        $orderNumber = $order ? $order->order_number : null;

        // Fetch the sender identity card associated with the order pickup ID
        $senderIdentityCard = SenderIdentityCard::where('order_pickup_id', $orderNumber)->first();
        $receiverIdentityCard = ReceiverIdentityCard::where('order_pickup_id', $orderNumber)->first();

        $packageImages = SenderPackagesImage::where('order_pickup_id', $orderNumber)->get();
        $receiverPackageImages = ReceiverPackagesImage::where('order_pickup_id', $orderNumber)->get();


        $senderSignature = SignatureSender::where('order_pickup_id', $orderNumber)->first();
        $receiverSignature = ReceiverSignature::where('order_pickup_id', $orderNumber)->first();

        return view('user.pages.container.packages_info', [
            'orderNumber' => $orderNumber,
            'senderIdentityCard' => $senderIdentityCard,
            'receiverIdentityCard' => $receiverIdentityCard,
            'packageImages' => $packageImages,
            'receiverPackageImages' => $receiverPackageImages,
            'senderSignature' => $senderSignature,
            'receiverSignature' => $receiverSignature,
        ]);
    }
    public function details($id, Request $request)
    {
        // Get the search term from the request
        $search = $request->input('search');

        // Build the base query to retrieve the order history for the specific container
        $container_number = Container::where('id', $id)->value('name');

        $order_history_query = OrderPickUp::where('container_number', $container_number);


        // Apply search conditions if a search term is provided
        if ($search) {
            // Split the search term by spaces to get individual words
            $searchTerms = explode(' ', $search);

            // Apply search to order_id or sender's name, email, or phone
            $order_history_query->where(function ($query) use ($searchTerms) {
                $query->where('order_number', 'like', '%' . implode(' ', $searchTerms) . '%') // Search by order number
                    ->orWhereHas('sender', function ($query) use ($searchTerms) {
                        // Search for each term in first_name and last_name
                        foreach ($searchTerms as $term) {
                            $query->where('first_name', 'like', '%' . $term . '%')
                                ->orWhere('last_name', 'like', '%' . $term . '%');
                        }

                        // Additionally search by email and telephone
                        $query->orWhere('email', 'like', '%' . implode(' ', $searchTerms) . '%')
                            ->orWhere('telephone', 'like', '%' . implode(' ', $searchTerms) . '%');
                    });
            });
        }

        // Execute the query and get the order history
        $order_history = $order_history_query->get();


        // Pass the data to the view, including the search term and the container ID
        return view('user.pages.container.details', compact('order_history', 'id', 'search', 'container_number'));
    }
    public function due_amount()
    {
        // Fetch all OrderPickup records where is_completed is 0
        $dueOrders = OrderPickUp::where('is_completed', 0)->get();

        // Pass the data to the view
        return view('user.pages.container.due_amount', compact('dueOrders'));
    }
    public function pending_order()
    {
        // Fetch all OrderPickup records where is_completed is 0
        $dueOrders = OrderPickUp::where('package_status', '!=', 'DELIVERED')->get();

        // Pass the data to the view
        return view('user.pages.container.pending_order', compact('dueOrders'));
    }
    public function delivered_order()
    {
        // Fetch all OrderPickup records where is_completed is 0
        $dueOrders = OrderPickUp::where('package_status', 'DELIVERED')->get();

        // Pass the data to the view
        return view('user.pages.container.delivered_order', compact('dueOrders'));
    }
    public function total_earnings()
    {
        // Fetch all OrderPickup records where is_completed is 0
        $dueOrders = OrderPickUp::latest()->get();

        // Pass the data to the view
        return view('user.pages.container.total_earnings', compact('dueOrders'));
    }
    public function order_overview($order_pickup_id)
    {
        $orderDetails = OrderPickUp::with(['sender', 'receiver', 'itemDescriptions', 'payments'])
            ->where('id', $order_pickup_id)
            ->first();

        return view('user.pages.container.order_overview', compact('orderDetails'));
    }
    public function history(Request $request)
    {
        $search = $request->input('search');

        // Generate a range of container numbers from 1 to 20
        $containers = Container::all();

        // Filter containers based on the search query if it exists
        if ($search) {
            // Use filter to get containers matching the search query
            $containers = $containers->filter(function ($container) use ($search) {
                return stripos($container->name, $search) !== false; // Case-insensitive search
            });
        }

        // Convert array to collection and reverse the order
        $containersCollection = collect($containers)->reverse()->values();

        // Paginate the filtered and reversed collection
        $perPage = 20;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $containersCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginatedContainers = new LengthAwarePaginator(
            $currentPageItems,
            $containersCollection->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        return view('user.pages.container.history', compact('paginatedContainers', 'search'));
    }
    public function view(Request $request)
    {
        $search = $request->input('search');

        // Start building the base query for containers
        $query = Container::query();

        // If there is a search query, filter the containers by name
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        // Add subqueries for pending and completed order counts using raw SQL
        $containers = $query->select('containers.*')
            ->addSelect([
                'pending_orders' => OrderPickup::select(DB::raw('count(*)'))
                    ->whereRaw('order_pickups.container_number = containers.name')
                    ->where('package_status', '!=', 'DELIVERED'),
                'completed_orders' => OrderPickup::select(DB::raw('count(*)'))
                    ->whereRaw('order_pickups.container_number = containers.name')
                    ->where('package_status', 'DELIVERED'),
                'total_orders' => OrderPickup::select(DB::raw('count(*)'))
                    ->whereRaw('order_pickups.container_number = containers.name')
            ])
            ->orderBy('id', 'desc')
            ->get();

        // Paginate the containers
        $perPage = 20;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $containers->slice(($currentPage - 1) * $perPage, $perPage)->values();

        // Create the paginator instance
        $paginatedContainers = new LengthAwarePaginator(
            $currentPageItems,
            $containers->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        // Return the view with paginated containers and the search query
        return view('user.pages.container.view', compact('paginatedContainers', 'search'));
    }

    public function collect($order_number)
    {
        $orderDetails = OrderPickUp::with(['sender', 'receiver', 'itemDescriptions', 'payments'])
            ->where('id', $order_number)
            ->first();
        return view('user.pages.container.collect_payment', compact('orderDetails'));
    }
    public function collect_by_customer($order_number)
    {
        $orderDetails = OrderPickUp::with(['sender', 'receiver', 'itemDescriptions', 'payments'])
            ->where('id', $order_number)
            ->first();
        return view('CustomerDashboard.collect_payment', compact('orderDetails'));
    }


    public function getOrders(Request $request)
    {
        $containerNumber = $request->input('container_number');
        if (!$containerNumber) {
            return response()->json(['success' => false, 'message' => 'Container number is required.'], 400);
        }

        $orderDetails = OrderPickUp::with(['sender', 'receiver', 'itemDescriptions', 'payments'])
            ->where('container_number', $containerNumber)
            ->where('package_status', '!=','DELIVERED')
            ->get();

        return response()->json(['success' => true, 'orderDetails' => $orderDetails]);
    }

    public function updatePackageStatus(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'container_number' => 'required|string',
            'selected_step' => 'required|string'
        ]);

        // Get the container number and selected step from the request
        $containerNumber = $validated['container_number'];
        $selectedStep = $validated['selected_step'];

        // Fetch the order details
        $orderDetails = OrderPickUp
            ::where('container_number', $containerNumber)
            ->get();

        // Update package status for all matching records
        foreach ($orderDetails as $order) {
            // Update the package status based on the selected step
            $order->package_status = $selectedStep; // Assuming 'package_status' is the column for status
            $order->save();
        }

        // Create or update the container status
        ContainerStatus::updateOrCreate(
            ['container_number' => $containerNumber],
            ['status' => $selectedStep]
        );

        // Return a success response (you can return a JSON response or a view)
        return response()->json(['message' => 'Package status updated successfully!']);
    }

    public function getContainerStatus(Request $request)
    {

        $containerNumber = $request->query('container_number');
        $status = ContainerStatus::where('container_number', $containerNumber)->value('status');

        return response()->json(['status' => $status]);
    }
    public function getTotalAmount(Request $request)
    {
        $containerNumber = $request->input('container_number');

        // If the container number is 'all', fetch all container data along with sender information
        if ($containerNumber === 'all') {
            // Fetch orders with the sender relationship eager loaded
            $orders = OrderPickUp::with('sender')
                ->select('sender_id', 'order_number', 'container_number', 'grand_total_amount', 'amount_paid', 'package_status')
                ->get();

            // Calculate the total amount for all containers
            $totalAmount = $orders->sum('grand_total_amount');
            $amountPaid = $orders->sum('amount_paid');
            $dueAmount = $totalAmount - $amountPaid;
            $cashAmount = OrderPayment::where('payment_method', 'cash')
                ->whereHas('orderPickup', function ($query) {
                    $query->select('id', 'container_number');
                })
                ->sum('deposit');
            $paypalAmount = OrderPayment::where('payment_method', 'paypal')
                ->whereHas('orderPickup', function ($query) {
                    $query->select('id', 'container_number');
                })
                ->sum('deposit');




        } else {
            // Fetch data for the specific container number with the sender relationship
            $orders = OrderPickUp::with('sender')
                ->where('container_number', $containerNumber)
                ->select('sender_id', 'order_number', 'container_number', 'grand_total_amount', 'amount_paid', 'package_status')
                ->get();

            // Calculate the total amount for the specific container
            $totalAmount = $orders->sum('grand_total_amount');
            $amountPaid = $orders->sum('amount_paid');
            $dueAmount = $totalAmount - $amountPaid;
            $cashAmount = OrderPayment::whereHas('orderPickup', function ($query) use ($containerNumber) {
                $query->where('container_number', $containerNumber);
            })
                ->where('payment_method', 'cash')
                ->sum('deposit');


            $paypalAmount = OrderPayment::whereHas('orderPickup', function ($query) use ($containerNumber) {
                $query->where('container_number', $containerNumber);
            })
                ->where('payment_method', 'paypal')
                ->sum('deposit');



        }



        // Prepare the data with sender's first and last name
        $containerData = $orders->map(function ($order) {
            return [
                'order_number' => $order->order_number,
                'container_number' => $order->container_number,
                'grand_total_amount' => $order->grand_total_amount,
                'amount_paid' => $order->amount_paid,
                'package_status' => $order->package_status,
                'sender_first_name' => $order->sender->first_name ?? '',  // Handling if sender is null
                'sender_last_name' => $order->sender->last_name ?? '',    // Handling if sender is null
            ];
        });

        // Return the total amount and container data in JSON format
        return response()->json([
            'total_amount' => $totalAmount,
            'container_data' => $containerData,
            'cashAmount' => $cashAmount,
            'paypalAmount' => $paypalAmount,
            'amountPaid' => $amountPaid,
            'dueAmount' => $dueAmount,

        ]);
    }


    public function getContainers()
    {
        $containers = OrderPickUp::select('container_number')->distinct()->get();
        return response()->json(['containers' => $containers]);
    }


    public function storeNote(Request $request)
    {
        $request->validate([
            'order_number' => 'required',
            'order_pickup_id' => 'required',
            'add_note' => 'required|string|max:255',
        ]);

        AddNotesByRdDriver::create([
            'order_number' => $request->order_number,
            'order_pickup_id' => $request->order_pickup_id,
            'driver_id' => Auth::id(),
            'add_note' => $request->add_note,
        ]);

        return response()->json(['success' => true, 'message' => 'Note added successfully.']);
    }
}
