<div class="col-sm-2">
    <div class="col-sm-12 hidden-xs">
        <ul class="nav nav-pills nav-stacked sidebar_styles">
            @if(Auth::user()->username=='admin')
                <li role="presentation"
                    {{Request::segment(2)=='home'?$active='active':$active=''}} class="{{$active}}">
                    <a href="{{url('/admin/home')}}"><i class="fa fas fa-home" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Dashboard</a>
                </li>
                <li role="presentation"
                    {{Request::segment(2)=='users'?$active='active':$active=''}} class="{{$active}}">
                    <a href="{{url('/admin/users')}}"><i class="fa fas fa-users" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Users</a>
                </li>
                <li role="presentation"
                    {{Request::segment(2)=='applications'?$active='active':$active=''}} class="{{$active}}">
                    <a href="{{url('/admin/applications')}}"><i class="fa fas fa-file" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Applications</a>
                </li>
                <li role="presentation"
                    {{Request::segment(2)=='serviceGroups'?$active='active':$active=''}} class="{{$active}}">
                    <a href="{{url('/admin/serviceGroups')}}"><i class="fa fas fa-object-group" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;API Groups</a>
                </li>
                <li role="presentation"
                    {{Request::segment(2)=='services'?$active='active':$active=''}} class="{{$active}}">
                    <a href="{{url('/admin/services')}}"><i class="fa fas fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Services</a>
                </li>
                <li role="presentation"
                    {{Request::segment(2)=='subscriptions'?$active='active':$active=''}} class="{{$active}}">
                    <a href="{{url('/admin/subscriptions')}}"><i class="fa fas fa-handshake-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Subscriptions</a>
                </li>
                <li role="presentation"
                    {{Request::segment(2)=='messages'?$active='active':$active=''}} class="{{$active}}">
                    <a href="{{url('/admin/messages')}}"><i class="fa fas fa-envelope" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Messages</a>
                </li>
            @endif
        </ul>
    </div>
</div>