@extends('admin.layouts.master')

@section('content')
    @php
        $isClientListOff = \Illuminate\Support\Facades\DB::table('manage_permission_for_managers')
            ->where('key', 'docs_list')
            ->where('value', 'off')

            ->exists();
            $auth = Auth::user()->type;

    @endphp
    <div class="container-fluid">
        @if ($auth == 0 || ($auth == 2 && !$isClientListOff))
            <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
                <div class="card-body px-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-medium  mb-0">IDENTIFICATION UPLOADED BY USA DRIVER</h4>
                            <p class="card-subtitle mb-3">
                                VALID FORMS OF IDENTIFICATION:
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row el-element-overlay">
                @if ($senderIdentityCard)
                    @if ($senderIdentityCard->id_front)
                        <div class="col-md-4">
                            <div class="card overflow-hidden">
                                <div class="el-card-item pb-3">
                                    <div
                                        class="
                el-card-avatar
                mb-3
                el-overlay-1
                w-100
                overflow-hidden
                position-relative
                text-center
              ">
                                        <a class="image-popup-vertical-fit"
                                            href="{{ url('uploads/identity_cards/' . $senderIdentityCard->id_front) }}">
                                            <img src="{{ url('uploads/identity_cards/' . $senderIdentityCard->id_front) }}"
                                                class="d-block position-relative w-100" alt="user">
                                        </a>
                                    </div>
                                    <div class="el-card-content text-center">
                                        <h4 class="card-title">ID FRONT</h4>
                                        <p class="card-subtitle">U.S. DRIVER'S LICENSE OR ID (FRONT)</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif

                    @if ($senderIdentityCard->id_back)
                        <div class="col-md-4">
                            <div class="card overflow-hidden">
                                <div class="el-card-item pb-3">
                                    <div
                                        class="
                el-card-avatar
                mb-3
                el-overlay-1
                w-100
                overflow-hidden
                position-relative
                text-center
              ">
                                        <a class="image-popup-vertical-fit"
                                            href="{{ url('uploads/identity_cards/' . $senderIdentityCard->id_back) }}">
                                            <img src="{{ url('uploads/identity_cards/' . $senderIdentityCard->id_back) }}"
                                                class="d-block position-relative w-100" alt="user">
                                        </a>
                                    </div>
                                    <div class="el-card-content text-center">
                                        <h4 class="card-title">ID BACK</h4>
                                        <p class="card-subtitle">U.S. DRIVER'S LICENSE OR ID (BACK)</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif
                @else
                    <h5 class="text-center" style="color: red; font-size:24px"> Nothing Uploaded in Sender Identity</h5>
                @endif


            </div>
            <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
                <div class="card-body px-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-medium  mb-0">PACKAGES</h4>
                            <p class="card-subtitle mb-3">
                                PHOTOS OF PACKAGES TO BE SHIPPED:
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row el-element-overlay">
                @if ($packageImages)
                    @if ($packageImages->isNotEmpty())
                        @foreach ($packageImages as $packageImage)
                            <div class="col-md-4">
                                <div class="card overflow-hidden">
                                    <div class="el-card-item pb-3">
                                        <div
                                            class="
                el-card-avatar
                mb-3
                el-overlay-1
                w-100
                overflow-hidden
                position-relative
                text-center
              ">
                                            <a class="image-popup-vertical-fit" href="{{ url($packageImage->image) }}">
                                                <img src="{{ url($packageImage->image) }}"
                                                    class="d-block position-relative w-100" style="height:300px"
                                                    alt="user">
                                            </a>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @endif
                @else
                    <h5 class="text-center" style="color: red; font-size:24px"> Nothing Uploaded in Packages to be shipped
                    </h5>
                @endif


            </div>

            <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
                <div class="card-body px-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="font-weight-medium  mb-0">IDENTIFICATION UPLOADED BY RD DRIVER</h4>
                            <p class="card-subtitle mb-3">
                                VALID FORMS OF IDENTIFICATION:
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row el-element-overlay">
                @if ($receiverIdentityCard)
                    @if ($receiverIdentityCard->id_front)
                        <div class="col-md-4">
                            <div class="card overflow-hidden">
                                <div class="el-card-item pb-3">
                                    <div
                                        class="
                el-card-avatar
                mb-3
                el-overlay-1
                w-100
                overflow-hidden
                position-relative
                text-center
              ">
                                        <a class="image-popup-vertical-fit"
                                            href="{{ url('uploads/identity_cards/' . $receiverIdentityCard->id_front) }}">
                                            <img src="{{ url('uploads/identity_cards/' . $receiverIdentityCard->id_front) }}"
                                                class="d-block position-relative w-100" alt="user">
                                        </a>
                                    </div>
                                    <div class="el-card-content text-center">
                                        <h4 class="card-title">ID FRONT</h4>
                                        <p class="card-subtitle">DOM REP DRIVER LICENSE OR ELECTORAL ID (FRONT)</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif

                    @if ($receiverIdentityCard->id_back)
                        <div class="col-md-4">
                            <div class="card overflow-hidden">
                                <div class="el-card-item pb-3">
                                    <div
                                        class="
                el-card-avatar
                mb-3
                el-overlay-1
                w-100
                overflow-hidden
                position-relative
                text-center
              ">
                                        <a class="image-popup-vertical-fit"
                                            href="{{ url('uploads/identity_cards/' . $receiverIdentityCard->id_back) }}">
                                            <img src="{{ url('uploads/identity_cards/' . $receiverIdentityCard->id_back) }}"
                                                class="d-block position-relative w-100" alt="user">
                                        </a>
                                    </div>
                                    <div class="el-card-content text-center">
                                        <h4 class="card-title">ID BACK</h4>
                                        <p class="card-subtitle">DOM REP DRIVER LICENSE OR ELECTORAL ID (BACK)</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif
                @else
                    <h5 class="text-center" style="color: red; font-size:24px"> Nothing Uploaded in Receivers Identity</h5>
                @endif


            </div>
        @endif
        <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
            <div class="card-body px-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="font-weight-medium  mb-0">PACKAGES</h4>
                        <p class="card-subtitle mb-3">
                            PHOTOS OF DELIVERED PACKAGES:
                        </p>
                    </div>

                </div>
            </div>
        </div>

        <div class="row el-element-overlay">
            @if ($receiverPackageImages)
                @if ($receiverPackageImages->isNotEmpty())
                    @foreach ($receiverPackageImages as $packageImage)
                        <div class="col-md-4">
                            <div class="card overflow-hidden">
                                <div class="el-card-item pb-3">
                                    <div
                                        class="
                el-card-avatar
                mb-3
                el-overlay-1
                w-100
                overflow-hidden
                position-relative
                text-center
              ">
                                        <a class="image-popup-vertical-fit" href="{{ url($packageImage->image) }}">
                                            <img src="{{ url($packageImage->image) }}"
                                                class="d-block position-relative w-100" style="height:300px" alt="user">
                                        </a>
                                    </div>

                                </div>
                            </div>

                        </div>
                    @endforeach
                @endif
            @else
                <h5 class="text-center" style="color: red; font-size:24px"> Nothing Uploaded in packages that need to be
                    delivered</h5>
            @endif


        </div>


        <div class="font-weight-medium shadow-none position-relative overflow-hidden mb-7">
            <div class="card-body px-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="font-weight-medium  mb-5">SIGNATURES</h4>

                    </div>

                </div>
            </div>
        </div>

        <div class="row el-element-overlay">
            @if ($auth == 0 || ($auth == 2 && !$isClientListOff))
                @if ($senderSignature)
                    @if ($senderSignature->signature_image)
                        <div class="col-md-4">
                            <div class="card overflow-hidden">
                                <div class="el-card-item pb-3">
                                    <div
                                        class="
                el-card-avatar
                mb-3
                el-overlay-1
                w-100
                overflow-hidden
                position-relative
                text-center
              ">
                                        <a class="image-popup-vertical-fit"
                                            href="{{ url('sender_signatures/' . $senderSignature->signature_image) }}">
                                            <img src="{{ url('sender_signatures/' . $senderSignature->signature_image) }}"
                                                class="d-block position-relative w-100" alt="user">
                                        </a>
                                    </div>
                                    <div class="el-card-content text-center">
                                        <h4 class="card-title">Sender Signature</h4>

                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif
                @else
                    <h5 class="text-center" style="color: red; font-size:24px"> Sender Signature not Uploaded</h5>
                @endif
            @endif
            @if ($receiverSignature)
                @if ($receiverSignature->signature_image)
                    <div class="col-md-4">
                        <div class="card overflow-hidden">
                            <div class="el-card-item pb-3">
                                <div
                                    class="
                el-card-avatar
                mb-3
                el-overlay-1
                w-100
                overflow-hidden
                position-relative
                text-center
              ">
                                    <a class="image-popup-vertical-fit"
                                        href="{{ url('sender_signatures/' . $receiverSignature->signature_image) }}">
                                        <img src="{{ url('sender_signatures/' . $receiverSignature->signature_image) }}"
                                            class="d-block position-relative w-100" alt="user">
                                    </a>
                                </div>
                                <div class="el-card-content text-center">
                                    <h4 class="card-title">Receiver Signature</h4>

                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            @else
                <h5 class="text-center" style="color: red; font-size:24px"> Receiver Signature not Uploaded</h5>
            @endif


        </div>
    </div>

@endsection

@push('script')
@endpush
