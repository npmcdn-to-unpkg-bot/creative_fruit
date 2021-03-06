<script>
var files = {!! json_encode($files) !!};
</script>

@extends('layouts.app')

@section('title')
    Edit Work
@endsection

@section('content')
    <form method="post" action='{{ url("/work/" . $work->slug . "/edit") }}' class="inner-container">
        <input type="hidden" class="token" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="work_id" value="{{ $work->id }}{{ old('work_id') }}">
        <div class="form-item">
            <input required="required" placeholder="Enter title here" type="text" name="title" class="form-item-title" value="@if(!old('title')){{$work->title}}@endif{{ old('title') }}"/>
        </div>
        <div class="form-item">
            <label><input type="radio" name="type" value="work" @if ($work->type == 'work') checked="checked" @endif> <i>Work</i></label>
            <label><input type="radio" name="type" value="video" @if ($work->type == 'video') checked="checked" @endif> <i>Video</i></label>
        </div>
        <div class="form-item">
          <input value="{{ old('video') }}" placeholder="Enter video link" type="text" name="video_url" class="form-item-video" />
        </div>
        <div class="form-item">
            <textarea name='body' class="form-item-body ckeditor">@if (!old('body')){!! $work->body !!}@endif{!! old('body') !!}</textarea>
        </div>
        <div class="form-item">
            <div class="dropzone" id="upload-widget"></div>
        </div>
        <div class="form-item-hidden">
            <input type="text" name="files" value="{!! old('files') !!}" />
        </div>
        @if ($work->active == '1')
            <input type="submit" name='publish' class="button button-update" value="Update" />
        @else
            <input type="submit" name='publish' class="button button-publish" value="Publish" />
        @endif
        <input type="submit" name='save' class="button button-save" value = "Save As Draft" />
        <a href="{{  url('/work/delete/'.$work->id.'?_token='.csrf_token()) }}" class="button button-delete">Delete</a>
    </form>
@endsection

@section('assets')
    <script src="//cdn.ckeditor.com/4.5.10/full/ckeditor.js"></script>
    <script src="//code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
    <script src="/js/vendor/dropzone.js"></script>
    <link href="/css/vendor/dropzone.css" rel="stylesheet"></link>
@endsection
