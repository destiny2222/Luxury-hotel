@extends('layouts.master')
@section('content')
    <div class="card w-100 position-relative overflow-hidden">
        <div class="px-4 py-3 border-bottom">
            <h4 class="card-title mb-0">General Settings</h4>
        </div>
        <div class="card-body p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.plugins.update') }}" method="POST">
                @csrf


                <div class="row mb-5">
                    {{-- <div class="col-md-12 mb-3">
                        <h5 class="mb-3">Flutterwave Settings</h5>
                    </div> --}}

                    <div class="col-md-12 mb-3">
                        <label for="shipping_fee" class="form-label">Shipping Fee Base (NGN)</label>
                        <input type="number" step="0.01" min="0" class="form-control" id="shipping_fee"
                            name="shipping_fee" value="{{ \App\Models\Plugin::get('shipping_fee') ?? 0 }}"
                            placeholder="e.g. 5000">
                        <small class="text-muted">Enter the default shipping fee applied to all orders.</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ \App\Models\Plugin::get('email') }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ \App\Models\Plugin::get('phone') }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="flutterwave_public_key" class="form-label">Flutterwave Public Key</label>
                        <input type="text" class="form-control" id="flutterwave_public_key" name="flutterwave_public_key"
                            value="{{ \App\Models\Plugin::get('flutterwave_public_key') }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="flutterwave_secret_key" class="form-label">Flutterwave Secret Key</label>
                        <input type="text" class="form-control" id="flutterwave_secret_key" name="flutterwave_secret_key"
                            value="{{ \App\Models\Plugin::get('flutterwave_secret_key') }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="flutterwave_secret_hash" class="form-label">Flutterwave Webhook Secret Hash</label>
                        <input type="text" class="form-control" id="flutterwave_secret_hash"
                            name="flutterwave_secret_hash" value="{{ \App\Models\Plugin::get('flutterwave_secret_hash') }}"
                            placeholder="Used for verifying webhooks">
                    </div>
                </div>
        </div>

        <div class="d-flex gap-2 justify-content-end">
            <button type="submit" class="btn btn-primary">
                <i class="ti ti-device-floppy me-1"></i> Save Settings
            </button>
        </div>
        </form>
    </div>
    </div>
@endsection

@push('scripts')
    <script>
        // CKEditor for description
        ClassicEditor
            .create(document.querySelector('#history'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'undo', 'redo']
            })
            .then(editor => {
                descriptionEditor = editor;
            })
            .catch(error => {
                console.error('CKEditor initialization error:', error);
            });

        // Handle form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            if (descriptionEditor) {
                document.querySelector('#history').value = descriptionEditor.getData();
            }
        });
    </script>
    <script>
        // CKEditor for description
        ClassicEditor
            .create(document.querySelector('#mission'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'undo', 'redo']
            })
            .then(editor => {
                descriptionEditor = editor;
            })
            .catch(error => {
                console.error('CKEditor initialization error:', error);
            });

        // Handle form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            if (descriptionEditor) {
                document.querySelector('#mission').value = descriptionEditor.getData();
            }
        });
    </script>
    <script>
        // CKEditor for description
        ClassicEditor
            .create(document.querySelector('#vision'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'undo', 'redo']
            })
            .then(editor => {
                descriptionEditor = editor;
            })
            .catch(error => {
                console.error('CKEditor initialization error:', error);
            });

        // Handle form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            if (descriptionEditor) {
                document.querySelector('#vision').value = descriptionEditor.getData();
            }
        });
    </script>
@endpush
