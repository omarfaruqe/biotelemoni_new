<div class="box-body">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Profile</h4>
        </div>
        <div class="panel-body">
            @if(empty($user->avatar))
                <img src="{{asset('skins/adminLTE/dist/img/default-avatar.jpg')}}" alt=""
                     class="col-xs-4 col-md-2 img-circle">
            @else
                <img src="{{ GlideImage::load('/files/avatar/'. $user->avatar)->modify(['w'=> 300, 'h' => 300, 'fit' => 'crop']) }}" alt=""
                     class="col-xs-4 col-md-2 img-circle">
            @endif
            <ul class="list-unstyled col-xs-8 col-md-10">
                <li><strong>Name</strong>: {{$user->name}}</li>
                <li><strong>Email</strong>: {{$user->email}}</li>
                <li><strong>Joined</strong>: {{$user->created_at->toFormattedDateString()}}</li>
            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Roles</h4>
        </div>
        <table class="table table-bordered panel-body">
            <tr>
                <th style="width: 25%">Role</th>
                <th>Description</th>
            </tr>
            @foreach($user->roles as $role)
                <tr>
                    <td>{{$role->display_name}}</td>
                    <td>{{$role->description}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Permissions</h4>
        </div>
        <table class="table table-bordered panel-body">
            <tr>
                <th style="width: 25%">Permission</th>
                <th>Description</th>
            </tr>
            @foreach($user->permissions() as $perm)
                <tr>
                    <td>{{$perm->display_name}}</td>
                    <td>{{$perm->description}}</td>
                </tr>
            @endforeach
        </table>
    </div>

</div>


