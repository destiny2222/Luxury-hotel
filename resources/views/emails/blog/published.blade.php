<x-mail::message>
# {{ $post->title }}

{{ Str::limit(strip_tags($post->content), 200) }}

<x-mail::button :url="route('blog.show', $post->slug)">
Read Full Post
</x-mail::button>

If you wish to stop receiving these emails, you can <a href="{{ route('newsletter.unsubscribe', $subscriber->token) }}">unsubscribe here</a>.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
