@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Post -->
    <div class="bg-white rounded-lg shadow-md p-8 mb-8">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>
                <div class="flex items-center text-sm text-gray-500 space-x-4">
                    <span>👤 {{ $post->user->name }}</span>
                    <span>📅 {{ $post->created_at->format('M d, Y') }}</span>
                    <span>⏰ {{ $post->created_at->diffForHumans() }}</span>
                </div>
            </div>
            <div class="flex space-x-2">
                @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Edit
                    </a>
                @endcan
                @can('delete', $post)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700" 
                                onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                @endcan
            </div>
        </div>
        <div class="prose max-w-none">
            <p class="text-gray-700 text-lg leading-relaxed whitespace-pre-line">{{ $post->body }}</p>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            💬 Comments ({{ $post->comments->count() }})
        </h2>

        <!-- Add Comment Form -->
        @auth
            <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-8">
                @csrf
                <textarea name="body" 
                          rows="4" 
                          placeholder="Write a comment..." 
                          class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('body') border-red-500 @enderror" 
                          required>{{ old('body') }}</textarea>
                @error('body')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <button type="submit" class="mt-3 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    💬 Add Comment
                </button>
            </form>
        @else
            <div class="mb-8 p-4 bg-gray-50 rounded-lg text-center">
                <p class="text-gray-600">
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">Login</a> 
                    to leave a comment
                </p>
            </div>
        @endauth

        <!-- Comments List -->
        <div class="space-y-4">
            @forelse($post->comments as $comment)
                <div class="border-l-4 border-blue-500 pl-4 py-3 bg-gray-50 rounded-r-lg">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="font-bold text-gray-800">{{ $comment->user->name }}</span>
                                <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-700">{{ $comment->body }}</p>
                        </div>
                        @can('delete', $comment)
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-800 text-sm font-medium" 
                                        onclick="return confirm('Delete this comment?')">
                                    Delete
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-8">No comments yet. Be the first to comment! 🎉</p>
            @endforelse
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('posts.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
            ← Back to all posts
        </a>
    </div>
</div>
@endsection