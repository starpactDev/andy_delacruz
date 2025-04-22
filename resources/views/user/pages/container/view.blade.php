@extends('admin.layouts.master')
@section('content')
    <div class="row page-titles">
        <div class="col-md-12 col-12 align-self-center">
            <h3 class="text-themecolor mb-0">Orders List Per Container</h3>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)">Home</a>
                </li>
                <li class="breadcrumb-item active">Orders Per Container </li>
            </ol>
        </div>

    </div>



    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12 col-md-12 mb-5">
                <form method="GET" action="{{ route('user.container.view') }}">
                    <div class="input-group" style="height: 50px;">
                        <span class="input-group-text"><i data-feather="search" class="feather-sm fill-white"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Search by Container Number"
                            value="{{ request('search') }}">
                        <button class="btn btn-light-info text-info font-weight-medium" type="submit">Search</button>
                    </div>
                </form>
                @if (request('search'))
                    <a href="{{ route('user.container.view') }}"
                        class="btn btn-light-danger text-danger font-weight-medium mt-2" type="button">
                        Refresh
                    </a>
                @endif
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title mb-0">View Folder</h4>
                            <div class="ms-auto">
                                <!-- Additional content if needed -->
                            </div>
                        </div>
                        <div class="row mt-3">
                            @foreach ($paginatedContainers as $container)
                                <div class="col-3 mb-3">
                                    <a href="{{ route('user.container.details', ['id' => $container->id]) }}"
                                        class="text-center rounded-3 border py-3 d-block">
                                        <i class="mdi mdi-folder display-6 text-warning"></i>

                                        <span class="text-muted d-block fw-bold">{{ $container->name }}</span>
                                        <span class="d-block text-muted" style="color:rgb(9, 9, 78) !important">Total Orders:
                                            <strong>{{ $container->total_orders }}</strong></span>
                                        <span class="d-block text-muted" style="color:red !important">Pending Orders:
                                            <strong>{{ $container->pending_orders }}</strong></span>
                                        <span class="d-block text-muted" style="color:rgb(28, 148, 12) !important">Completed Orders:
                                            <strong>{{ $container->completed_orders }}</strong></span>

                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <!-- Pagination links -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $paginatedContainers->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection






    @push('script')
    @endpush
