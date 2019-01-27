@extends('layouts.app')
@php
    /** @var $thread \App\Models\Thread */
    /** @var $author \App\Models\User */
@endphp
@section('content')
    <div class="container">

        <form class="form-horizontal" method="GET" action="{{ route('threads') }}">
            @forelse($authors as $author)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{$author->id}}" id="{{$author->id}}"
                           name="authors[]" {{$author->checked ? 'checked' : ''}}>
                    <label class="form-check-label" for="{{$author->id}}">
                        {{$author->email}}
                    </label>
                </div>
            @empty
                <p>No threads and authors</p>
            @endforelse
            <p>Display Order:</p>
            <div class="form-check form-check-horizontal">
                <input class="form-check-input" type="radio" name="order" id="inlineRadio1" value="DESC">
                <label class="form-check-label" for="inlineRadio1">New</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="order" id="inlineRadio2" value="ASC">
                <label class="form-check-label" for="inlineRadio2">Older</label>
            </div>
            <div class="form-group">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">
                        Get threads
                    </button>
                </div>
            </div>
        </form>

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
            </div>
        @empty
            <p>There are no relevant results at this time.</p>
        @endforelse
    </div>
@endsection