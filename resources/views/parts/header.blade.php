<header data-header class="active">
    <div class="header__wrapper">
        <a href="/home" class="header__title" aria-label="Go to frontpage">
            <div class="header__title--icon"></div>
            <div class="header__title--iconText"></div>
        </a>
        <div class="header__menu--button">
            <button class="hamburger hamburger--collapse" type="button" data-menu-button data-button-accordian="hamburger-menu" aria-label="Navigation menu">
                <span class="hamburger-box">
                  <span class="hamburger-inner"></span>
                </span>
              </button>
        </div>
    </div>
    <div class="menu__wrapper" data-target-accordian="hamburger-menu">
        <div class="menu__content--wrapper">
            <nav>
                <ul>
                    <li><a href="{{ route('lists') }}">Lists</a></li>
                    @can('viewAny', App\Models\User::class)
                        <li><a href="{{ route('users') }}">Users</a></li>
                    @endcan
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button>Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>