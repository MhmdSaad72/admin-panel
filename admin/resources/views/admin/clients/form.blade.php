<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ '*Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($client->name) ? $client->name : old('name')}}" required>

    {!! $errors->first('name', '<p class="help-block text-danger">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('logo') ? 'has-error' : ''}}">
    <label for="logo" class="control-label">{{ '*Logo' }}</label>
    <input class="form-control" name="logo" type="file" id="logo" value="{{ isset($client->logo) ? $client->logo : old('logo')}}" >

    {!! $errors->first('logo', '<p class="help-block text-danger">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
