<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li>
                <a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="/home">Dashboard</a></li>
                </ul>
            </li>
            <li>
                <a><i class="fa fa-home"></i> Projects <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    @foreach (menu('projects') as $link => $item)
                    <li><a href="{{ $link }}">{{ $item }}</a></li>
                    @endforeach

                </ul>
            </li>
            <li>
                <a><i class="fa fa-home"></i> Passwords <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  @foreach (menu('passwords') as $link => $item)
                  <li><a href="{{ $link }}">{{ $item }}</a></li>
                  @endforeach
                </ul>
            </li>
            <li>
                <a><i class="fa fa-home"></i> Settings <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="/settings/profile">Profile</a></li>
                  <li><a href="/settings/password-types">Password Types</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
