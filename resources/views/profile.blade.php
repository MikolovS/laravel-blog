@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if (isset($message))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                        @endif
                    </div>
                </div>
                <div>
                    <a class="btn btn-primary" href="{{url('thread/create')}}" role="button">+ Add</a>
                    <hr>
                </div>

                @forelse($threads as $thread)
                    <div class="category__article card-container">
                        <h2>{{$thread->title}}</h2>
                        <p>{{$thread->content}}</p>
                        <a class="btn btn-primary" href="{{route('edit_thread', [$thread->id])}}"
                           role="button">Update</a>
                    </div>
                @empty
                    <b>You have't any threads</b>
                @endforelse
            </div>
        </div>
    </div>
@endsection
