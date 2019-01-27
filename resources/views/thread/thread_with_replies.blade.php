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
                    <div class="panel-heading">
                        <div class="level">
                            <div class="flex">
                                <h4>
                                    {{ $thread->title }}
                                </h4>

                                <h5>
                                    Posted By: {{ $thread->creator->email }}
                                </h5>
                                <p>at: {{$thread->created_at->toDateTimeString()}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="body">{{ $thread->content }}
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">

                    <div class="panel-heading">Reply</div>

                    <form class="form-horizontal" method="POST"
                          action="{{route('create_reply')}}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-4 control-label">Content</label>

                            <div class="col-md-6">
                                <textarea id="content" class="form-control" name="content" required>
                                    {{ old('content') }}
                                </textarea>

                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <input hidden name="thread_id" value="{{$thread->id}}">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send reply
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection