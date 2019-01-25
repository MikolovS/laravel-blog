@extends('layouts.app')
@php
    /** @var $thread \App\Models\Thread */
@endphp
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel-body">
                    @if (isset($message))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif
                </div>

                <div class="panel panel-default">

                    <div class="panel-heading">Thread Crude</div>

                    <form class="form-horizontal" method="POST"
                          action="{{ isset($thread) ? url('thread/edit/' . $thread->id) : url('thread/create') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title"
                                       value="{{ $thread->title ?? old('title') }}" required>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-4 control-label">Content</label>

                            <div class="col-md-6">
                                <textarea id="content" class="form-control"
                                          name="content">{{ $thread->content ?? old('content') }}</textarea>

                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{isset($thread) ? 'Update' : 'Create'}}
                                </button>
                            </div>
                        </div>
                    </form>
                    @if(isset($thread))
                        <form action="{{route('delete_thread', [$thread->id])}}" method="POST">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-danger" value="Delete"/>
                        </form>
                    @endIf
                </div>
            </div>
        </div>
    </div>
@endsection