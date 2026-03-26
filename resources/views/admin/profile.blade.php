@extends('layouts.master')
@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <!-- Account -->

                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <form id="" method="POST"
                                    action="{{ route('admin.update-profile-page', $admin->id) }}">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label for="firstName" class="form-label">Full Name</label>
                                            <input class="form-control" type="text" name="name"
                                                value="{{ $admin->name }}" />
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label for="email" class="form-label">E-mail</label>
                                            <input class="form-control" type="email" name="email"
                                                value="{{ $admin->email }}" />
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label" for="phoneNumber">Phone Number</label>
                                            <div class="input-group input-group-merge">
                                                <input type="text" name="phone" value="{{ $admin->phone }}"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <input type="submit" class="btn btn-primary me-2" value="Save Change">
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-6 col-12">
                                {{-- <h2>Changes Password</h2> --}}
                                <form id="formAccountSettings" method="POST"
                                    action="{{ route('admin.change-password-page') }}">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label for="current_password" class="form-label">Current Password</label>
                                            <div class="input-group">
                                                <input class="form-control" type="password" id="current_password"
                                                    name="current_password" />
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="togglePassword('current_password', this)">
                                                    <i class="ti ti-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label for="new_password" class="form-label">New Password</label>
                                            <div class="input-group">
                                                <input class="form-control" type="password" id="new_password"
                                                    name="new_password" />
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="togglePassword('new_password', this)">
                                                    <i class="ti ti-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label for="confirm_password" class="form-label">Repeat New Password</label>
                                            <div class="input-group">
                                                <input class="form-control" type="password" id="confirm_password"
                                                    name="Confirm_password" />
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="togglePassword('confirm_password', this)">
                                                    <i class="ti ti-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <input type="submit" class="btn btn-primary me-2" value="Save Change">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    @push('scripts')
        <script>
            function togglePassword(inputId, btn) {
                const input = document.getElementById(inputId);
                const icon = btn.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('ti-eye', 'ti-eye-off');
                } else {
                    input.type = 'password';
                    icon.classList.replace('ti-eye-off', 'ti-eye');
                }
            }
        </script>
    @endpush
@endsection
