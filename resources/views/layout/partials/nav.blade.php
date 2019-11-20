<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <img src="{{asset('images/zenicon3.png')}}" class="rounded float-left">
<a class="navbar-brand active" href="{{route('page.home')}}">Zen Sushi</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" href="{{route('page.items')}}" id="navbardrop">
                    Inventory
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="{{ route('page.production') }}" id="navbardrop">
                    Production
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="{{ route('page.records') }}" id="navbardrop">
                    Records
                </a>
            </li>
           
        </ul>
        <ul class="nav navbar-nav">
            <li class="nav-item" id="Notification_navItem">
                <a class="nav-link" href="../../pages/notification-page/notification.html">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    <b id="usernameAtNavabar">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </b>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    {{-- <a class="dropdown-item" id="LogOut">Log Out</a> --}}
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>



{{--
<div class="navbar navbar-expand-sm navbar-light bg-inverse ">
    <a class="navbar-brand" href="/">App Name</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav mr-auto">
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/about-us">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/grants">Grants</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/solution">Solution</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/support-us">Support Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contact-us">Contact</a>
            </li>
        </ul>
    </div>
</div> --}}
