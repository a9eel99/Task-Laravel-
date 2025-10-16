@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">All Posts</h1>
</div>

<div class="space-y-6">
    @forelse($posts as $post)
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-start">
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">
                        <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p class="text-gray-600 mb-4">{{ Str::limit($post->body, 200) }}</p>
                    <div class="flex items-center text-sm text-gray-500 space-x-4">
                        <span>👤 {{ $post->user->name }}</span>
                        <span>📅 {{ $post->created_at->diffForHumans() }}</span>
                        <span>💬 {{ $post->comments->count() }} comments</span>
                    </div>
                </div>
                <div class="ml-4 space-x-2">
                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                    @endcan
                    @can('delete', $post)
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800" 
                                    onclick="return confirm('Delete this post?')">Delete</button>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-lg shadow p-6 text-center text-gray-500">
            No posts yet. Create your first post!
        </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $posts->links() }}
</div>
@endsection