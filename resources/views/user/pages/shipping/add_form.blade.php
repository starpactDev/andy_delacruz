@extends('admin.layouts.master')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- jQuery UI -->
    <style>
        .id-upload-label {
            margin-right: 40px;
            font-weight: 600;
            font-size: 18px;
            display: block;
            /* Ensure each label takes full width */
            margin-bottom: 20px;
            /* Add space between labels */
        }

        .input-img {
            margin-left: 10px;
            /* Optional: add space between text and image */
        }

        .onoffswitch {
            position: relative;
            width: 90px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
        }

        .onoffswitch-checkbox {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .onoffswitch-label {
            display: block;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid #999999;
            border-radius: 20px;
        }

        .onoffswitch-inner {
            display: block;
            width: 200%;
            margin-left: -100%;
            transition: margin 0.3s ease-in 0s;
        }

        .onoffswitch-inner:before,
        .onoffswitch-inner:after {
            display: block;
            float: left;
            width: 50%;
            height: 30px;
            padding: 0;
            line-height: 30px;
            font-size: 14px;
            color: white;
            font-family: Trebuchet, Arial, sans-serif;
            font-weight: bold;
            box-sizing: border-box;
        }

        .onoffswitch-inner:before {
            content: "ON";
            padding-left: 10px;
            background-color: #40b113;
            color: #FFFFFF;
        }

        .onoffswitch-inner:after {
            content: "OFF";
            padding-right: 10px;
            background-color: #e91818;
            color: #f7ecec;
            text-align: right;
        }

        .onoffswitch-switch {
            display: block;
            width: 18px;
            height: 20px;
            margin: 6px;
            background: #FFFFFF;
            position: absolute;
            top: 0;
            bottom: 0;
            right: 56px;
            border: 2px solid #999999;
            border-radius: 20px;
            transition: all 0.3s ease-in 0s;
        }

        .onoffswitch-checkbox:checked+.onoffswitch-label .onoffswitch-inner {
            margin-left: 0;
        }

        .onoffswitch-checkbox:checked+.onoffswitch-label .onoffswitch-switch {
            right: 14px;
        }

        /* Styling for the image previews */
        .image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .id-image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .id-image-preview img {
            width: 400px;
            height: 200px;
            object-fit: cover;
            /* Ensures the image fits the dimensions without stretching */
            border: 2px solid #ddd;
            border-radius: 10px;
        }

        .image-preview img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            border: 2px solid #ddd;
        }

        .id-image-preview .delete-image-btn {
            background-color: #ff6b6b;
            /* Light red button */
            border: none;
            color: white;
            font-size: 14px;
            font-weight: bold;
            border-radius: 50%;
            cursor: pointer;
            width: 30px;
            height: 30px;
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, transform 0.2s;
        }

        .image-preview .delete-image-btn {
            background-color: #ff6b6b;
            /* Light red button */
            border: none;
            color: white;
            font-size: 14px;
            font-weight: bold;
            border-radius: 50%;
            cursor: pointer;
            width: 30px;
            height: 30px;
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, transform 0.2s;
        }

        .delete-image-btn:hover {
            background-color: #ff4b4b;
            /* Darker red on hover */
            transform: scale(1.1);
            /* Slight zoom effect on hover */
        }

        .image-container {
            position: relative;
            display: inline-block;
        }
    </style>
    <style>
        .blue-bar {
            width: 100%;
            /* Make the bar stretch the full width */
            height: 10px;
            /* Adjust the height of the bar */
            background-color: blue;
            /* Set the color to blue */
            margin-bottom: 40px;
            /* Add some space above and below the bar */
        }

        .d-none {
            display: none !important;
        }

        .card.clickable-card {
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
        }

        .card.clickable-card:hover {
            background-color: #ebfcfd;
            transform: scale(0.98);
            /* Slightly zoom out */
            box-shadow: 0 4px 8px rgba(194, 190, 190, 0.2);
            /* Add shadow */
        }
    </style>
    <style>
        #receiverListSection {
            background-color: #f9f9f9;
            /* Light background */
            padding: 15px;
            border-radius: 8px;
        }

        .receiver-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
    <!-- Optional: Include jQuery UI CSS for better autocomplete styling -->
    <style>
        .search-container {
            background-color: #f8f9fa;
            /* Light background color */
            border-radius: 5px;
            /* Rounded corners */
            padding: 15px;
            /* Padding around the content */
            border: 1px solid #ddd;
            /* Optional border for better visibility */
        }



        .ui-autocomplete {
            max-height: 200px;
            overflow-y: auto;
            /* prevent horizontal scrollbar */
            overflow-x: hidden;
        }
    </style>
    <style>
        /* Style for the autocomplete dropdown container */
        .ui-autocomplete {
            max-height: 200px;
            /* Adjust height as needed */
            overflow-y: auto;
            /* Add scrollbar if needed */
        }

        /* Style for each item in the autocomplete dropdown */
        .ui-menu-item {
            padding: 0;
            /* Remove default padding */
            margin: 0;
            /* Remove default margin */
            border: none;
            /* Remove default border */
        }

        /* Optional: Add a hover effect */
        .ui-menu-item:hover {
            background-color: #f0f0f0;
            /* Light grey background on hover */
            cursor: pointer;
            /* Pointer cursor on hover */
        }
    </style>

    <style>
        .hidden {
            display: none;
        }
    </style>
    <style>
        .underline-row td {
            border-bottom: 2px solid #d8d0d0;
        }
    </style>
    <style>
        .fixed-width {
            width: 300px;
            /* Adjust the width as needed */
            text-align: center;
        }

        .item {

            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
    <style>
        table,
        th,
        td {
            border: none;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="border-bottom title-part-padding">
                    <h4 class="card-title mb-0">Create New Shipping</h4>
                </div>
                <div class="card-body wizard-content">
                    <h6 class="card-subtitle mb-3"></h6>
                    <form action="#" class="tab-wizard wizard-circle">

                        <!-- Step 1 -->
                        <h6>Sender & Recipient Details</h6>
                        <section>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="containerNumber">ORDER NUMBER:</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text fixed-width" id="orderNumberSpan"
                                                style="background-color:#17a8ad;color:white;font-size:20px;">{{ $orderNumber }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="containerNumber">ISSUE DATE:</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text fixed-width" id="basic-addon1"
                                                style="background-color:#ad1794;color:white;font-size:20px;">
                                                {{ \Carbon\Carbon::now()->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="containerNumber">ORDER ID:</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"
                                                style="background-color:#7617ad;color:white;font-size:20px;border-right: none; display:inline-flex;align-items:center;">EPG
                                                -</span>
                                            <input type="text" class="form-control" id="orderNumber" name="orderNumber"
                                                maxlength="4" value="2401"
                                                style="background-color:#7617ad;color:white;font-size:20px;border-left: none; padding: 0.375rem 0.75rem; display:inline-flex; align-items:center;"
                                                aria-describedby="basic-addon1">
                                        </div>

                                    </div>
                                </div> --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="containerNumber">CONTAINER ID:</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text fixed-width" id="container_id"
                                                style="background-color:#17ad30;color:white;font-size:20px;">{{ config('global.currentContainerNumber') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="driver_name">DRIVER PICKUP NAME:</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text fixed-width" id="basic-addon1"
                                                style="background-color:#ff7300;color:white;font-size:20px;">{{ Auth::user()->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h3 class="mb-3 mt-5 fw-bold">Sender Details</h3>
                            <div class="mb-4 d-flex align-items-center justify-content-center">

                                <label class="form-check-label fw-bold mt-2"style="font-size:18px;color:#322fdb"
                                    for="fillFromOld">
                                    Search For Existing Customers
                                </label>
                            </div>
                            <!-- Search Input Field for Existing Customers (Hidden by default) -->
                            <div class="row" id="customerSearchRow">
                                <div class="col-md-12 mb-5 ">
                                    <div class="search-container p-3  rounded" style="background-color: #fafaff">
                                        <label for="customerSearch" class="text-primary fw-bold">Search Customer:</label>

                                        <div class="input-group">
                                            <input type="text" id="customerSearch" class="form-control"
                                                placeholder="Search by customer name, email, or phone">
                                            <span class="input-group-text">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-search feather-sm">
                                                    <circle cx="11" cy="11" r="8"></circle>
                                                    <line x1="21" y1="21" x2="16.65" y2="16.65">
                                                    </line>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blue-bar"></div>
                            <div id="senderDetailsForm">
                                <div class="search-container p-3  rounded mb-3" style="background-color: #fffafe">
                                    <div class="row">
                                        <div id="newSenderDiv"
                                            class="mb-4 d-flex align-items-center justify-content-center">

                                            <label class="form-check-label fw-bold mt-2"style="font-size:18px;color:#322fdb"
                                                for="fillFromOld">
                                                Add New Sender
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="senderName">Sender First Name:</label>
                                                <input type="text" id="senderName" name="senderName"
                                                    class="form-control">
                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="senderLastName">Sender Last Name:</label>
                                                <input type="text" id="senderLastName" name="senderLastName"
                                                    class="form-control">
                                            </div>

                                        </div>



                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">

                                                <div class="mb-3">
                                                    <label for="senderName">Sender Email:</label>
                                                    <input type="email" id="senderEmail" name="senderEmail"
                                                        class="form-control">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="address">Street Address</label>
                                                <input type="text" id="address" name="address"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="apt">Apt #</label>
                                                <input type="text" id="apt" name="apt"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="city">City</label>
                                                <input type="text" id="city" name="city"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="address">State</label>
                                                <input type="text" id="state" name="state"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="address">ZIP</label>
                                                <input type="text" id="zip" name="zip"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="senderTel">Tel:</label>
                                                <input type="text" id="senderTel" name="senderTel"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="senderTel">Cell:</label>
                                                <input type="text" id="senderCell" name="senderCell"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="mb-3 mt-4">
                                                <button type="button" class="btn btn-warning" id="editSenderBtn"
                                                    data-bs-toggle="modal" data-bs-target="#editSenderModal"
                                                    style="width:100%;display:none;">
                                                    Edit Sender Details
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ">
                                            <div class="mb-3 mt-4">
                                                <button type="button" class="btn btn-success" id="saveSenderBtn"
                                                    style="width:100%">
                                                    Save Sender Details
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="blue-bar "></div>
                            <style>
                                /* Optional styling for the container */
                                .mb-4 {
                                    margin-bottom: 16px;
                                }

                                #file-label {
                                    display: inline-flex;
                                    /* Display the label as an inline-flex container */
                                    align-items: center;
                                    /* Align the text and image vertically in the center */
                                    cursor: pointer;
                                    /* Make the label look clickable */
                                    margin-top: 10px;
                                    /* Add some space between input and label */
                                }


                                .input-img {
                                    margin-left: 10px;
                                    /* Add space between "Sender ID Card" text and image */
                                    width: 32px;
                                    /* Control the size of the image */
                                    height: 32px;
                                    /* Keep the image size consistent */
                                }
                            </style>
                            <div class="mb-4">
                                <h4>VALID FORMS OF IDENTIFICATION:</h4>

                                <div class="onoffswitch">
                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"
                                        id="myonoffswitch" tabindex="0">
                                    <label class="onoffswitch-label" for="myonoffswitch">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>

                                <!-- Hidden file input for front ID image upload -->
                                <input type="file" id="front-file-input" accept="image/*" style="display: none;">
                                <!-- Label to upload front ID image -->
                                <label for="front-file-input" id="front-file-label" class="id-upload-label">
                                    U.S. DRIVER'S LICENSE OR ID (FRONT):
                                    <img src="{{ url('/') }}/admin/assets/images/icon/add-photo.png"
                                        alt="Click to upload" title="Click to upload" class="input-img"
                                        id="front-id-image">
                                </label>

                                <!-- Hidden file input for back ID image upload -->
                                <input type="file" id="back-file-input" accept="image/*" style="display: none;">
                                <!-- Label to upload back ID image -->
                                <label for="back-file-input" id="back-file-label" class="id-upload-label">
                                    U.S. DRIVER'S LICENSE OR ID (BACK):
                                    <img src="{{ url('/') }}/admin/assets/images/icon/add-photo.png"
                                        alt="Click to upload" title="Click to upload" class="input-img"
                                        id="back-id-image">
                                </label>

                                <!-- Single preview container for both images -->
                                <div id="image-preview" class="id-image-preview" style="display: flex; gap: 10px;"></div>
                                <div id="id-upload-section" class="text-center mb-4" onclick="idhandleUpload()">
                                    <!-- Placeholder for the image -->
                                    <img src="{{ url('/') }}/admin/assets/images/upload_btn.png" alt="Upload Package"
                                        class="img-fluid" style="width: 50px; height: 50px;" id="upload-id-image" />

                                    <!-- Centered heading -->
                                    <h2 style="font-weight: 600; margin-top: 10px; color:#410e5f" id="upload-id-title">
                                        PHOTOS
                                        UPLOAD</h2>
                                </div>
                            </div>

                            <div class="blue-bar"></div>


                            <!-- Recipient Details Heading -->
                            <h3 class="mb-3 fw-bold">Recipient Details</h3>

                            <!-- Additional Radio Button for Old Receiver (Initially hidden) -->
                            <div id="useOldReceiverSection"
                                class="mb-4 d-flex d-none align-items-center justify-content-center">
                                <input class="form-check-input me-2" type="radio" name="useOldReceiver"
                                    id="useOldReceiver" value="1">

                                <label class="form-check-label  mt-2"
                                    style="color:#322fdb;font-size:22px; font-weight:600" for="useOldReceiver">
                                    VIEW EXISTING RECIPIENTS
                                </label>
                                <br />

                            </div>
                            <div class="blue-bar d-none" id="blue_bar"></div>
                            <div id="receiverListSection" class="d-none mb-3">
                                <h3 class="mb-5 mt-3 fw-bold" style="text-align: center; color:#7617ad">Existing
                                    Recipients
                                </h3>
                                <div id="receiverList" class="row ">
                                    <!-- Receivers will be inserted here by JavaScript -->
                                </div>
                            </div>
                            <div id="receiverDetailsForm">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="recipientName">First Name:</label>
                                            <input type="text" id="recipientName" name="recipientName"
                                                class="form-control">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="mb-3">
                                                <label for="recipientLastName">Last Name:</label>
                                                <input type="text" id="recipientLastName" name="recipientLastName"
                                                    class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="mb-3">
                                                <label for="recipientSecondLastName">Second Last Name:</label>
                                                <input type="text" id="recipientSecondLastName"
                                                    name="recipientSecondLastName" class="form-control">
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="recipientNickname">Nickname:</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Name</span>
                                                <input type="text" id="recipientNickname" name="recipientNickname"
                                                    class="form-control">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="mb-3">
                                                <label for="recipientEmail">Email:</label>
                                                <input type="email" id="recipientEmail" name="recipientEmail"
                                                    class="form-control">

                                            </div>

                                        </div>

                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="recipientAddress"> Address</label>
                                            <input type="text" id="recipientAddress" name="recipientAddress"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="recipientNeighborhood">Neighborhood:</label>
                                            <input type="text" id="recipientNeighborhood" name="recipientNeighborhood"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="recipientCity">City:</label>
                                            <input type="text" id="recipientCity" name="recipientCity"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="province">Province :</label>
                                            <select class="form-select" id="province" name="province">
                                                <option selected disabled>-- Select Province --</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province['name'] }}">{{ $province['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="reference">Reference:</label>
                                            <textarea id="reference" class="form-control" name="reference" rows="4"></textarea>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="recipientTel">Tel:</label>
                                            <input type="text" id="recipientTel" name="recipientTel"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="recipientCell">Cell:</label>
                                            <input type="text" id="recipientCell" name="recipientCell"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="recipientWhatsApp">WhatsApp:</label>
                                            <input type="text" id="recipientWhatsApp" name="recipientWhatsApp"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="mb-3 mt-4">
                                            <button type="button" class="btn btn-warning" id="editReceiverBtn"
                                                data-bs-toggle="modal" data-bs-target="#editReceiverModal"
                                                style="width:100%;display:none">
                                                Edit Receiver Details
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-12 ">
                                        <div class="mb-3 mt-4">
                                            <button type="button" class="btn btn-success" id="saveReceiverBtn"
                                                style="width:100%">
                                                Save Receiver Details
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>




                        </section>

                        <!-- Step 3 -->
                        <h6>Item Descriptions </h6>
                        <section>
                            <h3>Item Descriptions</h3>
                            <div class="row">

                                <table id="itemList" class="table   table-striped">
                                    <thead>
                                        <tr>
                                            <th>Quantity</th>
                                            <th>Item Description</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="item">
                                            <td>
                                                <input type="number" id="quantity" name="quantity[]"
                                                    class="form-control" required>
                                                <small class="error text-danger"></small>
                                            </td>
                                            <td>
                                                <input type="text" id="itemDescription" name="itemDescription[]"
                                                    class="form-control" required>
                                                <small class="error text-danger"></small>
                                            </td>
                                            <td>
                                                <input type="text" id="itemPrice" name="itemPrice[]"
                                                    class="form-control" required>
                                                <small class="error text-danger"></small>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <button type="button" id="addItem" class="btn btn-primary mb-4"
                                    style="font-size: 25px;">Add More Item</button>
                                <div class="blue-bar"></div>

                                <div class="mb-4">
                                    <!-- Hidden file input for package image uploads -->
                                    <input type="file" id="file-input-two" accept="image/*" multiple
                                        style="display: none;">

                                    <div class="onoffswitch">
                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"
                                            id="myonoffswitch-two" tabindex="0">
                                        <label class="onoffswitch-label" for="myonoffswitch-two">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>

                                    <!-- Label to upload package photos -->
                                    <label for="file-input-two" id="file-label"
                                        style="font-weight: 600; font-size: 20px;">
                                        PHOTOS OF PACKAGES TO BE SHIPPED:
                                        <img src="{{ url('/') }}/admin/assets/images/icon/add-photo.png"
                                            alt="Click to upload" title="Click to upload" class="input-img"
                                            id="package-image">
                                    </label>

                                    <!-- Preview of selected images -->
                                    <div id="package-image-preview" class="image-preview"></div>
                                </div>
                                <div id="upload-section" class="text-center mb-4" onclick="handleUpload()">
                                    <!-- Placeholder for the image -->
                                    <img src="{{ url('/') }}/admin/assets/images/upload_btn.png"
                                        alt="Upload Package" class="img-fluid" style="width: 50px; height: 50px;"
                                        id="upload-image" />

                                    <!-- Centered heading -->
                                    <h2 style="font-weight: 600; margin-top: 10px; color:#410e5f" id="upload-title">PHOTOS
                                        UPLOAD</h2>
                                </div>

                                <div class="blue-bar "></div>
                                <h2 style="color:rgb(67, 67, 145);text-align:center;font-weight:700">TOTAL VALUES BY
                                    PACKAGES</h2>
                                <h3 style="color:rgb(16, 16, 82)">Payment Details:</h3>
                                <table class="table">
                                    <tbody>

                                        <tr>
                                            <td><b>Total:</b></td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" id="total" name="total"
                                                        class="form-control">
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td><b>Discount:</b></td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" id="discount" name="discount"
                                                        class="form-control">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Grand Total Amount:</b></td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" id="grandTotal" name="grandTotal"
                                                        class="form-control">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="underline-row">
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Total number of packages to be delivered:</b></td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text">#</span>
                                                    <input type="text" id="total_package" name="total_package"
                                                        class="form-control">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>


                                <div class="blue-bar"></div>



                                <!-- Main Section -->
                                <div class="mb-4">
                                    <!-- Toggle Switch -->
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox"
                                            id="myonoffswitch-three" tabindex="0">
                                        <label class="onoffswitch-label" for="myonoffswitch-three">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                    <input type="hidden" id="label-count-hidden" name="label_count" value="">
                                    <!-- Label to trigger the modal for package label generation -->
                                    <label for="file-input-three" id="file-label"
                                        style="font-weight: 600; font-size: 20px;">
                                        Generate Shipping Label:
                                        <img src="{{ url('/') }}/admin/assets/images/icon/shipping.png"
                                            alt="Click to open modal" title="Click to open modal" class="input-img"
                                            id="shipping-image">
                                    </label>
                                    <!-- Container to display the label count after selection -->
                                    <div id="label-display-container"></div>
                                </div>

                                <!-- Modal for Label Count -->
                                <!-- Modal -->
                                <div class="modal fade" id="labelModal" tabindex="-1" role="dialog"
                                    aria-labelledby="labelModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="labelModalLabel">Print Shipping Labels</h5>
                                                <!-- Close Button -->
                                                <button type="button" class="close" aria-label="Close"
                                                    id="closeModalBtn">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <label for="label-count-input">How many labels need to be printed?</label>
                                                <input type="number" id="label-count-input" class="form-control"
                                                    placeholder="Enter number of labels" min="1">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    id="closeModalBtntwo">Cancel</button>
                                                <button type="button" class="btn btn-primary"
                                                    id="confirm-print-labels">Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>











                            </div>

                        </section>
                        <!-- Step 4 -->

                        <h6>Payment Info</h6>
                        <section>


                            <h5 style="color:rgb(16, 16, 82)">Payment Methods:</h5>
                            <div class="mb-3 row">
                                <label class="col-sm-3 text-end control-label col-form-label"></label>
                                <div class="col-sm-9">
                                    <!-- Cash Payment Method -->
                                    <div class="form-check">
                                        <input type="radio" id="cash" name="paymentMethod" value="cash"
                                            class="form-check-input">
                                        <label class="form-check-label" for="cash">Cash (US)</label>
                                    </div>

                                    <!-- PayPal Payment Method -->
                                    <div class="form-check">
                                        <input type="radio" id="paypal" name="paymentMethod" value="paypal"
                                            class="form-check-input">
                                        <label for="paypal" class="form-check-label">Paypal</label>
                                    </div>

                                    <!-- Venmo Payment Method -->
                                    {{-- <div class="form-check">
                                        <input type="radio" id="venmo" name="paymentMethod" value="venmo"
                                            class="form-check-input">
                                        <label for="zelle" class="form-check-label">Venmo</label>
                                    </div> --}}

                                  
                                    <!-- Amount Input Section for All Payment Methods -->
                                    <div id="amountInputSection" class="mt-2" style="display: none;">
                                        <form>
                                            <div class="input-group">
                                                <input type="number" id="amountConfirmationNumber"
                                                    name="amountConfirmationNumber" placeholder="Enter Amount"
                                                    class="form-control">
                                                <button class="btn btn-light-info text-info font-weight-medium"
                                                    type="button">Enter Amount</button>
                                            </div>
                                        </form>
                                        <input type="hidden" id="venmoNonce" name="venmoNonce">

                                    </div>
                                </div>
                            </div>

                            <h5 style="color:rgb(16, 16, 82)">Payment Location:</h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="paymentLocation">Note: Will the packages be paid for in:</label>
                                        <select id="paymentLocation" name="paymentLocation" class="form-control">
                                            <option value="USA">USA</option>
                                            <option value="DomRep">Dom Rep</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <h4 style="color:rgb(27, 27, 94);font-weight:800">Signature of Sender :</h4>
                                    <div class="input-group mb-3"
                                        style="border: 1px solid #ccc; width: 900px; height: 200px;">
                                        <span id="placeholder-text"
                                            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                                               color: #000; opacity: 0.3; font-size: 18px; pointer-events: none;">
                                            Please use your finger to sign
                                        </span>
                                        <canvas id="signature-pad" width="900" height="200"></canvas>
                                        <img id="signature-image" style="display: none; width: 100%; height: 100%;"
                                            alt="Signature Image">

                                    </div>
                                    <button id="clear-signature" class="mt-2">Clear</button>
                                    <button id="save-signature" type="button" class="mt-2">Save</button>
                                    {{-- <div class="pull-right m-t-30 text-start">
                                        <div class="input-group mb-3">
                                            <input class="form-control" type="file" id="sender_signature"
                                                name="sender_signature">
                                        </div>
                                        <p><span style="font-weight:500;color:red">Signture of Sender</span> </p> --}}




                                </div>
                            </div>
                </div>
            </div>

            </section>

            </form>
            {{-- Modal for edit Sender Details --}}
            <div class="modal fade" id="editSenderModal" tabindex="-1" aria-labelledby="editSenderModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editSenderModalLabel">Edit Sender Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-warning" role="alert">
                                The first name cannot be edited.
                            </div>
                            <form id="editSenderForm">
                                <input type="hidden" id="editSenderId">
                                <div class="mb-3">
                                    <label for="editSenderName">First Name</label>
                                    <input type="text" id="editSenderName" name="editSenderName" class="form-control"
                                        readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="editSenderLastName">Last Name</label>
                                    <input type="text" id="editSenderLastName" name="editSenderLastName"
                                        class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="editSenderEmail">Email</label>
                                    <input type="email" id="editSenderEmail" name="editSenderEmail"
                                        class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="editAddress" class="form-label">Street Address</label>
                                    <input type="text" class="form-control" id="editAddress">
                                </div>
                                <div class="mb-3">
                                    <label for="editApt" class="form-label">Apt</label>
                                    <input type="text" class="form-control" id="editApt">
                                </div>
                                <div class="mb-3">
                                    <label for="editCity" class="form-label">City</label>
                                    <input type="text" class="form-control" id="editCity">
                                </div>
                                <div class="mb-3">
                                    <label for="editState" class="form-label">State</label>
                                    <input type="text" class="form-control" id="editState">
                                </div>
                                <div class="mb-3">
                                    <label for="editZip" class="form-label">Zip</label>
                                    <input type="text" class="form-control" id="editZip">
                                </div>
                                <div class="mb-3">
                                    <label for="editSenderTel" class="form-label">Telephone</label>
                                    <input type="tel" class="form-control" id="editSenderTel">
                                </div>
                                <div class="mb-3">
                                    <label for="editSenderCell" class="form-label">Cell</label>
                                    <input type="tel" class="form-control" id="editSenderCell">
                                </div>
                                <!-- Add other form fields like Address, City, etc. -->
                                <!-- Save Button -->
                                <button type="button" class="btn btn-success" id="saveSenderChanges">Save
                                    Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal for edit Reciver Details --}}
            <div class="modal fade" id="editReceiverModal" tabindex="-1" aria-labelledby="editReceiverModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editReceiverModalLabel">Edit Reciver Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-warning" role="alert">
                                The first name cannot be edited.
                            </div>
                            <form id="editReceiverForm">
                                <div class="row">
                                    <input type="hidden" id="editRecipientId">
                                    <div class="col-md-6">

                                        <div class="mb-3">
                                            <label for="editRecipientName">First Name:</label>
                                            <input type="text" id="editRecipientName" name="editRecipientName"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editRecipientLastName">Last Name:</label>
                                            <input type="text" id="editRecipientLastName" name="editRecipientLastName"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editRecipientSecondLastName">Second Last Name:</label>
                                            <input type="text" id="editRecipientSecondLastName"
                                                name="editRecipientSecondLastName" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editRecipientNickname">Nickname:</label>
                                            <input type="text" id="editRecipientNickname" name="editRecipientNickname"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editRecipientEmail">Email:</label>
                                            <input type="email" id="editRecipientEmail" name="editRecipientEmail"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editRecipientTel">Tel:</label>
                                            <input type="text" id="editRecipientTel" name="editRecipientTel"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editRecipientCell">Cell:</label>
                                            <input type="text" id="editRecipientCell" name="editRecipientCell"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editRecipientWhatsApp">WhatsApp:</label>
                                            <input type="text" id="editRecipientWhatsApp" name="editRecipientWhatsApp"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editRecipientAddress">Address:</label>
                                            <input type="text" id="editRecipientAddress" name="editRecipientAddress"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editRecipientNeighborhood">Neighborhood:</label>
                                            <input type="text" id="editRecipientNeighborhood"
                                                name="editRecipientNeighborhood" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editRecipientCity">City:</label>
                                            <input type="text" id="editRecipientCity" name="editRecipientCity"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="editProvince">Province:</label>
                                            <select class="form-select" id="editProvince" name="editProvince">
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province['name'] }}">{{ $province['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="editReference">Reference:</label>
                                            <textarea id="editReference" name="editReference" class="form-control" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="saveReceiverChanges">Save
                                Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to update totals
            function updateTotals() {
                let totalPrice = 0.0;
                let totalQuantity = 0;

                $('#itemList tbody tr').each(function() {
                    const price = parseFloat($(this).find('input[name="itemPrice[]"]').val()) || 0.0;
                    const quantity = parseInt($(this).find('input[name="quantity[]"]').val()) || 0;

                    totalPrice += price;
                    totalQuantity += quantity;
                });

                $('#total').val(totalPrice.toFixed(2));
                $('#total_package').val(totalQuantity); // Update total quantity
                updateGrandTotal();
            }

            function updateGrandTotal() {
                const total = parseFloat($('#total').val()) || 0.0;
                const discount = parseFloat($('#discount').val()) || 0.0;
                const grandTotal = total - discount;
                $('#grandTotal').val(grandTotal.toFixed(2));
            }

            // Function to add remove buttons to all rows
            function addRemoveButtons() {
                $('#itemList tbody tr').each(function() {
                    if ($(this).find('.removeItem').length === 0) {
                        $(this).append(`
                            <td>
                                <button type="button" class="btn btn-danger removeItem">Remove</button>
                            </td>
                        `);
                    }
                });
            }

            // Add item button click event
            $('#addItem').click(function() {
                let isValid = true;
                $('#itemList tbody tr.item').each(function() {
                    $(this).find('.error').text(''); // Clear previous errors

                    // Check each field
                    $(this).find('input').each(function() {
                        if (!$(this).val()) {
                            $(this).next('.error').text('This field is required');
                            isValid = false;
                        }
                    });
                });

                if (isValid) {
                    let newItem = `
                    <tr class="item">
                        <td>
                            <input type="number" name="quantity[]" class="form-control" required>
                            <small class="error text-danger"></small>
                        </td>
                        <td>
                            <input type="text" name="itemDescription[]" class="form-control" required>
                            <small class="error text-danger"></small>
                        </td>
                        <td>
                            <input type="text" name="itemPrice[]" class="form-control" required>
                            <small class="error text-danger"></small>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger removeItem">Remove</button>
                        </td>
                    </tr>`;
                    $('#itemList tbody').append(newItem);
                    addRemoveButtons(); // Ensure all rows have remove buttons
                }
            });

            $(document).on('click', '.removeItem', function() {
                $(this).closest('tr').remove();
                updateTotals();
            });

            // Event listeners for input changes
            $(document).on('input', 'input[name="itemPrice[]"], input[name="quantity[]"]', function() {
                updateTotals();
            });

            $(document).on('input', '#discount', function() {
                updateGrandTotal();
            });

            // Initial call to set totals and add remove button to the first row
            updateTotals();
            addRemoveButtons();
        });
    </script>
    <script>
        //Basic Example
        $("#example-basic").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            autoFocus: true,
        });

        // Basic Example with form
        var form = $("#example-form");
        form.validate({
            errorPlacement: function errorPlacement(error, element) {
                element.before(error);
            },
            rules: {
                confirm: {
                    equalTo: "#password",
                },
            },
        });
        form.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            onStepChanging: function(event, currentIndex, newIndex) {
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            },
            onFinishing: function(event, currentIndex) {
                form.validate().settings.ignore = ":disabled";
                return form.valid();
            },
            onFinished: function(event, currentIndex) {
                alert("Submitted!");
            },
        });

        // Advance Example

        var form = $("#example-advanced-form").show();

        form
            .steps({
                headerTag: "h3",
                bodyTag: "fieldset",
                transitionEffect: "slideLeft",
                onStepChanging: function(event, currentIndex, newIndex) {
                    // Allways allow previous action even if the current form is not valid!
                    if (currentIndex > newIndex) {
                        return true;
                    }
                    // Forbid next action on "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age-2").val()) < 18) {
                        return false;
                    }
                    // Needed in some cases if the user went back (clean up)
                    if (currentIndex < newIndex) {
                        // To remove error styles
                        form.find(".body:eq(" + newIndex + ") label.error").remove();
                        form
                            .find(".body:eq(" + newIndex + ") .error")
                            .removeClass("error");
                    }
                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                },
                onStepChanged: function(event, currentIndex, priorIndex) {
                    // Used to skip the "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age-2").val()) >= 18) {
                        form.steps("next");
                    }
                    // Used to skip the "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3) {
                        form.steps("previous");
                    }
                },
                onFinishing: function(event, currentIndex) {
                    form.validate().settings.ignore = ":disabled";
                    return form.valid();
                },
                onFinished: function(event, currentIndex) {

                },
            })
            .validate({
                errorPlacement: function errorPlacement(error, element) {
                    element.before(error);
                },
                rules: {
                    confirm: {
                        equalTo: "#password-2",
                    },
                },
            });

        // Dynamic Manipulation
        $("#example-manipulation").steps({
            headerTag: "h3",
            bodyTag: "section",
            enableAllSteps: true,
            enablePagination: false,
        });

        //Vertical Steps

        $("#example-vertical").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            stepsOrientation: "vertical",
        });

        //Custom design form example
        $(".tab-wizard").steps({
            headerTag: "h6",
            bodyTag: "section",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: "Submit",
            },
            onFinished: function(event, currentIndex) {

            },
        });

        var form = $(".validation-wizard").show();

        $(".validation-wizard").steps({
                headerTag: "h6",
                bodyTag: "section",
                transitionEffect: "fade",
                titleTemplate: '<span class="step">#index#</span> #title#',
                labels: {
                    finish: "Submit",
                },
                onStepChanging: function(event, currentIndex, newIndex) {
                    return (
                        currentIndex > newIndex ||
                        (!(3 === newIndex && Number($("#age-2").val()) < 18) &&
                            (currentIndex < newIndex &&
                                (form.find(".body:eq(" + newIndex + ") label.error").remove(),
                                    form
                                    .find(".body:eq(" + newIndex + ") .error")
                                    .removeClass("error")),
                                (form.validate().settings.ignore = ":disabled,:hidden"),
                                form.valid()))
                    );
                },
                onFinishing: function(event, currentIndex) {
                    return (form.validate().settings.ignore = ":disabled"), form.valid();
                },
                onFinished: function(event, currentIndex) {
                    swal(
                        "Form Submitted!",
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed."
                    );
                },
            }),
            $(".validation-wizard").validate({
                ignore: "input[type=hidden]",
                errorClass: "text-danger",
                successClass: "text-success",
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                rules: {
                    email: {
                        email: !0,
                    },
                },
            });
    </script>
    <script src="https://js.braintreegateway.com/web/3.76.0/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.76.0/js/venmo.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle showing the amount input section when a payment method is selected
            $('input[name="paymentMethod"]').on('change', function() {
                var selectedPaymentMethod = $(this).val(); // Get selected payment method

                // Show the amount input field for all payment methods
                $('#amountInputSection').show(); // Show the amount input field
                if (selectedPaymentMethod === 'venmo') {
                    // Trigger Venmo payment flow
                    generateVenmoNonce();
                } else {
                    $('#venmoNonce').val(''); // Clear nonce for other payment methods
                }
                // You can also add custom logic if you want to handle special cases for some payment methods
                // For example, if you don't want to show the amount input for "Pay Later" method:
                // if (selectedPaymentMethod === 'payLater') {
                //     $('#amountInputSection').hide(); // Hide the amount input field for "Pay Later"
                // }
            });

            // Optionally, you can hide the amount input field when the page loads (in case no payment method is selected yet)
            $('#amountInputSection').hide();

            function generateVenmoNonce() {
                let clientToken = '';
alert('hello');
                // Fetch the client token from the server
                $.ajax({
                    url: "{{ route('get.client.token') }}",
                    method: 'GET',
                    async: false,
                    success: function(response) {
                        clientToken = response.clientToken;
                        console.log(clientToken);
                    },
                    error: function(error) {
                        console.error('Error fetching client token:', error);
                        return;
                    }
                });

                // Initialize Braintree client
                braintree.client.create({
                    authorization: clientToken
                }, function(clientErr, clientInstance) {
                    console.log(clientInstance);
                    if (clientErr) {
                        console.error('Error creating Braintree client:', clientErr);
                        return;
                    }

                    // Initialize Venmo instance
                    braintree.venmo.create({
                        client: clientInstance,
                        allowDesktop: true
                    }, function(venmoErr, venmoInstance) {
                        console.log(venmoInstance);
                        if (venmoErr) {
                            console.error('Error creating Venmo instance:', venmoErr);
                            return;
                        }

                        // Start the Venmo flow
                        venmoInstance.tokenize(function(tokenizeErr, payload) {
                            console.log('aaasas');
                            if (tokenizeErr) {
                                console.error('Error tokenizing Venmo:', tokenizeErr);
                                return;
                            }

                            // Store the nonce in the hidden input field
                            $('#venmoNonce').val(payload.nonce);
                            console.log('Venmo nonce generated:', payload.nonce);
                        });
                    });
                });
            }

        });
    </script>
    <script>
        $(document).ready(function() {
            let storedCustomerId = null; // Variable to store the customer ID

            // Show the search field if the radio button is selected
            $('#fillFromOld').change(function() {
                if ($(this).is(':checked')) {
                    $('#customerSearchRow').show();
                    $('#senderDetailsForm').hide(); // Hide the manual sender details form
                }
            });

            function handleAction() {
                // Check if the radio button is selected
                if ($('#useOldReceiver').is(':checked')) {
                    if (storedCustomerId) {
                        // Fetch repeat receivers using the stored customer ID
                        fetchRepeatReceivers(storedCustomerId);
                    } else {
                        console.log('No customer ID stored.');
                    }
                } else {
                    // Optionally handle the case where the radio button is not checked
                    console.log('Radio button not checked, fetchRepeatReceivers not called.');
                }
            }

            // Attach the event handler to the radio button
            $('#useOldReceiver').on('change', handleAction);

            // Function to fetch repeat receivers
            function fetchRepeatReceivers(senderId) {
                $.ajax({
                    url: "{{ route('driver.fetch.repeatReceivers') }}", // Update this route as needed
                    dataType: 'json',
                    data: {
                        sender_id: senderId
                    },
                    success: function(data) {
                        var receiverList = $('#receiverList');
                        receiverList.empty(); // Clear previous list

                        if (data.length) {
                            data.forEach(function(receiver) {
                                var receiverHtml = `
                            <div class="col-md-4 mb-3">
                                <div class="card clickable-card" data-id="${receiver.id}">
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">${receiver.first_name} ${receiver.last_name}</h5>
                                        <p class="card-text">
                                            <strong>Email:</strong> ${receiver.email}<br>
                                            <strong>Tel:</strong> ${receiver.telephone}<br>
                                            <strong>Cell:</strong> ${receiver.cell}<br>
                                            <strong>Address:</strong> ${receiver.address}, ${receiver.neighborhood}, ${receiver.city}, ${receiver.province}
                                        </p>
                                    </div>
                                </div>
                            </div>
                                 `;
                                receiverList.append(receiverHtml);
                            });
                            $('#receiverListSection').removeClass(
                                'd-none'); // Show receiver list section
                            $('#receiverDetailsForm').addClass('d-none');



                        } else {
                            $('#receiverListSection').addClass('d-none'); // Hide if no receivers
                            $('#receiverDetailsForm').removeClass('d-none');
                            // Show SweetAlert when no recipients are found
                            Swal.fire({
                                icon: 'info',
                                title: 'No Recipients Found',
                                text: 'There are no recipients under this customer.',
                                confirmButtonText: 'OK'
                            });
                            $('#useOldReceiver').prop('checked', false);
                        }
                    }
                });
            }

            // Autocomplete search
            $('#customerSearch').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('driver.search.customers') }}", // Using the named route
                        dataType: 'json',
                        data: {
                            query: request.term
                        },
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    label: item.first_name + ' ' + item
                                        .last_name, // Display Name
                                    value: item.first_name + ' ' + item
                                        .last_name, // Name to be filled
                                    customerData: item // Entire customer data
                                };
                            }));
                        }
                    });
                },
                minLength: 2, // Minimum characters to start search
                open: function() {
                    $(this).autocomplete('widget').find('li').each(function() {
                        // Use a custom renderer for each item
                        var item = $(this).data('ui-autocomplete-item');
                        $(this).html(
                            '<div style="padding: 5px; margin: 2px; border-bottom: 1px solid #ddd;">' +
                            '<div style="font-weight: bold; color: blue;">' +
                            item.customerData.first_name + ' ' + item.customerData
                            .last_name + '</div>' +
                            '<div style="font-size: 0.9em;font-weight: bold; color: violet;">' +
                            item.customerData.email + '</div>' +
                            '</div>');
                    });
                },
                select: function(event, ui) {
                    // Store the customer ID
                    storedCustomerId = ui.item.customerData.id;
                    console.log('Customer ID:', storedCustomerId);

                    // Fill the form with the selected customer's details
                    $('#senderName').val(ui.item.customerData.first_name); // Adjusted to the correct ID
                    $('#senderLastName').val(ui.item.customerData
                        .last_name); // Adjusted to the correct ID
                    $('#senderEmail').val(ui.item.customerData.email);
                    $('#address').val(ui.item.customerData.street_address);
                    $('#apt').val(ui.item.customerData.apt);
                    $('#city').val(ui.item.customerData.city);
                    $('#state').val(ui.item.customerData.state);
                    $('#zip').val(ui.item.customerData.zip);
                    $('#senderTel').val(ui.item.customerData.telephone);
                    $('#senderCell').val(ui.item.customerData.cell);

                    // Show the sender details form
                    $('#senderDetailsForm input').prop('readonly', true);
                    $('#senderDetailsForm').show();



                    // Show the Edit button
                    $('#editSenderBtn').show();
                    $('#saveSenderBtn').hide();

                    $('#editSenderId').val(ui.item.customerData.id);
                    $('#editSenderName').val(ui.item.customerData.first_name);
                    $('#editSenderLastName').val(ui.item.customerData.last_name);
                    $('#editSenderEmail').val(ui.item.customerData.email);
                    $('#editAddress').val(ui.item.customerData.street_address);
                    $('#editApt').val(ui.item.customerData.apt);
                    $('#editCity').val(ui.item.customerData.city);
                    $('#editState').val(ui.item.customerData.state);
                    $('#editZip').val(ui.item.customerData.zip);
                    $('#editSenderTel').val(ui.item.customerData.telephone);
                    $('#editSenderCell').val(ui.item.customerData.cell);


                    $("#newSenderDiv").addClass("d-none");
                    $('#useOldReceiverSection').removeClass('d-none');
                    $('#blue_bar').removeClass('d-none');
                    // Fetch repeat receivers if the radio button is checked
                    if ($('#useOldReceiver').is(':checked')) {
                        fetchRepeatReceivers(storedCustomerId);
                    } else {
                        console.log('Radio button not checked, fetchRepeatReceivers not called.');
                    }
                }
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fillFromOldRadio = document.getElementById('fillFromOld');
            const useOldReceiverSection = document.getElementById('useOldReceiverSection');

            // Function to toggle receiver section visibility







        });
    </script>
    <script>
        $(document).on('click', '.clickable-card', function() {
            var receiverId = $(this).data('id');

            if (receiverId) {
                fetchReceiverDetails(receiverId);
            } else {
                console.error('Receiver ID is undefined.');
            }
        });
        // Example function to fetch receiver details
        function fetchReceiverDetails(id) {
            $.ajax({
                url: "{{ route('driver.fetch.receiverDetails') }}",
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(data) {
                    // Populate form fields with receiver details
                    $('#recipientName').val(data.first_name);
                    $('#recipientLastName').val(data.last_name);
                    $('#recipientSecondLastName').val(data.second_last_name);
                    $('#recipientNickname').val(data.nickname);
                    $('#recipientEmail').val(data.email);
                    $('#recipientAddress').val(data.address);
                    $('#recipientNeighborhood').val(data.neighborhood);
                    $('#recipientCity').val(data.city);
                    $('#province').val(data.province); // Assuming state corresponds to province
                    $('#reference').val(data.reference);
                    $('#recipientTel').val(data.telephone);
                    $('#recipientCell').val(data.cell);
                    $('#recipientWhatsApp').val(data.whatsapp);

                    // Set all fields to read-only
                    $('#receiverDetailsForm input, #receiverDetailsForm select, #receiverDetailsForm textarea')
                        .prop('readonly', true);
                    $('#receiverListSection').addClass('d-none'); // Hide if no receivers
                    $('#receiverDetailsForm').removeClass('d-none');
                    $('#editReceiverBtn').show();
                    $('#saveReceiverBtn').hide();
                    $('#editRecipientId').val(data.id);
                    $('#editRecipientName').val(data.first_name);
                    $('#editRecipientLastName').val(data.last_name);
                    $('#editRecipientSecondLastName').val(data.second_last_name);
                    $('#editRecipientNickname').val(data.nickname);
                    $('#editRecipientEmail').val(data.email);
                    $('#editRecipientAddress').val(data.address);
                    $('#editRecipientNeighborhood').val(data.neighborhood);
                    $('#editRecipientCity').val(data.city);
                    $('#editProvince').val(data.province); // Assuming state corresponds to province
                    $('#editReference').val(data.reference);

                    $('#editRecipientTel').val(data.telephone);
                    $('#editRecipientCell').val(data.cell);
                    $('#editRecipientWhatsApp').val(data.whatsapp);

                },
                error: function(xhr) {
                    console.error('Error fetching receiver details:', xhr.responseText);
                }
            });
        }
    </script>
    <script>
        const senderUpdateUrl = "{{ route('driver.sender.update.data', ':id') }}";
        $('#saveSenderChanges').on('click', function() {
            let senderData = {
                first_name: $('#editSenderName').val(),
                last_name: $('#editSenderLastName').val(),
                email: $('#editSenderEmail').val(),
                telephone: $('#editSenderTel').val(),
                street_address: $('#editAddress').val(),
                apt: $('#editApt').val(),
                city: $('#editCity').val(),
                state: $('#editState').val(),
                zip: $('#editZip').val(),
                cell: $('#editSenderCell').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            // Sender ID (assuming you have it stored in a data attribute)
            let senderId = $('#editSenderId').val();


            // Replace ':id' in senderUpdateUrl with the actual senderId
            let url = senderUpdateUrl.replace(':id', senderId);

            // Send AJAX request to update sender details
            $.ajax({
                url: url,
                type: 'POST', // Since you are using POST
                data: senderData,
                success: function(response) {
                    // Update the original form with values from the modal
                    $('#senderName').val($('#editSenderName').val());
                    $('#senderLastName').val($('#editSenderLastName').val());
                    $('#senderEmail').val($('#editSenderEmail').val());
                    $('#address').val($('#editAddress').val());
                    $('#apt').val($('#editApt').val());
                    $('#city').val($('#editCity').val());
                    $('#state').val($('#editState').val());
                    $('#zip').val($('#editZip').val());
                    $('#senderTel').val($('#editSenderTel').val());
                    $('#senderCell').val($('#editSenderCell').val());

                    // Hide the modal
                    $('#editSenderModal').modal('hide');
                    // Show SweetAlert success notification
                    Swal.fire({
                        title: 'Success!',
                        text: 'Sender details edited successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                },
                error: function(error) {
                    console.log("Error updating sender details", error);
                }
            });
        });

        $('#saveReceiverChanges').on('click', function() {
            const updatedData = {
                senderId: $('#editSenderId').val(),
                recipientName: $('#editRecipientName').val(),
                recipientLastName: $('#editRecipientLastName').val(),
                recipientSecondLastName: $('#editRecipientSecondLastName').val(),
                recipientNickname: $('#editRecipientNickname').val(),
                recipientEmail: $('#editRecipientEmail').val(),
                recipientAddress: $('#editRecipientAddress').val(),
                recipientNeighborhood: $('#editRecipientNeighborhood').val(),
                recipientCity: $('#editRecipientCity').val(),
                province: $('#editProvince').val(), // Assuming province corresponds to state
                reference: $('#editReference').val(),
                recipientTel: $('#editRecipientTel').val(),
                recipientCell: $('#editRecipientCell').val(),
                recipientWhatsApp: $('#editRecipientWhatsApp').val(),
                _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
            };

            let receiverId = $('#editRecipientId').val(); // Get receiver ID

            $.ajax({
                url: "{{ route('driver.receiver.update.data', ':id') }}".replace(':id',
                    receiverId), // Use the defined route
                type: 'POST',
                data: updatedData,
                success: function(response) {
                    // Populate original fields with updated values
                    $('#recipientName').val(updatedData.recipientName);
                    $('#recipientLastName').val(updatedData.recipientLastName);
                    $('#recipientSecondLastName').val(updatedData.recipientSecondLastName);
                    $('#recipientNickname').val(updatedData.recipientNickname);
                    $('#recipientEmail').val(updatedData.recipientEmail);
                    $('#recipientAddress').val(updatedData.recipientAddress);
                    $('#recipientNeighborhood').val(updatedData.recipientNeighborhood);
                    $('#recipientCity').val(updatedData.recipientCity);
                    $('#province').val(updatedData.province);
                    $('#reference').val(updatedData.reference);
                    $('#recipientTel').val(updatedData.recipientTel);
                    $('#recipientCell').val(updatedData.recipientCell);
                    $('#recipientWhatsApp').val(updatedData.recipientWhatsApp);

                    // Hide the modal
                    $('#editReceiverModal').modal('hide');

                    // Show SweetAlert success notification
                    Swal.fire({
                        title: 'Success!',
                        text: response.message || 'Receiver details edited successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                },
                error: function(xhr) {
                    // Clear previous validation errors
                    $('.validation-error').remove();

                    // Check for validation errors
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage =
                            'Please correct the following errors:\n'; // Initialize the error message

                        // Iterate through errors and append to the error message
                        $.each(errors, function(key, value) {
                            errorMessage += value[0] + '\n'; // Append each error message
                        });

                        // Display all validation errors in a single alert
                        Swal.fire({
                            title: 'Validation Errors',
                            text: errorMessage,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        console.log("Error updating receiver details", xhr);
                    }
                }

            });
        });
    </script>

    <script>
        let SenderPackageUpload = false;

        document.getElementById('package-image').addEventListener('click', function(event) {
            const switchStateTwo = document.getElementById('myonoffswitch-two').checked;
            if (!switchStateTwo) {
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Switch is Off',
                    text: 'Please switch on to upload the package photos.',
                    confirmButtonText: 'OK'
                });
            }
        });

        // Function to handle image upload and masking for the front ID
        function handleFrontImageUpload(event) {
            const fileInput = event.target;
            const previewContainer = document.getElementById('image-preview');
            const switchState = document.getElementById('myonoffswitch').checked;

            if (!switchState) {
                fileInput.value = ''; // Reset the input
                Swal.fire({
                    icon: 'warning',
                    title: 'Switch is Off',
                    text: 'Please switch on to upload the ID card.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            Array.from(fileInput.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.src = e.target.result;
                    img.onload = function() {
                        const canvas = document.createElement('canvas');
                        const ctx = canvas.getContext('2d');

                        // Set canvas size to match the image dimensions
                        canvas.width = 1920;
                        canvas.height = 1212;

                        // Draw the image onto the canvas
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                        // Define the areas to mask (e.g., ID number, address)
                        const maskAreas = [{
                            x: 641,
                            y: 2,
                            width: 1217,
                            height: 1205
                        }];

                        // Apply black rectangles to mask sensitive areas
                        maskAreas.forEach(area => {
                            ctx.fillStyle = '#69c3de'; // Black color for masking
                            ctx.fillRect(area.x, area.y, area.width, area.height);
                        });

                        // Create a div to hold the canvas (preview)
                        const div = document.createElement('div');
                        div.classList.add('image-container');

                        // Convert canvas to data URL and use it as the image preview
                        div.innerHTML = `
                    <img src="${canvas.toDataURL('image/png')}" alt="Masked Front ID Image" style="max-width: 100%; height: auto;">
                    <button class="delete-image-btn" data-index="${index}">&times;</button>
                `;

                        // Append to preview container
                        previewContainer.appendChild(div);
                        div.querySelector('.delete-image-btn').addEventListener('click', function() {
                            // Remove the image container from the preview
                            previewContainer.removeChild(div);
                            // Reset the file input value
                            fileInput.value = '';
                        });
                    };
                };
                reader.readAsDataURL(file);
            });
        }

        // Function to handle image upload for the back ID
        function handleBackImageUpload(event) {
            const fileInput = event.target;
            const previewContainer = document.getElementById('image-preview');
            const switchState = document.getElementById('myonoffswitch').checked;

            if (!switchState) {
                fileInput.value = ''; // Reset the input
                Swal.fire({
                    icon: 'warning',
                    title: 'Switch is Off',
                    text: 'Please switch on to upload the ID card.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            Array.from(fileInput.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.src = e.target.result;
                    img.onload = function() {
                        const div = document.createElement('div');
                        div.classList.add('image-container');

                        // Convert image to data URL and use it as the image preview
                        div.innerHTML = `
                    <img src="${img.src}" alt="Back ID Image" style="max-width: 100%; height: auto;">
                    <button class="delete-image-btn" data-index="${index}">&times;</button>
                `;

                        // Append to preview container
                        previewContainer.appendChild(div);
                        div.querySelector('.delete-image-btn').addEventListener('click', function() {
                            // Remove the image container from the preview
                            previewContainer.removeChild(div);
                            // Reset the file input value
                            fileInput.value = '';
                        });
                    };
                };
                reader.readAsDataURL(file);
            });
        }

        // Event listeners for both file inputs and image labels
        document.getElementById('front-id-image').addEventListener('click', function(event) {

            const switchState = document.getElementById('myonoffswitch').checked;
            if (!switchState) {
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Switch is Off',
                    text: 'Please switch on to upload the ID card.',
                    confirmButtonText: 'OK'
                });
            }
        });

        document.getElementById('back-id-image').addEventListener('click', function(event) {
            const switchState = document.getElementById('myonoffswitch').checked;
            if (!switchState) {
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Switch is Off',
                    text: 'Please switch on to upload the ID card.',
                    confirmButtonText: 'OK'
                });
            }
        });

        // Add change event listeners to the file inputs
        document.getElementById('front-file-input').addEventListener('change', handleFrontImageUpload);
        document.getElementById('back-file-input').addEventListener('change', handleBackImageUpload);


        // Array to hold selected files
        let selectedFiles = [];

        // Handle file selection
        document.getElementById('file-input-two').addEventListener('change', function(event) {
            const fileInput = event.target;
            const previewContainer = document.getElementById('package-image-preview');
            const switchStateTwo = document.getElementById('myonoffswitch-two').checked;

            if (!switchStateTwo) {
                fileInput.value = ''; // Reset the input
                Swal.fire({
                    icon: 'warning',
                    title: 'Switch is Off',
                    text: 'Please switch on to upload the package photos.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Add new files to the selectedFiles array
            Array.from(fileInput.files).forEach(file => {
                selectedFiles.push(file);
            });

            // Update the file input with the updated selectedFiles array
            updateFileInput();

            // Clear previous previews and display all selected files
            previewContainer.innerHTML = '';
            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.classList.add('image-container');
                    div.innerHTML = `
                <img src="${e.target.result}" alt="Package Image">
                <button class="delete-image-btn" data-index="${index}">&times;</button>
            `;
                    previewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            });

            console.log("File count:", selectedFiles.length); // Log correct file count
        });

        // Handle image deletion
        document.getElementById('package-image-preview').addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-image-btn')) {
                const index = event.target.dataset.index;

                // Remove the file from selectedFiles array
                selectedFiles.splice(index, 1);

                // Update the file input with the updated selectedFiles array
                updateFileInput();

                // Remove the preview element
                event.target.parentElement.remove();

                // Re-index the delete buttons after removal
                document.querySelectorAll('.delete-image-btn').forEach((btn, idx) => {
                    btn.dataset.index = idx;
                });

                console.log("File count after removal:", selectedFiles.length); // Log correct file count
            }
        });

        // Helper function to update file input's FileList from selectedFiles array
        function updateFileInput() {
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            document.getElementById('file-input-two').files = dt.files;
        }

        function handleUpload() {
            const fileInput = document.getElementById('file-input-two');
            const senderId = $('#editSenderId').val();
            const orderNumber = document.getElementById('orderNumberSpan').textContent.trim();
            updateFileInput(); // Make sure this function updates the file input as needed

            // Check if there are images selected
            console.log("Current file count:", fileInput.files.length);
            if (fileInput.files.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Images Selected',
                    text: 'Please select images to upload.',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Ask for confirmation before proceeding with the upload
            Swal.fire({
                title: 'Are you sure?',
                text: "Once uploaded, you won't be able to upload more images for this package.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, upload it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading alert
                    const loadingAlert = Swal.fire({
                        title: 'Uploading...',
                        text: 'Please wait while the images are being uploaded.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading(); // Show the loading spinner
                        }
                    });

                    const formData = new FormData();
                    Array.from(fileInput.files).forEach((file, index) => {
                        formData.append(`images[${index}]`, file); // Use 'images' as the key
                    });


                    formData.append('sender_id', senderId); // Replace with actual sender ID
                    formData.append('order_pickup_id', orderNumber); // Replace with actual sender ID

                    // Perform AJAX upload
                    $.ajax({
                        url: "{{ route('driver.upload.package.images') }}", // Use the named route
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            SenderPackageUpload = true;
                            // Handle success
                            Swal.fire({
                                title: 'Success!',
                                text: 'Photos uploaded successfully!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Change the image and title after confirmation
                                    document.getElementById('upload-image').src =
                                        "{{ url('/') }}/admin/assets/images/tick.png"; // Change to your success image
                                    document.getElementById('upload-title').innerText =
                                        'Uploaded'; // Change the title text

                                    // Disable delete buttons
                                    document.querySelectorAll('.delete-image-btn').forEach(
                                        btn => btn.style
                                        .display = 'none');

                                    // Hide the image source button after upload success
                                    document.getElementById('package-image').style.display =
                                        'none';
                                }
                            });
                        },
                        error: function(xhr) {
                            // Check if the response has validation errors
                            if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                                let errorMessages = '';
                                // Concatenate all error messages
                                for (const messages of Object.values(xhr.responseJSON.errors)) {
                                    errorMessages += messages.join(', ') +
                                        '\n'; // Join messages for each field
                                }

                                // Show all validation messages in SweetAlert
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Upload Failed',
                                    text: errorMessages ||
                                        'An error occurred while uploading images. Please try again.',
                                    confirmButtonText: 'OK'
                                });
                            } else {
                                // Handle generic errors
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Upload Failed',
                                    text: 'An error occurred while uploading images. Please try again.',
                                    confirmButtonText: 'OK'
                                });
                            }
                        }
                    });
                }
            });
        }

        document.getElementById('package-image-preview').addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-image-btn')) {
                const index = parseInt(event.target.dataset.index); // Ensure index is an integer
                const fileInput = document.getElementById('file-input-two');
                const dt = new DataTransfer();

                // Rebuild FileList, excluding the file at the specified index
                Array.from(fileInput.files).forEach((file, i) => {
                    if (i !== index) dt.items.add(file);
                });

                // Update file input's FileList to reflect only remaining files
                fileInput.files = dt.files;

                // Remove the image preview from the DOM
                event.target.parentElement.remove();

                console.log(fileInput.files.length); // Log the updated file count

                // Clear file input if no files remain
                if (fileInput.files.length === 0) {
                    fileInput.value = ''; // Clear the file input
                }

                // Reassign data-index attributes to maintain correct order
                const deleteButtons = document.querySelectorAll('.delete-image-btn');
                deleteButtons.forEach((button, i) => {
                    button.dataset.index = i; // Reassign correct index
                });
            }
        });
    </script>
    {{--  For Sender-ID card --}}
    <script>
        let SenderIdUpload = false;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function idhandleUpload() {

            // Get the order number from the button's data attribute
            const orderNumber = document.getElementById('orderNumberSpan').textContent.trim();

            // Now you can use the orderNumber within the function
            console.log("Order Number:", orderNumber);
            // Get the file inputs and other elements
            const frontFileInput = document.getElementById('front-file-input');
            const backFileInput = document.getElementById('back-file-input');
            const uploadButtonImage = document.getElementById('upload-id-image');
            const uploadTitle = document.getElementById('upload-id-title');
            const senderId = $('#editSenderId').val();
            // Check if files are uploaded
            const frontFileUploaded = frontFileInput.files.length > 0;
            const backFileUploaded = backFileInput.files.length > 0;

            // Create SweetAlert messages based on the upload status
            if (!frontFileUploaded && !backFileUploaded) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Upload Required',
                    text: 'Please upload both the front and back images of your ID.',
                    confirmButtonText: 'OK'
                });
            } else if (!frontFileUploaded) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Front Image Missing',
                    text: 'Please upload the front image of your ID first.',
                    confirmButtonText: 'OK'
                });
            } else if (!backFileUploaded) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Back Image Missing',
                    text: 'Please upload the back image of your ID first.',
                    confirmButtonText: 'OK'
                });
            } else {
                // Both images are uploaded
                Swal.fire({
                    icon: 'info',
                    title: 'Confirm Upload',
                    text: 'Once you upload, you will not be able to change the images. Do you want to proceed?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, upload',
                    cancelButtonText: 'No, cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading alert
                        const loadingAlert = Swal.fire({
                            title: 'Uploading...',
                            text: 'Please wait while the images are being uploaded.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading(); // Show the loading spinner
                            }
                        });

                        // Prepare FormData for AJAX request
                        const formData = new FormData();
                        formData.append('id_front', frontFileInput.files[0]);
                        formData.append('id_back', backFileInput.files[0]);
                        formData.append('sender_id', senderId);
                        formData.append('order_pickup_id', orderNumber);

                        // Make the AJAX request to upload the files
                        $.ajax({
                            url: '{{ route('driver.upload.id.images') }}', // Use your route name
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                SenderIdUpload = true;
                                loadingAlert
                                    .close(); // Close the loading alert once the upload is successful
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Upload Successful',
                                    text: 'Both images have been uploaded successfully!',
                                    confirmButtonText: 'OK'
                                }).then((confirmResult) => {
                                    if (confirmResult.isConfirmed) {
                                        // Change upload button image and title
                                        uploadButtonImage.src =
                                            "{{ url('/') }}/admin/assets/images/tick.png"; // Change image to tick
                                        uploadTitle.textContent =
                                            'Uploaded'; // Change title text

                                        // Hide the image source buttons
                                        document.getElementById('front-file-label').style
                                            .display = 'none';
                                        document.getElementById('back-file-label').style
                                            .display = 'none';

                                        // Optionally, remove delete buttons
                                        const deleteButtons = document.querySelectorAll(
                                            '.delete-image-btn');
                                        deleteButtons.forEach(button => button.remove());
                                    }
                                });
                            },
                            error: function(xhr) {
                                loadingAlert.close(); // Close the loading alert on error
                                if (xhr.status === 422) {
                                    let errors = xhr.responseJSON.errors;
                                    let errorMsg = '';
                                    $.each(errors, function(key, value) {
                                        errorMsg += value[0] + '\n';
                                    });
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Upload Failed',
                                        text: errorMsg,
                                        confirmButtonText: 'OK'
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Upload Failed',
                                        text: 'An error occurred. Please try again.',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            }
                        });
                    }
                });
            }
        }
    </script>

    {{-- For Signature --}}
    <script>
        // Define signature_image globally
        let signature_image = false; // Default value is false

        document.addEventListener("DOMContentLoaded", function() {
            const canvas = document.getElementById("signature-pad");
            const signatureImage = document.getElementById('signature-image');
            const saveButton = document.getElementById('save-signature');
            const clearButton = document.getElementById('clear-signature');
            const signaturePad = new SignaturePad(canvas);
            const orderNumber = document.getElementById('orderNumberSpan').textContent
                .trim(); // Get the order number

            // Clear signature button
            clearButton.addEventListener("click", function() {
                signaturePad.clear();
            });

            // Save signature button with confirmation
            saveButton.addEventListener('click', () => {
                event.preventDefault(); // Prevent the default form submission
                const senderId = $('#editSenderId').val(); // Get the sender_id

                // Check if sender_id has a value
                if (!senderId) {
                    // If sender_id is empty, show a SweetAlert warning
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Please choose sender details first.'
                    });
                    return; // Exit the function to prevent AJAX call
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to change this after saving!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, save it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading alert
                        Swal.fire({
                            title: 'Saving...',
                            text: 'Please wait while your signature is being saved.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        // Convert canvas to data URL
                        const signatureDataURL = canvas.toDataURL('image/png');

                        // Send the signature data, sender_id, and order_number to the server
                        fetch('{{ route('save-signature') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({
                                    signature: signatureDataURL,
                                    order_pickup_id: orderNumber, // Include the order number
                                    sender_id: senderId // Include the sender ID
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                signature_image = true;
                                Swal.fire('Saved!', 'Your signature has been saved.',
                                    'success');

                                // Display the signature image and hide the canvas
                                signatureImage.src = signatureDataURL;
                                signatureImage.style.display = 'block';
                                canvas.style.display = 'none';

                                // Hide buttons after saving
                                saveButton.style.display = 'none';
                                clearButton.style.display = 'none';
                            })
                            .catch(error => {
                                Swal.fire('Error!', 'There was an error saving your signature.',
                                    'error');
                                console.error('Error:', error);
                            });
                    }
                });
            });
        });
    </script>

    {{-- for sender save details step --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const saveSenderBtn = document.getElementById("saveSenderBtn");

            saveSenderBtn.addEventListener("click", function() {
                // Clear previous error messages
                clearErrorMessages();

                // Collect form data
                const data = {
                    senderName: document.getElementById("senderName").value,
                    senderLastName: document.getElementById("senderLastName").value,
                    senderEmail: document.getElementById("senderEmail").value,
                    address: document.getElementById("address").value,
                    apt: document.getElementById("apt").value,
                    city: document.getElementById("city").value,
                    state: document.getElementById("state").value,
                    zip: document.getElementById("zip").value,
                    senderTel: document.getElementById("senderTel").value,
                    senderCell: document.getElementById("senderCell").value,
                };

                $.ajax({
                    url: "{{ route('driver.save.sender.details') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        ...data
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            // Hide the Save Sender Details button
                            saveSenderBtn.style.display = "none";
                            $('#editSenderBtn').show();
                            $('#editSenderId').val(response.sender.id);
                            $('#editSenderName').val(response.sender.first_name);
                            $('#editSenderLastName').val(response.sender.last_name);
                            $('#editSenderEmail').val(response.sender.email);
                            $('#editAddress').val(response.sender.street_address);
                            $('#editApt').val(response.sender.apt);
                            $('#editCity').val(response.sender.city);
                            $('#editState').val(response.sender.state);
                            $('#editZip').val(response.sender.zip);
                            $('#editSenderTel').val(response.sender.telephone);
                            $('#editSenderCell').val(response.sender.cell);
                            // Make all input fields read-only
                            inputFields.forEach(field => {
                                field.readOnly = true;
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            // Display validation errors under respective fields
                            for (let field in errors) {
                                const fieldElement = document.getElementById(field);
                                if (fieldElement) {
                                    const errorMessage = document.createElement("div");
                                    errorMessage.className =
                                        "text-danger"; // Bootstrap class for error messages
                                    errorMessage.innerText = errors[field][
                                        0
                                    ]; // Get the first error message
                                    fieldElement.parentElement.appendChild(errorMessage);
                                }
                            }
                        } else {
                            alert("An error occurred while saving the data.");
                        }
                    }
                });
            });

            function clearErrorMessages() {
                // Remove all previous error messages
                const errorMessages = document.querySelectorAll('.text-danger');
                errorMessages.forEach(msg => msg.remove());
            }
        });
    </script>
    {{-- for receiver save details step --}}
    <script>
        $(document).ready(function() {


            $('#saveReceiverBtn').on('click', function() {
                // Check if sender_id has a value
                let senderId = $('#editSenderId').val();

                if (!senderId) {
                    // If sender_id is empty, show a SweetAlert warning
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: 'Please choose sender details first.'
                    });
                    return; // Exit the function to prevent AJAX call
                }

                $.ajax({
                    url: "{{ route('driver.receiver.save') }}", // Pass the route name
                    type: "POST",
                    data: {
                        sender_id: $('#editSenderId').val(), // Assuming sender_id input exists
                        recipientName: $('#recipientName').val(),
                        recipientLastName: $('#recipientLastName').val(),
                        recipientSecondLastName: $('#recipientSecondLastName').val(),
                        recipientNickname: $('#recipientNickname').val(),
                        recipientEmail: $('#recipientEmail').val(),
                        recipientAddress: $('#recipientAddress').val(),
                        recipientNeighborhood: $('#recipientNeighborhood').val(),
                        recipientCity: $('#recipientCity').val(),
                        province: $('#province').val(),
                        reference: $('#reference').val(),
                        recipientTel: $('#recipientTel').val(),
                        recipientCell: $('#recipientCell').val(),
                        recipientWhatsApp: $('#recipientWhatsApp').val(),
                        _token: "{{ csrf_token() }}" // Include CSRF token for Laravel
                    },
                    success: function(response) {
                        if (response.success) {
                            // Clear all validation messages on success
                            $('.text-danger').remove();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Receiver details saved successfully!',
                            });
                            $('#saveReceiverBtn').hide();
                            $('#editReceiverBtn').show();
                            $('#editRecipientId').val(response.receiver.id);
                            $('#editRecipientName').val(response.receiver.first_name);
                            $('#editRecipientLastName').val(response.receiver.last_name);
                            $('#editRecipientSecondLastName').val(response.receiver
                                .second_last_name);
                            $('#editRecipientNickname').val(response.receiver.nickname);
                            $('#editRecipientEmail').val(response.receiver.email);
                            $('#editRecipientAddress').val(response.receiver.address);
                            $('#editRecipientNeighborhood').val(response.receiver.neighborhood);
                            $('#editRecipientCity').val(response.receiver.city);
                            $('#editProvince').val(response.receiver
                                .province); // Assuming state corresponds to province
                            $('#editReference').val(response.receiver.reference);
                            $('#editRecipientTel').val(response.receiver.telephone);
                            $('#editRecipientCell').val(response.receiver.cell);
                            $('#editRecipientWhatsApp').val(response.receiver.whatsapp);
                        }
                    },
                    error: function(response) {
                        // Clear any previous errors
                        $('.text-danger').remove();

                        if (response.status === 422) {
                            // Display validation errors
                            let errors = response.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                let inputField = $('#' + field);
                                inputField.after('<div class="text-danger">' + messages[
                                    0] + '</div>');
                            });
                        }
                    }
                });
            });
        });
    </script>


    {{-- for shipping label generation details step --}}
    <script>
        document.getElementById('shipping-image').addEventListener('click', function(event) {
            const switchState = document.getElementById('myonoffswitch-three').checked;

            if (!switchState) {
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Switch is Off',
                    text: 'Please switch on to generate Shipping Label.',
                    confirmButtonText: 'OK'
                });
            } else {
                // Show the modal when the switch is on
                $('#labelModal').modal('show');
            }
        });

        // Handle the confirmation button click in the modal
        document.getElementById('confirm-print-labels').addEventListener('click', function() {
            const labelCount = document.getElementById('label-count-input').value;

            if (labelCount && labelCount > 0) {
                // Close the modal and proceed with label generation logic
                $('#labelModal').modal('hide');
                // Implement label generation logic here


                // Set the label count value in the hidden input field
                document.getElementById('label-count-hidden').value = labelCount;
                // Append the label count to the view
                const labelDisplayContainer = document.getElementById('label-display-container');
                const labelText = document.createElement('h6');
                labelText.textContent = `Number of labels to be generated: ${labelCount}`;
                labelDisplayContainer.innerHTML = ''; // Clear any previous label count
                labelDisplayContainer.appendChild(labelText);

                Swal.fire({
                    icon: 'success',
                    title: 'Labels Generated',
                    text: `You have requested ${labelCount} labels.`,
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Input',
                    text: 'Please enter a valid number of labels to print.',
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>



    {{-- for final submission details step --}}
    <script>
        let itemsSubmitted = false;

        async function gatherAndSubmitData() {
            console.log('item function called');
            let items = [];
            let order_number = document.getElementById('orderNumberSpan').textContent;

            $('#itemList tbody tr').each(function() {
                let quantity = $(this).find('input[name="quantity[]"]').val();
                let itemDescription = $(this).find('input[name="itemDescription[]"]').val();
                let itemPrice = $(this).find('input[name="itemPrice[]"]').val();

                if (quantity && itemDescription && itemPrice) {
                    items.push({
                        quantity: quantity,
                        itemDescription: itemDescription,
                        itemPrice: itemPrice
                    });
                }
            });

            if (items.length > 0) {
                try {
                    // Send data to the server via AJAX
                    await $.ajax({
                        url: "{{ route('driver.store.items') }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}', // Include CSRF token
                            items: items,
                            order_pickup_id: order_number
                        },
                        success: function(response) {
                            itemsSubmitted = true;
                            console.log('Items submitted successfully:', itemsSubmitted);
                            // Optionally, clear the table after saving
                        },
                        error: function(xhr) {
                            itemsSubmitted = false;
                            console.log('Error status:', xhr.status);
                            console.log('Error status text:', xhr.statusText);
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                console.log('Validation errors:');
                                $.each(xhr.responseJSON.errors, function(field, messages) {
                                    console.log(field + ': ' + messages.join(', '));
                                });
                            } else {
                                console.log('An error occurred:', xhr.responseText);
                            }
                        }
                    });
                } catch (error) {
                    console.error('AJAX request failed:', error);
                    itemsSubmitted = false;
                }
            } else {
                itemsSubmitted = false;
                console.log('No items to submit.');
            }
        }
        $(document).ready(function() {
            // Use event delegation to bind the click event to dynamically created elements
            $(document).on("click", "a[href='#finish']", function(event) {
                event.preventDefault(); // Prevents the default anchor behavior

                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to submit this form?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, submit",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        let sender_id = $('#editSenderId').val();
                        let receiver_id = $('#editRecipientId').val();
                        let label_count = $('#label-count-hidden').val();
                        let order_number = document.getElementById('orderNumberSpan').textContent
                            .trim();
                        let currentDate = new Date();
                        let issue_date = currentDate.toISOString().split('T')[
                            0]; // Formats as 'YYYY-MM-DD'
                        let container_number = document.getElementById('container_id').textContent
                            .trim();

                        let driver_pickup_name = @json(Auth::user()->name);
                        let driver_id = @json(Auth::user()->id);

                        let total = parseFloat($('#total').val()) || 0;
                        let discount = parseFloat($('#discount').val()) || 0;
                        let grandTotal = parseFloat($('#grandTotal').val()) || 0;
                        let totalPackages = parseInt($('#total_package').val()) || 0;

                        let amountConfirmationNumber = $('#amountConfirmationNumber').val().trim();
                        let paymentLocation = $('#paymentLocation').val();

                        // Get the selected payment method
                        let paymentMethod = $('input[name="paymentMethod"]:checked')
                            .val(); // Get the value of the checked radio button (cash or other)

                        // Array to store names of missing fields
                        let missingFields = [];

                        // Check each field and add to missingFields if empty
                        if (!sender_id) missingFields.push('Sender Details');
                        if (!receiver_id) missingFields.push('Receiver Details');
                        const switchStateThree = document.getElementById('myonoffswitch-three')
                            .checked;

                        if (switchStateThree && !label_count) missingFields.push(
                            'Shipping Label Count');
                        if (!order_number) missingFields.push('Order Number');
                        if (!container_number) missingFields.push('Container Number');
                        if (!driver_pickup_name) missingFields.push('Driver Pickup Name');
                        if (total === 0) missingFields.push('Total');
                        if (grandTotal === 0) missingFields.push('Grand Total');
                        if (totalPackages === 0) missingFields.push(
                            'Total Packages to be delivered');
                        if (!amountConfirmationNumber) missingFields.push(
                            'Amount Confirmation Number');
                        if (!paymentLocation) missingFields.push('Payment Location');
                        if (!paymentMethod) missingFields.push('Payment Method');

                        // If there are missing fields, show an alert with the list
                        if (missingFields.length > 0) {
                            Swal.fire({
                                title: 'Missing Information',
                                text: 'Please complete the following fields: ' +
                                    missingFields.join(', '),
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            return; // Stop further execution if there are missing fields
                        }

                        // Checking if the signature image is set
                        const switchInput = document.getElementById("myonoffswitch");
                        if (switchInput.checked && !SenderIdUpload) {
                            Swal.fire('Error', 'Please upload Sender Id image before proceeding.',
                                'error');
                            return; // Stop the execution if the Id is not provided
                        }
                        const switchStateTwo = document.getElementById('myonoffswitch-two').checked;
                        if (switchStateTwo && !SenderPackageUpload) {
                            Swal.fire('Error',
                                'Please upload Sender Package images before proceeding.',
                                'error');
                            return; // Stop the execution if the Package Images is not provided
                        }
                        if (!signature_image) {
                            Swal.fire('Error', 'Please provide a signature before proceeding.',
                                'error');
                            return; // Stop the execution if the signature is not provided
                        }
                        if (amountConfirmationNumber > grandTotal) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Excess Payment',
                                text: 'You need to pay only the total amount. Please enter a valid amount.',
                            });
                            return;
                        }
                        const paymentNonce = $('#venmoNonce').val();

                        if (paymentMethod === 'venmo' && !paymentNonce) {
                            Swal.fire('Error', 'Venmo payment nonce is missing.', 'error');
                            return;
                        }
                        // Call the function to gather and submit the data
                        gatherAndSubmitData().then(() => {
                            if (!itemsSubmitted) {
                                Swal.fire('Error',
                                    'An error occurred. Please ensure all items-descriptions are filled out correctly before proceeding',
                                    'error');
                                return;
                            }

                            // Prepare the data to be sent to the backend
                            let formData = {
                                sender_id: sender_id,
                                receiver_id: receiver_id,
                                label_count: label_count,
                                order_number: order_number,
                                issue_date: issue_date,
                                container_number: container_number,
                                driver_pickup_name: driver_pickup_name,
                                driver_id: driver_id,
                                total: total,
                                discount: discount,
                                grand_total_amount: grandTotal,
                                total_no_packages: totalPackages,
                                amount_paid: amountConfirmationNumber,
                                payment_location: paymentLocation,
                                payment_method: paymentMethod // Add the selected payment method to the data
                            };
                            // Disable the button to prevent multiple submissions
                            $(this).prop('disabled', true);
                            // Send the data to the server using AJAX

                            $.ajax({
                                url: "{{ route('driver.store.all') }}", // Use the Laravel route name here
                                type: "POST",
                                data: formData,
                                beforeSend: function() {
                                    // Show SweetAlert loading spinner before the request starts
                                    Swal.fire({
                                        title: 'Processing...',
                                        text: 'Please wait while we store your data.',
                                        didOpen: () => {
                                            Swal
                                                .showLoading(); // Show loading spinner
                                        },
                                        allowOutsideClick: false, // Prevent closing the modal by clicking outside
                                        showConfirmButton: false // Hide confirm button while loading
                                    });
                                },
                                success: function(response) {
                                    if (response.status === 'success') {
                                        Swal.fire('Success', response.message,
                                            'success');
                                        // Redirect to the preview page with the order_number
                                        window.location.href =
                                            "{{ route('driver.invoice.index', ['order_number' => '__order_number__']) }}"
                                            .replace('__order_number__',
                                                response.order_number);
                                    } else if (response.status ===
                                        'paypal_approval_link') {
                                        console.log(response.approval_url);
                                        Swal.fire('Redirecting to PayPal',
                                            'Please complete your payment.',
                                            'info').then(() => {
                                            // Redirect user to PayPal approval link
                                            window.location.href =
                                                response.approval_url;
                                        });
                                    } else if (response.status ===
                                        'validation_error') {
                                        let validationErrors = response.errors;
                                        let errorMessage =
                                            'Please correct the following errors:\n\n';
                                        $.each(validationErrors, function(field,
                                            messages) {
                                            errorMessage += field +
                                                ': ' + messages.join(
                                                    ', ') + '\n';
                                        });
                                        Swal.fire('Validation Error',
                                            errorMessage, 'error');
                                    } else {
                                        Swal.fire('Error', response.message,
                                            'error');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    let errorMessage = xhr.responseJSON
                                        ?.message ||
                                        'An unexpected error occurred';
                                    Swal.fire('Error', errorMessage, 'error');
                                }
                            });
                        });
                    }
                });
            });
        });
    </script>


    <!-- Custom jQuery to Hide Modal -->
    <script>
        // Close modal when the close button is clicked
        $('#closeModalBtntwo').click(function() {
            $('#labelModal').modal('hide');
        });
        $('#closeModalBtn').click(function() {
            $('#labelModal').modal('hide');
        });
    </script>




    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                });
            });
        </script>
    @endif
@endpush
