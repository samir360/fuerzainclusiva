<header id="topnav" class="defaultscroll scroll-active">
    <div class="tagline">
        <div class="container">
            <div class="float-left">
                <div class="phone"><i class="mdi mdi-phone-classic"></i> 62105872</div>
                <div class="email"><a href="mailto:info@fuerzainclusiva.com"> <i class="mdi mdi-email"></i> info@fuerzainclusiva.com </a></div>
            </div>
            <div class="float-right">
                <ul class="topbar-list list-unstyled d-flex" style="margin: 11px 0px;">

                    <li class="list-inline-item">
                        <a href="@if(isset($user) and ($user->rol_id==\App\Models\User::ROL_EMPLOYER)) {{route('employer-profile')}}@endif" >
                            <i class="mdi mdi-account mr-2"></i>
                            @if(isset($user))
                                {{$user->firstname.' '.$user->lastname}}
                            @endif
                        </a>
                    </li>


                    <li class="list-inline-item">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-close-circle mr-2"></i>
                            Cerrar Sesión
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            <input type="hidden" id="backend" name="backend" value="1">
                            @csrf
                        </form>

                    </li>

                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>


    <div class="container">
        <div>
            <a href="index.html" class="logo">
                <img src="images/logo-light.png" alt="" class="logo-light" height="18"/>
                <img src="images/logo-dark.png" alt="" class="logo-dark" height="18"/>
            </a>
        </div>
        @if(isset($user) and ($user->rol_id==\App\Models\User::ROL_EMPLOYER and count($user->companies) > 0))
            <div class="buy-button">
                <a href="{{route('post-a-job')}}" class="btn btn-primary">
                    <i class="mdi mdi-cloud-upload"></i>
                    Publica un trabajo</a>
            </div>
        @endif


        @if(isset($user) and ($user->rol_id==\App\Models\User::ROL_CANDIDATE))
            <div class="buy-button">
                <a href="{{route('jobs-list')}}" class="btn btn-primary">
                    <i class="mdi mdi-cloud-upload"></i>
                    Trabajos</a>
            </div>
        @endif

        <div class="menu-extras">
            <div class="menu-item">
                <a class="navbar-toggle">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </div>
        </div>


        @if(isset($user) and $user->rol_id==\App\Models\User::ROL_EMPLOYER)
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li><a href="{{route('candidate')}}">Inicio</a></li>

                    <li><a href="{{route('candidate-list')}}"> Candidatos </a></li>

                    <li class="has-submenu">
                        <a href="javascript:void(0)">Perfil</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="{{route('company-profile')}}"> Compañia </a></li>
                            <li><a href="{{route('my-posts')}}"> Mis publicaciones </a></li>
                        </ul>
                    </li>

                    <li><a href={{route('contact')}}>contacto</a></li>
                </ul><!--end navigation menu-->
            </div><!--end navigation-->
        @endif


        @if(isset($user) and $user->rol_id==\App\Models\User::ROL_CANDIDATE)
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li><a href="{{route('jobs')}}">Inicio</a></li>

{{--                    <li><a href="{{route('jobs-list')}}">Trabajos</a></li>--}}

                    <li class="has-submenu">
                        <a href="javascript:void(0)">Perfil</a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="{{route('candidate-profile')}}">Perfil</a></li>
                            <li><a href="{{route('my-applications')}}">Postulaciones</a></li>
                        </ul>
                    </li>

                    <li><a href={{route('contact')}}>contacto</a></li>
                </ul><!--end navigation menu-->
            </div><!--end navigation-->
        @endif


    </div>
</header>