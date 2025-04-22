@extends('admin.layouts.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .text-white {
        color: white !important;
    }
</style>
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center bg-danger text-white p-3 rounded">
        <h4 class="mb-0" style="color:white!important;font-weight:600;font-size:25px">DOMINICAN REPUBLIC COMPANY EXPENSE REPORT</h4>
        <button class="btn btn-warning text-dark btn-lg fw-bold px-4 py-2">
            <i class="fas fa-bell me-2"></i> REMINDER
        </button>
    </div>
    <!-- Second Line with ADD TRUCK & ADD A NOTE Buttons -->
    <div class="d-flex justify-content-start align-items-center  text-white p-3 rounded mt-2" style="background-color:rgb(253, 253, 253)">
        <button class="btn btn-success text-white btn-lg fw-bold px-4 py-2 me-3" id="addTruckBtn">
            <i class="fas fa-truck me-2"></i> ADD TRUCK
        </button>
        <button class="btn btn-primary text-white btn-lg fw-bold px-4 py-2">
            <i class="fas fa-sticky-note me-2"></i> ADD A NOTE
        </button>
    </div>
    <div class="row mt-4 gap-4">
        <!-- Success Message -->
        <div id="formSuccessMsg" class="alert alert-success mt-3" style="display:none;">
            Truck information submitted successfully!
        </div>
        
        <form class="p-4 rounded shadow-sm" id="addTruckForm"  style="background-color: #ffffff; border: 2px solid #66cdaa; font-family: Arial, sans-serif; display: none;" method="POST" action="{{ route('trucks.store') }}">

            <!-- Truck Name (centered area) -->
            <div class="mb-3 d-flex justify-content-center">
                <!-- You could insert a title or icon here -->
                <h4 class="text-primary">Add New Truck</h4>
            </div>

            <!-- Renewal Info -->
            <div class="row mt-5 mb-4">
                <div class="col-md-4">
                    <label><strong style="color:blue;">Renew Tag:</strong></label>
                    <input type="text" name="renew_tag" class="form-control" id="renewTag">
                </div>
                <div class="col-md-4">
                    <label><strong style="color:blue;">Insurance Renewal:</strong></label>
                    <input type="text" name="insurance_renewal" class="form-control" id="insuranceRenewal">
                </div>
                <div class="col-md-4">
                    <label><strong style="color:blue;">Next Oil Change:</strong></label>
                    <input type="text" name="next_oil_change" class="form-control" id="nextOilChange">
                </div>
            </div>

            <!-- Truck Details Form -->
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="truckName"><strong style="color:blue;">Truck Name</strong></label>
                    <input type="text" name="truck_name" class="form-control" id="truckName">
                </div>
                <div class="col-md-4">
                    <label for="truckBrand"><strong style="color:blue;">Truck Brand</strong></label>
                    <input type="text" name="truck_brand" class="form-control" id="truckBrand">
                </div>
                <div class="col-md-4">
                    <label for="truckModel"><strong style="color:blue;">Truck Model</strong></label>
                    <input type="text" name="truck_model" class="form-control" id="truckModel">
                </div>
                <div class="col-md-4">
                    <label for="color"><strong style="color:blue;">Color</strong></label>
                    <input type="text" name="color" class="form-control" id="color">
                </div>
                <div class="col-md-4">
                    <label for="licensePlate"><strong style="color:blue;">License Plate Number</strong></label>
                    <input type="text" name="license_plate" class="form-control" id="licensePlate">
                </div>
                <div class="col-md-4">
                    <label for="lastVisit"><strong style="color:blue;">Last Visit to Mechanic</strong></label>
                    <input type="text" name="last_mechanic_visit" class="form-control" id="lastVisit">
                </div>
                <div class="col-md-4">
                    <label for="repairsDone"><strong style="color:blue;">What Was Repaired</strong></label>
                    <input type="text" name="repairs_done" class="form-control" id="repairsDone">
                </div>
                <div class="col-md-4">
                    <label for="attachment"><strong style="color:blue;">Attachment</strong></label><br>
                    <input type="file" name="attachment" class="form-control" id="attachment">
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                </div>
            </div>

        </form>

        @foreach ($trucks as $truck)
        <form class="p-4 rounded shadow-sm mb-4 truck-form" style="background-color: #eefaf9; font-family: Arial, sans-serif;" data-form-id="{{ $truck->id }}">

            <!-- Date & Time -->
            <div class="d-flex justify-content-between mb-3">
                <div><strong style="color:blue;font-weight:bold">DATE:</strong> {{ now()->format('m/d/Y') }}</div>
                <div><strong style="color:blue;font-weight:bold">TIME:</strong> {{ now()->format('h:i A') }}</div>
            </div>

            <!-- Truck Name -->
            <div class="mb-3 d-flex justify-content-center">
                <span class="badge text-white px-3 py-2" style="background-color: #139e0f; font-size: 1rem;">
                    TRUCK NAME: {{ strtoupper($truck->truck_name) }}
                </span>
            </div>

            <!-- Renewal Info -->
            <div class="row mt-5 mb-4">
                <div class="col-md-4">
                    <strong style="color:blue;font-weight:bold">RENEW TAG:</strong>
                    <input type="text" class="form-control" value="{{ $truck->renew_tag }}" readonly>
                </div>
                <div class="col-md-4">
                    <strong style="color:blue;font-weight:bold">INSURANCE RENEWAL:</strong>
                    <input type="text" class="form-control" value="{{ $truck->insurance_renewal }}" readonly>
                </div>
                <div class="col-md-4">
                    <strong style="color:blue;font-weight:bold">NEXT OIL CHANGE:</strong>
                    <input type="text" class="form-control" value="{{ $truck->next_oil_change }}" readonly>
                </div>
            </div>

            <!-- Truck Details Form -->
            <div class="row g-3">
                <div class="col-md-3">
                    <label><strong style="color:blue;font-weight:bold">Truck Brand</strong></label>
                    <input type="text" class="form-control" value="{{ $truck->truck_brand }}" readonly>
                </div>
                <div class="col-md-3">
                    <label><strong style="color:blue;font-weight:bold">Truck Model</strong></label>
                    <input type="text" class="form-control" value="{{ $truck->truck_model }}" readonly>
                </div>
                <div class="col-md-3">
                    <label><strong style="color:blue;font-weight:bold">Color</strong></label>
                    <input type="text" class="form-control" value="{{ $truck->color }}" readonly>
                </div>
                <div class="col-md-3">
                    <label><strong style="color:blue;font-weight:bold">License Plate Number</strong></label>
                    <input type="text" class="form-control" value="{{ $truck->license_plate }}" readonly>
                </div>
                <div class="col-md-4">
                    <label><strong style="color:blue;font-weight:bold">Last Visit to Mechanic</strong></label>
                    <input type="text" class="form-control" value="{{ $truck->last_mechanic_visit }}" readonly>
                </div>
                <div class="col-md-4">
                    <label><strong style="color:blue;font-weight:bold">That Was Repaired</strong></label>
                    <input type="text" class="form-control" value="{{ $truck->repairs_done }}" readonly>
                </div>
                <div class="col-md-4">
                    <label><strong style="color:blue;font-weight:bold">Attachment</strong></label><br>
                    @if($truck->attachment)
                        <a href="{{ asset('storage/' . $truck->attachment) }}" target="_blank" title="View Attachment" class="btn btn-light btn-sm mt-1">📎 View Attachment</a>
                    @else
                        <span class="text-muted">No attachment</span>
                    @endif
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <button type="button" class="btn btn-primary me-2 edit-btn" data-form-id="{{ $truck->id }}">Edit</button>
                    <button type="submit" class="btn btn-success me-2 submit-btn" data-form-id="{{ $truck->id }}" style="display: none;">Submit</button>
                    <button class="btn btn-danger">Delete</button>
                </div>
            </div>

        </form>
        @endforeach

    </div>

</div>
@endsection
@push('script')
<script>
    $(document).ready(function() {
        $('#addTruckBtn').on('click', function() {
            $('#addTruckForm').toggle();
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addForm = document.getElementById('addTruckForm');

        const successMsg = document.getElementById('formSuccessMsg');

        // Add submit event listener
        addForm.addEventListener('submit', async function (e) {
            e.preventDefault(); // Prevent default page reload

            const formData = new FormData(addForm);

            // Optional: You can visually disable the button or show a spinner
            const submitBtn = addForm.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerText = 'Submitting...';

            try {
                const response = await fetch(addForm.action, {
                    method: addForm.method,
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                if (response.ok) {
                    // Show success visually
                    addForm.reset();
                    addForm.style.display = 'none';
                    successMsg.style.display = 'block';
                } else {
                    alert("Error submitting the form.");
                }
            } catch (error) {
                console.error("Submit error:", error);
                alert("An error occurred.");
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerText = 'Submit';
            }
        });
    });
</script>

<script>
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const formId = this.getAttribute('data-form-id');
            const form = document.querySelector(`.truck-form[data-form-id="${formId}"]`);
            form.querySelectorAll('input').forEach(input => input.removeAttribute('readonly'));
            this.style.display = 'none';
            form.querySelector('.submit-btn').style.display = 'inline-block';
        });
    });
</script>

<script>
    document.querySelectorAll('.submit-btn').forEach(button => {
        button.addEventListener('click', function () {

            const formId = this.dataset.formId;
            const form = document.querySelector(`.truck-form[data-form-id="${formId}"]`);
            const submitBtn = this;
            const editBtn = form.querySelector('.edit-btn');

            // Create FormData from inputs
            const formData = new FormData();

            form.querySelectorAll('input').forEach(input => {
                const label = input.previousElementSibling?.textContent.trim().toLowerCase().replace(/\s+/g, '_').replace(':', '');
                if (label) {
                    formData.append(label, input.value.trim());
                }
            });

            // Add the truck ID
            formData.append('id', formId);

            // Show loading state
            submitBtn.textContent = 'Submitting...';
            submitBtn.disabled = true;

            fetch("{{ route('trucks.update') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    submitBtn.style.display = 'none';
                    editBtn.style.display = 'inline-block';
                    editBtn.textContent = 'Submitted';

                    // Revert buttons
                    setTimeout(() => {
                        editBtn.textContent = 'Edit';
                        form.querySelectorAll('input').forEach(input => input.setAttribute('readonly', true));
                    }, 2000);

                } else {
                    alert('Failed to update. Please try again.');
                }
            })
            .catch(error => {
                console.error(error);
                alert('An error occurred.');
            })
            .finally(() => {
                submitBtn.textContent = 'Submit';
                submitBtn.disabled = false;
            });
        });
    });
</script>
<script>
    document.querySelectorAll('.btn-danger').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const form = this.closest('.truck-form');
            const formId = form.getAttribute('data-form-id');

            if (confirm('Are you sure you want to delete this truck?')) {
                fetch("{{ route('trucks.destroy') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: formId })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert('Truck deleted successfully.');
                        form.remove();
                    } else {
                        alert('Failed to delete the truck.');
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert('An error occurred while deleting.');
                });
            }
        });
    });
</script>

@endpush