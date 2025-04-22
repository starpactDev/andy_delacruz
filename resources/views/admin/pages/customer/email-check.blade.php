@extends('admin.layouts.master')
@section('content')
<div
class="
  auth-wrapper
  d-flex
  no-block
  justify-content-center
  align-items-center
"
style="
  background: url("../../assets/images/big/auth-bg.jpg) no-repeat center
    center;
"
>
<div class="auth-box p-4 bg-white rounded">
  <div>
    <div class="logo text-center">
      <span class="db"
        >< <img src="{{ url('/') }}/admin/assets/images/embarq_text1.jpg" class="light-logo"
        width="200px" height="50px" alt="homepage" /></span>
      <h5 class="font-weight-medium mb-3 mt-2">Enter the email address of the customer whose dashboard you want to visit</h5>
    </div>
    <!-- Form -->
    <div class="row">
        @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

      <div class="col-12">
        <form class="form-horizontal mt-3" action="{{ route('user.check.sender.email') }}" method="POST">
            @csrf
            <div class="mb-3 row">
                <div class="col-12">
                    <input class="form-control" type="email" name="email" required placeholder="Enter Customer Registered Email" />
                </div>
            </div>
            <div class="text-center">
                <div class="col-xs-12">
                    <button class="btn d-block w-100 btn-info" type="submit">Submit</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
