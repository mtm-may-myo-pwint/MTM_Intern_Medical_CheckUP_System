<header class="container-fluid bg-light p-3 mb-4">
    @php
        use App\Constants\GeneralConst;
    @endphp
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="{{ route('user.list') }}">{{ GeneralConst::APP_NAME }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.list') ? 'active' : '' }} me-2 "  href="{{ route('user.list') }}">{{ __('Users') }}</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link {{ request()->routeIs('hospital.index') ? 'active' : '' }} me-2" href="{{ route('hospital.index') }}">
                              {{ __('Hospital') }}
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link {{ request()->routeIs('package.index') ? 'active' : '' }} me-2" href="{{ route('package.index') }}">
                              {{ __('Package') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{ __('Settings') }}</a>
                        </li>
                    </ul>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-outline-success my-2 my-sm-0 ml-auto" type="submit" name="logout">
                            {{ __('Logout') }}
                        </button>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</header>
