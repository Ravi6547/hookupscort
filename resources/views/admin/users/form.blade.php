<div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
    {!! Form::label('name', 'Name: ', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
    {!! Form::label('email', 'Email: ', ['class' => 'control-label']) !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('mobile') ? ' has-error' : ''}}">
    {!! Form::label('mobile', 'Mobile: ', ['class' => 'control-label']) !!}
    {!! Form::text('mobile', null, ['class' => 'form-control','maxlength' => 10,'required' => 'required']) !!}
    {!! $errors->first('mobile', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('city') ? ' has-error' : ''}}">
    {!! Form::label('city', 'City: ', ['class' => 'control-label']) !!}
    {!! Form::select('city', $citys, isset($user->city) ? $user->city : '', ['class' => 'form-control']) !!}
</div>
<div class="form-group{{ $errors->has('images') ? ' has-error' : ''}}">
    {!! Form::label('images', 'Upload Images: ', ['class' => 'control-label']) !!}
    {!! Form::file('images[]', ['class' => 'form-control', 'multiple' => true]) !!}
    {!! $errors->first('images', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group{{ $errors->has('description') ? ' has-error' : ''}}">
    {!! Form::label('description', 'Description: ', ['class' => 'control-label']) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>

<!-- <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
    {!! Form::label('password', 'Password: ', ['class' => 'control-label']) !!}
    @php    
        $passwordOptions = ['class' => 'form-control'];
        if ($formMode === 'create') {
            $passwordOptions = array_merge($passwordOptions, ['required' => 'required']);
        }
    @endphp
    {!! Form::password('password', $passwordOptions) !!}
    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div> -->
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
