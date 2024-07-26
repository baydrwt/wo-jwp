<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Feature</div>
                <a class="nav-link {{ Request::is('dashboard/katalogs*') ? 'active' : '' }}" href="/dashboard/katalogs">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                    Katalogs
                </a>
                <a class="nav-link {{ Request::is('dashboard/orders*') ? 'active' : '' }}" href="/dashboard/orders">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-receipt"></i></div>
                    Orders
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->username }}
        </div>
    </nav>
</div>