<style css="">
    .give-padding {
        padding-top: 25px;
    }
</style>
<div class="panel panel-default ">
    <div class="panel-heading">
        <h4 class="panel-title">Basic Information</h4>
    </div>
    <div class="form-group give-padding" >
        {!! Form::label('file name', 'File Name',['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('file name', null, ['class'=> 'form-control','required']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('email', 'E-Mail Address',['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::email('email', null, ['class'=> 'form-control','required']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('password', 'Password',['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::password('password', null, ['class'=> 'form-control','required']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('password_confirmation', 'Confirm Password',['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::password('password_confirmation', null, ['class'=> 'form-control','required']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('role_id', 'Authorization Level',['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::select('role_id', $roles, $selected_role, array('class' => 'form-control')) !!}
        </div>
    </div>
</div>
@if($avatar == 1)
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Change Profile Image</h4>
        </div>

        <div class="form-group give-padding">
            {!! form::label('avatar','Image',['class' => 'col-md-4 control-label'])!!}
            <div class="col-md-6">
                {!! form::file('avatar',null,['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
@endif

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Save
        </button>
    </div>
</div>