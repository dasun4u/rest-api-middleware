<div class="row head">
    <div class="col-xs-10 col-xs-offset-1">
        <div class="row">
            <div class="col-sm-4 text-center">
                <div class="col-sm-3">
                    <img src="{!! url('images/new_logo.png') !!}" height="40px" class="logo"
                         style="margin: 5px auto 5px;display: block">
                </div>
                <div class="col-sm-9">
                    <h3 class="logo-text">DAPI REST API Middleware</h3>
                </div>
            </div>
            <div class="col-sm-8">
                @if (Auth::guest())
                    <a class="btn btn-primary header-btn pull-right" href="{{ url('/login') }}">Login</a>
                    <a class="btn btn-primary header-btn pull-right" href="{{ url('/register') }}">Register</a>
                @else
                    <div class="dropdown col-sm-3 pull-right">
                        <a href="#" class="btn login_btn_style btn-default dropdown-toggle text-center" data-toggle="dropdown" id="dropdownMenu1" role="button" aria-expanded="true">
                            @php
                                if(Auth::user()->avatar==null){
                                    echo '<div class="col-sm-12"><span class="glyphicon glyphicon-user"></span> Hi!&nbsp;'.Auth::user()->username.'&nbsp;</div>';
                                } else {
                                    echo '<div class="col-sm-12"><div class="col-sm-4"><img src="'.asset(Auth::user()->avatar).'" class="avatar"/></div><div class="col-sm-8"> Hi!&nbsp;'.Auth::user()->username.'&nbsp;</div></div>';
                                }
                            @endphp
                        </a>
                        <ul class="dropdown-menu col-sm-3" aria-labelledby="dropdownMenu1">
                            <li>
                                <a href="{{ url('/logout') }}" class="text-center" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
        <nav class="navbar navbar-default">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">News</a></li>
                    <li><a href="#">Promotions</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </div>
</div>