<header class="container-fluid bg-light p-3 mb-4 position-strip w-100 top-0">
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
                            <a class="nav-link {{ request()->routeIs('user.list') ? 'active' : '' }} me-2 "  href="{{ route('user.list') }}">
                                <i class="fas fa-address-book"></i> {{ __('Users') }}
                            </a>
                        </li>
                        @can('is_admin')
                        <li class="nav-item active">
                            <a class="nav-link {{ request()->routeIs('employee.index') ? 'active' : '' }} me-2" href="{{ route('employee.index') }}">
                              <i class="fas fa-user-tie"></i> {{ __('Employee') }}
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link {{ request()->routeIs('hospital.index') ? 'active' : '' }} me-2" href="{{ route('hospital.index') }}">
                              <i class="fas fa-hospital"></i> {{ __('Hospital') }}
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link {{ request()->routeIs('package.index') ? 'active' : '' }} me-2" href="{{ route('package.index') }}">
                             <i class="fas fa-list-check"></i> {{ __('Package') }}
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link {{ request()->routeIs('checkup.history') ? 'active' : '' }} me-2" href="{{ route('checkup.history') }}">
                             <i class="fas fa-clipboard-list"></i> {{ __('Check-up History') }}
                            </a>
                        </li>
                        @endcan
                    </ul>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-outline-success my-2 my-sm-0 ml-auto" type="submit" name="logout">
                          <i class="fas fa-right-from-bracket"></i>  {{ __('Logout') }}
                        </button>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</header>
