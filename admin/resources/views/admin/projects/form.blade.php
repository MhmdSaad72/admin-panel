<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ '*Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($project->title) ? $project->title : old('title')}}" >

    {!! $errors->first('title', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('lang_title') ? 'has-error' : ''}}">
    <label for="lang_title" class="control-label">{{ '*Lang Title' }}</label>
    <input class="form-control" name="lang_title" type="text" id="lang_title" value="{{ isset($project->lang_title) ? $project->lang_title : old('lang_title')}}" >

    {!! $errors->first('lang_title', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ '*Description' }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea" id="description" >{{ isset($project->description) ? $project->description : old('description')}}</textarea>
    {!! $errors->first('description', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('lang_description') ? 'has-error' : ''}}">
    <label for="lang_description" class="control-label">{{ '*Lang Description' }}</label>
    <textarea class="form-control" rows="5" name="lang_description" type="textarea" id="lang_description" >{{ isset($project->lang_description) ? $project->lang_description : old('lang_description')}}</textarea>
    {!! $errors->first('lang_description', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('album') ? 'has-error' : ''}}">
    <label for="album" class="control-label">{{ '*Album' }}</label>
    <input class="form-control" multiple="multiple" name="album[]" type="file" id="album" value="{{ isset($project->album) ? $project->album : old('album')}}" >

    {!! $errors->first('album', '<p class="help-block text-danger">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
