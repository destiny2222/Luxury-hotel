@extends('layouts.app')

@section('content')
<section class="page-header" style="background-image: url('https://images.unsplash.com/photo-1455390582262-044cdead277a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
    <div class="page-header-overlay"></div>
    <div class="container">
        <h1>Our Blog</h1>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <span class="breadcrumb-separator">/</span>
            <span class="active">Blog</span>
        </div>
    </div>
</section>

<section class="blog-listing section-padding">
    <div class="container">
        <div class="blog-grid">
            @foreach($posts as $post)
            <div class="blog-card">
                <div class="blog-image">
                    <img src="{{ !empty($post->image) ? (str_starts_with($post->image, 'http') ? $post->image : asset('uploads/blog/' . $post->image)) : 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80' }}" alt="{{ $post->title }}">
                </div>
                <div class="blog-content">
                    <span class="date">{{ $post->created_at->format('M d, Y') }}</span>
                    <h3><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h3>
                    <p>{{ Str::limit(strip_tags($post->content), 150) }}</p>
                    <a href="{{ route('blog.show', $post->slug) }}" class="btn-text">Read More →</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="pagination">
            {{ $posts->links() }}
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .blog-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2.5rem; }
    .blog-card { background-color: var(--white); border-radius: 8px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: transform 0.3s, box-shadow 0.3s; }
    .blog-card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
    .blog-image { height: 250px; overflow: hidden; }
    .blog-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
    .blog-card:hover .blog-image img { transform: scale(1.05); }
    .blog-content { padding: 2rem; }
    .blog-content .date { color: var(--primary-color); font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; }
    .blog-content h3 { font-size: 1.5rem; margin: 0.5rem 0 1rem; }
    .blog-content h3 a { color: var(--secondary-color); text-decoration: none; }
    .blog-content h3 a:hover { color: var(--primary-color); }
    .blog-content p { color: var(--text-muted); margin-bottom: 1.5rem; font-size: 0.95rem; line-height: 1.6; }
    .btn-text { font-weight: 700; color: var(--primary-color); text-decoration: none; }
    .btn-text:hover { text-decoration: underline; }
    
    .pagination { margin-top: 4rem; display: flex; justify-content: center; }

    @media (max-width: 992px) { .blog-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 576px) { .blog-grid { grid-template-columns: 1fr; } }
</style>
@endsection
