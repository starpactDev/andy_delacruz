<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Sender;
use App\Models\Manager;
use App\Models\Employee;
use App\Models\Receiver;
use App\Models\OrderPickUp;
use Illuminate\Http\Request;
use App\Models\UserDriverInfo;
use Illuminate\Validation\Rule;
use App\Models\PotentialCustomer;
use App\Models\SenderIdentityCard;
use App\Models\SenderPackagesImage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:6',
        ]);

        $sender = Sender::findOrFail($id);
        $sender->password = Hash::make($request->password);
        $sender->save();

        return response()->json(['message' => 'Password updated successfully!']);
    }
    public function index()
    {
        $managers = Manager::all();
        return view('user.pages.customer.index', compact('managers'));
    }

    public function store(Request $request)
    {

        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
                Rule::unique('senders', 'email'), // ✅ Check uniqueness in senders table
            ],
            'password' => 'required|min:6',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'profile_picture' => 'nullable|image|max:2048', // Optional image
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Handle profile image upload
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/upload/images/managers'), $imageName); // Save to 'public/images' directory
        } else {
            $imageName = null; // If no image uploaded
        }
        // Create User as Manager
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'image' => $imageName,
            'type' => 2, // Set as Manager (2)
        ]);

        // Create Manager Details
        Manager::create([
            'user_id' => $user->id,
            'street_address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
        ]);

        return response()->json(['success' => true, 'message' => 'Manager created successfully!']);
    }
    public function update(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($request->user_id, 'id'), // Ignore current user's email
                Rule::unique('senders', 'email'), // Ignore current sender's email
            ],
            'phone' => 'required|string|max:20',
            'street' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:10',
            'profileImage' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Optional image upload
        ]);

        // Find the manager by user_id
        $manager = Manager::where('user_id', $request->user_id)->first();
        $user = $manager->user;
        if (!$manager) {
            return response()->json(['message' => 'Manager not found.'], 404);
        }



        // Handle image upload if a new image is provided

        if ($request->hasFile('profileImage')) {
            // Delete old image if exists
            if ($user->image && file_exists(public_path('admin/upload/images/managers/' . $user->image))) {
                unlink(public_path('admin/upload/images/managers/' . $user->image));
            }

            $image = $request->file('profileImage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/upload/images/managers'), $imageName);
        } else {
            $imageName = $user->image; // Keep the old image if no new image is uploaded
        }

        // Update the manager's information
        $manager->user->name = $request->name;
        $manager->user->email = $request->email;
        $manager->user->phone = $request->phone;
        $manager->user->image = $imageName;
        $manager->street_address = $request->street;
        $manager->city = $request->city;
        $manager->state = $request->state;
        $manager->zip = $request->zip;
        // Save changes
        $manager->user->save();
        $manager->save();

        return response()->json(['message' => 'Manager updated successfully.']);
    }

    public function sender_edit($id)
    {
        $sender = Sender::findOrFail($id);
        return response()->json($sender);
    }
    public function saveSenderDetails(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'senderName' => 'required|string|max:255',
            'senderLastName' => 'required|string|max:255',
            'senderEmail' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'apt' => 'nullable|string|max:10',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'required|string|max:10',
            'senderTel' => 'required|string|max:15',
            'senderCell' => 'nullable|string|max:15',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->toArray(),
            ], 422); // Unprocessable Entity
        }

        // If validation passes, you can process the data (e.g., save to the database)
        // Example:
        $sender = new Sender();
        $sender->first_name = $request->senderName;
        $sender->last_name = $request->senderLastName;
        $sender->email = $request->senderEmail;
        $sender->street_address = $request->address;
        $sender->apt = $request->apt;
        $sender->city = $request->city;
        $sender->state = $request->state;
        $sender->zip = $request->zip;
        $sender->telephone = $request->senderTel;
        $sender->cell = $request->senderCell;
        $sender->password = Hash::make('12345678');
        $sender->save();

        return response()->json([
            'success' => true,
            'sender' => $sender,
            'message' => 'Sender details saved successfully!',
        ]);
    }
    public function sender_update(Request $request, $id)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',  // Make email unique, excluding the current sender
            'telephone' => 'required|string',
            'street_address' => 'required|string',
            'apt' => 'nullable|string',
            'cell' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
        ]);

        // Find the sender by ID and update
        $sender = Sender::findOrFail($id);
        $sender->update($validatedData);

        return response()->json(['message' => 'Sender updated successfully!']);
    }
    public function receiver_update(Request $request, $id)
    {
        // Validate the incoming request with the actual database column names
        $validatedData = $request->validate([
            'recipientName' => 'required|string|max:255',
            'recipientLastName' => 'required|string|max:255',
            'recipientSecondLastName' => 'nullable|string|max:255',
            'recipientNickname' => 'nullable|string|max:255',
            'recipientEmail' => 'required|email',
            'recipientAddress' => 'required|string|max:255',
            'recipientNeighborhood' => 'nullable|string|max:255',
            'recipientCity' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'reference' => 'nullable|string|max:500',
            'recipientTel' => 'required|string|max:20',
            'recipientCell' => 'nullable|string|max:20',
            'recipientWhatsApp' => 'nullable|string|max:20'
        ]);

        // Find the receiver by ID and update using the correct database columns
        $receiver = Receiver::findOrFail($id);
        $receiver->first_name = $validatedData['recipientName'];
        $receiver->sender_id = $request->senderId;
        $receiver->last_name = $validatedData['recipientLastName'];
        $receiver->second_last_name = $validatedData['recipientSecondLastName'];
        $receiver->nickname = $validatedData['recipientNickname'];
        $receiver->email = $validatedData['recipientEmail'];
        $receiver->address = $validatedData['recipientAddress'];
        $receiver->neighborhood = $validatedData['recipientNeighborhood'];
        $receiver->city = $validatedData['recipientCity'];
        $receiver->province = $validatedData['province'];
        $receiver->reference = $validatedData['reference'];
        $receiver->telephone = $validatedData['recipientTel'];
        $receiver->cell = $validatedData['recipientCell'];
        $receiver->whatsapp = $validatedData['recipientWhatsApp'];

        // Save the Receiver instance to the database
        $receiver->save();

        return response()->json(['message' => 'Receiver updated successfully!']);
    }

    public function sender_destroy($id)
    {
        // Find the driver by user ID
        $sender = Sender::findOrFail($id);

        if ($sender) {


            // Delete the driver info
            $sender->delete();
            return response()->json(['message' => 'Client record  deleted successfully']);
        }

        return response()->json(['message' => 'Client record not found'], 404);
    }
    public function saveReceiverDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'recipientName' => 'required|string|max:255',
            'recipientLastName' => 'required|string|max:255',
            'recipientSecondLastName' => 'nullable|string|max:255',
            'recipientNickname' => 'nullable|string|max:255',
            'recipientEmail' => 'required|email|max:255|unique:receivers,email',
            'recipientAddress' => 'required|string|max:255',
            'recipientNeighborhood' => 'nullable|string|max:255',
            'recipientCity' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'reference' => 'nullable|string|max:500',
            'recipientTel' => 'required|string|max:20',
            'recipientCell' => 'nullable|string|max:20',
            'recipientWhatsApp' => 'nullable|string|max:20'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create a new Receiver record
        // Create a new Receiver instance with validated data
        $receiver = new Receiver();
        $receiver->first_name = $request->recipientName;
        $receiver->last_name = $request->recipientLastName;
        $receiver->second_last_name = $request->recipientSecondLastName;
        $receiver->nickname = $request->recipientNickname;
        $receiver->email = $request->recipientEmail;
        $receiver->address = $request->recipientAddress;
        $receiver->neighborhood = $request->recipientNeighborhood;
        $receiver->city = $request->recipientCity;
        $receiver->province = $request->province;
        $receiver->reference = $request->reference;
        $receiver->telephone = $request->recipientTel;
        $receiver->cell = $request->recipientCell;
        $receiver->whatsapp = $request->recipientWhatsApp;
        $receiver->sender_id = $request->sender_id; // Assumes sender_id is the authenticated user

        // Save the Receiver instance to the database
        $receiver->save();
        return response()->json([
            'success' => true,
            'receiver' => $receiver,
            'message' => 'Receiver details saved successfully!',
        ]);

    }
    public function destroy($id)
    {
        // Find the driver by user ID
        $manager = Manager::where('user_id', $id)->first();

        if ($manager) {
            // Get the user ID
            $userId = $manager->user_id;

            // Delete the driver info
            $manager->delete();

            // Delete the corresponding user from the users table
            $user = User::find($userId);
            if ($user) {
                $user->delete();
            }

            return response()->json(['message' => 'Manager  deleted successfully']);
        }

        return response()->json(['message' => 'Manager not found'], 404);
    }
    public function customer_index()
    {
        $senders = Sender::all();
        return view('user.pages.actual_customer.index', compact('senders'));

    }
    public function employee_index()
    {
        // Fetch all employees from the database
        $employees = Employee::all();
        return view('user.pages.employee.index', compact('employees'));
    }
    public function employee_credentials()
    {
        // Fetch all employees from the database
        $managers = Manager::with('user')->get()->map(function ($manager) {
            return [
                'id' => $manager->user_id,
                'full_name' => $manager->user->name,
                'email' => $manager->user->email,
                'phone_number' => $manager->user->phone, // Add phone number
                'address' => "{$manager->street_address}, {$manager->city}, {$manager->state}, {$manager->zip}",
                'job_position' => 'Manager',
                'password' => '******',
            ];
        });

        $drivers = UserDriverInfo::with('user')->get()->map(function ($driver) {
            return [
                'id' => $driver->user_id,
                'full_name' => $driver->user->name,
                'email' => $driver->user->email,
                'phone_number' => $driver->user->phone, // Add phone number
                'address' => "{$driver->street}, {$driver->city}, {$driver->state}, {$driver->zip}",
                'job_position' => $driver->team . ' Driver' ?? 'N/A',
                'password' => '******',
            ];
        });
        $mergedData = $managers->merge($drivers);
        return view('user.pages.employee.credentials', compact('mergedData'));
    }
    public function potential_customer_index()
    {
        $senders = Sender::withCount('orderPickUps')->get();
        $cities = Sender::select('city')->distinct()->get(); // Retrieve distinct cities
        $states = Sender::select('state')->distinct()->get(); // Retrieve distinct states
        return view('user.pages.actual_customer.potential_customer_index', compact('senders', 'cities', 'states'));
    }
    public function potential_customer_add()
    {

        return view('user.pages.actual_customer.potential_customer_add');
    }
    public function potential_customer_view()
    {
        $customers = PotentialCustomer::all(); // Fetch all customer records
        $cities = PotentialCustomer::select('city')->distinct()->get(); // Retrieve distinct cities
        $states = PotentialCustomer::select('state')->distinct()->get(); // Retrieve distinct states
        return view('user.pages.actual_customer.potential_customer_view', compact('customers', 'cities', 'states'));
    }
    public function potential_customer_store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:potential_customers,email',
            'phone_number' => 'required',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create a new PotentialCustomer record
        $customer = PotentialCustomer::create($request->all());
        // Return a success response
        // Return a success response with the customer's id and full name
        return response()->json([
            'success' => 'Customer information saved successfully.',
            'id' => $customer->id,
            'full_name' => $customer->full_name
        ]);
    }

    public function potential_customer_edit($id)
    {
        // Find the potential customer by ID
        $potentialCustomer = PotentialCustomer::find($id);

        if (!$potentialCustomer) {
            // Return a 404 response if not found

            return response()->json(['message' => 'Potential customer not found.'], 404);
        }


        // Return the edit view with the potential customer data
        return response()->json($potentialCustomer);
    }

    public function potential_customer_update(Request $request, $id)
    {

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:potential_customers,email,' . $id,
            'phone_number' => 'required',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Find the potential customer by ID
        $potentialCustomer = PotentialCustomer::find($id);
        if (!$potentialCustomer) {
            return response()->json(['message' => 'Potential customer not found.'], 404);
        }

        // Update the potential customer record
        $potentialCustomer->update($request->all());

        // Return a success response
        return response()->json(['success' => 'Customer information updated successfully.']);
    }




    public function potential_customer_destroy($id)
    {
        // Find the potential customer by ID
        $potentialCustomer = PotentialCustomer::find($id);

        if (!$potentialCustomer) {
            // Return a 404 response if not found
            return response()->json(['message' => 'Potential customer not found.'], 404);
        }

        try {
            // Delete the potential customer
            $potentialCustomer->delete();

            // Return a success response
            return response()->json(['message' => 'Potential customer deleted successfully.'], 200);
        } catch (\Exception $e) {
            // Return a 500 error response if there was an issue
            return response()->json(['message' => 'An error occurred while deleting the potential customer.'], 500);
        }
    }

    public function employee_store(Request $request)
    {

        // Validation rules
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'phone_number' => 'required|string|max:15',
            'job_position' => 'required|string',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip_code' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON
            return response()->json([
                'errors' => $validator->errors()
            ], 422); // 422 Unprocessable Entity
        }

        // If validation passes, create employee
        Employee::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'job_position' => $request->job_position,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
        ]);

        // Return success response
        return response()->json([
            'success' => 'Employee created successfully!'
        ]);
    }

    public function employee_show($id)
    {

        $employee = Employee::find($id);
        return response()->json($employee);
    }

    public function employee_update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'phone_number' => 'required|string|max:15',
            'job_position' => 'required|string',
            'street_address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|numeric',
        ]);

        // Find the employee
        $employee = Employee::findOrFail($id);

        // Update the employee details
        $employee->update($request->all());

        // Return response
        return response()->json(['message' => 'Employee updated successfully']);
    }

    public function employee_destroy($id)
    {
        // Find the employee by ID
        $employee = Employee::findOrFail($id);

        // Delete the employee
        $employee->delete();

        // Return a JSON response
        return response()->json(['message' => 'Employee deleted successfully']);
    }



    public function uploadIdImages(Request $request)
    {


        // Validate the incoming request
        $validatedData = $request->validate([
            'id_front' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'id_back' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'order_pickup_id' => 'required|string',
            'sender_id' => 'required|integer',
        ], [
            'sender_id.required' => 'Please select Sender details first.', // Custom message for sender_id
            'id_front.required' => 'Front ID image is required.',
            'id_back.required' => 'Back ID image is required.',
        ]);

        // Create an instance of the model
        $identityCard = new SenderIdentityCard();

        // Handle the front ID upload
        if ($request->hasFile('id_front')) {
            $frontFile = $request->file('id_front');
            $frontFileName = time() . '_front.' . $frontFile->getClientOriginalExtension();
            $frontFile->move(public_path('uploads/identity_cards'), $frontFileName); // Change the path as needed
            $identityCard->id_front = $frontFileName;
        }

        // Handle the back ID upload
        if ($request->hasFile('id_back')) {
            $backFile = $request->file('id_back');
            $backFileName = time() . '_back.' . $backFile->getClientOriginalExtension();
            $backFile->move(public_path('uploads/identity_cards'), $backFileName); // Change the path as needed
            $identityCard->id_back = $backFileName;
        }

        // Optionally set order_pickup_id
        $identityCard->order_pickup_id = $request->order_pickup_id;
        $identityCard->sender_id = $request->sender_id;

        // Save the model to the database
        $identityCard->save();

        return response()->json(['message' => 'ID images uploaded successfully!']);
    }


    public function uploadPackageImages(Request $request)
    {
        $messages = [

            'sender_id.required' => 'Choose Sender Details First.',
            'order_pickup_id.required' => 'Order Number Missing.Refresh the Page.',

        ];
        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation as needed
            'order_pickup_id' => 'required|string',
            'sender_id' => 'required|integer',
        ], $messages);

        foreach ($request->file('images') as $image) {
            $path = $image->store('uploads/sender_packages_images', 'public'); // Adjust storage path
            // Save the image path to the database
            SenderPackagesImage::create([
                'order_pickup_id' => $request->order_pickup_id,
                'sender_id' => $request->sender_id,
                'image' => $path,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Images uploaded successfully!']);
    }
    public function fetchOrders(Request $request)
    {
        $senderId = $request->input('sender_id');

        // Validate sender_id
        if (!$senderId) {
            return response()->json([
                'success' => false,
                'message' => 'Sender ID is required.',
            ], 400);
        }

        // Retrieve orders for the given sender_id
        $orders = OrderPickUp::where('sender_id', $senderId)->get(['id', 'order_number']);

        // Check if any orders are found
        if ($orders->isEmpty()) {
            return response()->json([
                'success' => true,
                'orders' => [],
            ]);
        }

        return response()->json([
            'success' => true,
            'orders' => $orders,
        ]);
    }



    public function fetchPayments(Request $request)
    {
        $senderId = $request->input('sender_id');

        $orders = OrderPickUp::where('sender_id', $senderId)
            ->with([
                'payments' => function ($query) {
                    $query->select('order_pickup_id', 'deposit', 'payment_method');
                }
            ])
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'order_number' => $order->order_number,
                    'total_amount' => $order->grand_total_amount,
                    'deposits' => $order->payments,
                    'is_paid' => $order->is_completed,
                    'payment_status' => $order->is_completed ? 'Paid' : 'Due',
                ];
            });

        return response()->json(['orders' => $orders]);
    }
    public function fetchReceiverInfo(Request $request)
    {
        $senderId = $request->input('sender_id');

        // Fetch the receiver based on sender_id
        $receiver = Receiver::where('sender_id', $senderId)->first();

        if ($receiver) {
            return response()->json([
                'success' => true,
                'receiver' => $receiver
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Receiver not found'
        ]);
    }

    public function convertToSender($id)
    {
        $potentialCustomer = PotentialCustomer::find($id);

        if (!$potentialCustomer) {
            return response()->json(['error' => 'Potential customer not found'], 404);
        }

        try {
            $senderData = [
                'first_name' => $this->extractFirstName($potentialCustomer->full_name),
                'last_name' => $this->extractLastName($potentialCustomer->full_name),
                'email' => $potentialCustomer->email,
                'street_address' => $potentialCustomer->address,
                'apt' => null,
                'city' => $potentialCustomer->city,
                'state' => $potentialCustomer->state,
                'zip' => $potentialCustomer->zip,
                'telephone' => $potentialCustomer->phone_number,
                'cell' => null,
                'password' => Hash::make('12345678')
            ];

            Sender::create($senderData);

            // Delete the PotentialCustomer
            $potentialCustomer->delete();

            return response()->json(['success' => true]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle duplicate email error
            if ($e->getCode() === '23000') { // SQLSTATE code for integrity constraint violation
                return response()->json(['error' => 'This email already exists in the sender list. Please change the email ID first.'], 400);
            }

            // Handle other query exceptions
            return response()->json(['error' => 'An unexpected error occurred.'], 500);
        }
    }
    private function extractFirstName($fullName)
    {
        return explode(' ', $fullName)[0] ?? $fullName;
    }

    private function extractLastName($fullName)
    {
        $parts = explode(' ', $fullName);
        return count($parts) > 1 ? $parts[count($parts) - 1] : '';
    }
}
