@extends('layouts.app')
@php
    /** @var $thread \App\Models\Thread */
    /** @var $author \App\Models\User */
@endphp
@section('content')
    <div class="container">

        <div class="panel-body">
            @if (isset($message))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif
        </div>

        @forelse ($threads as $thread)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="level">
                        <div class="flex">
                            <h4>
                                <a href="{{route('thread_with_replies', [$thread->id])}}">{{ $thread->title }}</a>
                            </h4>

                            <h5>
                                Posted By: {{ $thread->creator->email }}
                            </h5>
                            <p>at: {{$thread->created_at->toDateTimeString()}}</p>
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <div class="body">{{ str_limit($thread->content, $limit = 75, $end = '...') }}
                    </div>
                </div>
                <form action="{{route('admin.delete_thread', [$thread->id])}}" method="POST">
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-danger" value="Delete"/>
                </form>
            </div>
        @empty
            <p>There are no relevant results at this time.</p>
        @endforelse
    </div>
@endsection