@extends('admin.layouts.master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .text-white{
        color:white!important;
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
    <div class="d-flex justify-content-start align-items-center text-white p-3 rounded mt-2" style="background-color:rgb(253, 253, 253)">
        <button class="btn btn-success text-white btn-lg fw-bold px-4 py-2 me-3">
            <i class="fas fa-truck me-2"></i> ADD TRUCK
        </button>
        <button class="btn btn-primary text-white btn-lg fw-bold px-4 py-2">
            <i class="fas fa-sticky-note me-2"></i> ADD A NOTE
        </button>
    </div>

</div>
@endsection
