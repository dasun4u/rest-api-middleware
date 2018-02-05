<div class="col-sm-2">
    <div class="col-sm-12 hidden-xs">
        <ul class="nav nav-pills nav-stacked sidebar_styles">
            <li role="presentation"
                {{Request::segment(1)=='home'?$active='active':$active=''}} class="{{$active}}">
                <a href="{{url('/home')}}"><i class="fa fas fa-home" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Dashboard</a>
            </li>
            <li role="presentation"
                {{Request::segment(1)=='users'?$active='active':$active=''}} class="{{$active}}">
                <a href="{{url('/users')}}"><i class="fa fas fa-users" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Users</a>
            </li>
            <li role="presentation"
                {{Request::segment(1)=='agents'||Request::segment(1)=='agents/create'||Request::segment(1)=='agents/{id}/edit'?$active='active':$active=''}} class="{{$active}}">
                <a href="{{url('/applications')}}"><i class="fa fas fa-file" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Applications</a>
            </li>
        </ul>
    </div>
</div>