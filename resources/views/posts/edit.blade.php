@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-4xl font-bold text-gray-800 mb-8">✏️ Edit Post</h1>

    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Title</label>
                <input type="text" 
                       name="title" 
                       value="{{ old('title', $post->title) }}" 
                       class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror" 
                       required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Body</label>
                <textarea name="body" 
                          rows="12" 
                          class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('body') border-red-500 @enderror" 
                          required>{{ old('body', $post->body) }}</textarea>
                @error('body')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-medium">
                    💾 Update Post
                </button>
                <a href="{{ route('posts.show', $post) }}" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection