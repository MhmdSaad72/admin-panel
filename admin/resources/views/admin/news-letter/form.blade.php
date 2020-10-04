<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ '*Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($newsletter->title) ? $newsletter->title : old('title')}}" >

    {!! $errors->first('title', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('lang_title') ? 'has-error' : ''}}">
    <label for="lang_title" class="control-label">{{ '*Lang Title' }}</label>
    <input class="form-control" name="lang_title" type="text" id="lang_title" value="{{ isset($newsletter->lang_title) ? $newsletter->lang_title : old('lang_title')}}" >

    {!! $errors->first('lang_title', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('body') ? 'has-error' : ''}}">
    <label for="body" class="control-label">{{ '*Body' }}</label>
    <textarea class="form-control" rows="5" name="body" type="textarea" id="body" >{{ isset($newsletter->body) ? $newsletter->body : old('body')}}</textarea>
    {!! $errors->first('body', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('lang_body') ? 'has-error' : ''}}">
    <label for="lang_body" class="control-label">{{ '*Lang Body' }}</label>
    <textarea class="form-control" rows="5" name="lang_body" type="textarea" id="lang_body" >{{ isset($newsletter->lang_body) ? $newsletter->lang_body : old('lang_body')}}</textarea>
    {!! $errors->first('lang_body', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ '*Image' }}</label>
    <input class="form-control" name="image" type="file" id="image" value="{{ isset($newsletter->image) ? $newsletter->image : old('image')}}" >

    {!! $errors->first('image', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('lang_image') ? 'has-error' : ''}}">
    <label for="lang_image" class="control-label">{{ '*Lang Image' }}</label>
    <input class="form-control" name="lang_image" type="file" id="lang_image" value="{{ isset($newsletter->lang_image) ? $newsletter->lang_image : old('lang_image')}}" >

    {!! $errors->first('lang_image', '<p class="help-block text-danger">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
