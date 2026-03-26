@extends('layouts.app')

@section('content')
<section class="page-header" style="background-image: url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
    <div class="page-header-overlay"></div>
    <div class="container">
        <h1>Login</h1>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="breadcrumb-separator">/</span>
            <span class="active">Login</span>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width: 500px;">
        <div class="auth-card">
            <h2 class="text-center mb-8" style="font-size: 2rem;">Welcome Back</h2>

            @if($errors->any())
                <div class="alert alert-danger" style="background: #f8d7da; color: #721c24; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    @foreach($errors->all() as $error)
                        <p style="margin: 0;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 700; font-size: 0.85rem; margin-bottom: 0.5rem; color: #666; text-transform: uppercase; letter-spacing: 1px;">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        style="width: 100%; padding: 1rem; border: 1px solid #eee; border-radius: 8px; font-family: inherit; transition: border-color 0.3s;"
                        onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='#eee'">
                </div>

                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 700; font-size: 0.85rem; margin-bottom: 0.5rem; color: #666; text-transform: uppercase; letter-spacing: 1px;">Password</label>
                    <input type="password" name="password" required
                        style="width: 100%; padding: 1rem; border: 1px solid #eee; border-radius: 8px; font-family: inherit; transition: border-color 0.3s;"
                        onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='#eee'">
                </div>

                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="checkbox" name="remember" style="accent-color: var(--color-primary);">
                        <span style="font-size: 0.9rem;">Remember me</span>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-size: 1rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; border: none; cursor: pointer; border-radius: 8px;">
                    Sign In
                </button>
            </form>

            <p style="text-align: center; margin-top: 2rem; color: #666;">
                Don't have an account? <a href="{{ route('register') }}" style="color: var(--color-primary); font-weight: 700;">Register here</a>
            </p>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .auth-card {
        background: #fff;
        padding: 3rem;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    }
</style>
@endsection
