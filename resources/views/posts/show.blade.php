@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Post -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex justify-between items-start mb-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $post->title }}</h1>
                <div class="flex items-center text-sm text-gray-500 space-x-4">
                    <span>👤 {{ $post->user->name }}</span>
                    <span>📅 {{ $post->created_at->format('M d, Y') }}</span>
                </div>
            </div>
            <div class="space-x-2">
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
        <div class="prose max-w-none">
            <p class="text-gray-700 whitespace-pre-line">{{ $post->body }}</p>
        </div>
    </div>

    <!-- Comments -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Comments ({{ $post->comments->count() }})</h2>

        <!-- Add Comment Form -->
        @auth
            <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-6">
                @csrf
                <textarea name="body" rows="3" placeholder="Write a comment..." 
                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('body') border-red-500 @enderror" 
                          required>{{ old('body') }}</textarea>
                @error('body')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Add Comment
                </button>
            </form>
        @else
            <p class="text-gray-500 mb-6">
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a> to comment
            </p>
        @endauth

        <!-- Comments List -->
        <div class="space-y-4">
            @forelse($post->comments as $comment)
                <div class="border-l-4 border-blue-500 pl-4 py-2">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-1">
                                <span class="font-bold text-gray-800">{{ $comment->user->name }}</span>
                                <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-700">{{ $comment->body }}</p>
                        </div>
                        <div class="ml-4 space-x-2">
                            @can('delete', $comment)
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm" 
                                            onclick="return confirm('Delete this comment?')">Delete</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">No comments yet. Be the first to comment!</p>
            @endforelse
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-800">← Back to all posts</a>
    </div>
</div>
@endsection