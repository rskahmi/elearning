<aside class="sidebar">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="/" class="logo-wrapper" title="Home">
                <span class="sr-only">Home</span>
                <img src="{{asset('assets/img/logo/logogaruda.png') }}" alt="Logo {{ config('app.name') }}" width="80"
                    height="60">
            </a>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li>
                    <a class="{{ isRouteActive('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <span class="icon program-unggulan" aria-hidden="true"></span>
                        Dashboard
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li>
                    <a class="{{ isRouteActive('course.index') || isRouteActive('course.detail') || isRouteActive('assignment.detail') ? 'active' : '' }}"
                        href="{{ route('course.index') }}">
                        <span class="icon resume" aria-hidden="true"></span>
                        Perkuliahan
                    </a>

                </li>
            </ul>
        </div>

        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li>
                    <a class="{{ isRouteActive('discussion.all') ? 'active' : (isRouteActive('discussion.index') ? 'active' : '') }}"
                        href="{{ route('discussion.all') }}">
                        <span class="icon iso" aria-hidden="true"></span>
                        Diskusi
                    </a>
                </li>
            </ul>
        </div>

    </div>
    <div class="sidebar-footer">
        <ul class="sidebar-body-menu">
            <li>
                <a href="{{ route('logout') }}" id="btn-logout">
                    <span class="icon logout" aria-hidden="true"></span>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</aside>
