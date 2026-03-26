@extends('layouts.app')

@section('content')
<section class="page-header" style="background-image: url('{{ $post->image ?? 'https://images.unsplash.com/photo-1455390582262-044cdead277a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80' }}');">
    <div class="page-header-overlay"></div>
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="breadcrumb-separator">/</span>
            <a href="{{ route('blog.index') }}">Blog</a>
            <span class="breadcrumb-separator">/</span>
            <span class="active">{{ Str::limit($post->title, 30) }}</span>
        </div>
    </div>
</section>

<section class="blog-details-page section-padding">
    <div class="container">
        <div class="blog-post-container">
            <div class="blog-post-meta">
                <span class="date"><i class="far fa-calendar-alt"></i> {{ $post->created_at->format('F d, Y') }}</span>
                <span class="author"><i class="far fa-user"></i> {{ $post->user->name ?? 'Admin' }}</span>
            </div>

            <div class="blog-post-image">
                <img src="{{ $post->image ?? 'https://via.placeholder.com/1200x600' }}" alt="{{ $post->title }}">
            </div>

            <div class="blog-post-content">
                {!! $post->content !!}
            </div>

            <div class="blog-post-footer">
                <a href="{{ route('blog.index') }}" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-arrow-left"></i> Back to Blog
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .blog-post-container { max-width: 900px; margin: 0 auto; }
    
    .blog-post-meta { display: flex; gap: 2rem; margin-bottom: 2rem; color: var(--text-muted); font-size: 0.95rem; }
    .blog-post-meta i { color: var(--primary-color); margin-right: 0.3rem; }
    
    .blog-post-image { margin-bottom: 3rem; border-radius: 8px; overflow: hidden; height: 500px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
    .blog-post-image img { width: 100%; height: 100%; object-fit: cover; }
    
    .blog-post-content { font-size: 1.1rem; line-height: 1.9; color: var(--text-color); }
    .blog-post-content p { margin-bottom: 2rem; }
    
    blockquote { border-left: 5px solid var(--primary-color); padding: 2rem; background: var(--light-bg); font-family: var(--font-heading); font-style: italic; font-size: 1.5rem; margin: 3rem 0; color: var(--secondary-color); border-radius: 0 8px 8px 0; }

    .blog-post-footer { margin-top: 4rem; padding-top: 2rem; border-top: 1px solid var(--border-color); }

    @media (max-width: 768px) {
        .blog-post-image { height: 300px; }
        .blog-post-meta { flex-direction: column; gap: 0.5rem; }
    }
</style>
@endsection
