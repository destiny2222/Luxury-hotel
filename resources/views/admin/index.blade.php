@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <!--  Owl carousel -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 zoom-in bg-primary-subtle shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="/assets/images/svgs/icon-user-male.svg" width="50" height="50" class="mb-3"
                                alt="modernize-img">
                            <p class="fw-semibold fs-3 text-primary mb-1">
                                Total Users
                            </p>
                            {{-- <h5 class="fw-semibold text-primary mb-0">{{ $totalUsers }}</h5> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 zoom-in bg-warning-subtle shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="/assets/images/svgs/icon-briefcase.svg" width="50" height="50" class="mb-3"
                                alt="modernize-img">
                            <p class="fw-semibold fs-3 text-warning mb-1">Subscribed Users</p>
                            {{-- <h5 class="fw-semibold text-warning mb-0">{{ $totalSubscribedUsers }}</h5> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 zoom-in bg-info-subtle shadow-none">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="/assets/images/svgs/icon-mailbox.svg" width="50" height="50" class="mb-3"
                                alt="modernize-img">
                            <p class="fw-semibold fs-3 text-info mb-1">Unsubscribed Users</p>
                            {{-- <h5 class="fw-semibold text-info mb-0">{{ $totalUnsubscribedUsers }}</h5> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        
    </div>
@endsection
