<aside class="sidebar lcuser-sidebar">
    <div class="lcuser-sidebar-menu-cnt" id="lcuser-sidebar-menu-cnt">
        <div class="lcuser-sidebar-menu-cnt-header">
            <a href="#" onclick="document.getElementById('lcuser-sidebar-menu-cnt').classList.toggle('mobile-show'); return false;" class="lcuser-sidebar-menu-title-show-minicart">
                Area Utente
                <span class="ico-accordion">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                        <path d="m256-424-56-56 280-280 280 280-56 56-224-223-224 223Z" />
                    </svg>
                </span>
            </a>
        </div>
        <div class="lcuser-sidebar-menu-cnt-data">
            <h6>Area Utente</h6>
            <div class="lcuser-sidebar-menu-nav">
                <ul class="lcuser-sidebar-menu">
                    <li><a href="<?= route_to('web_dashboard') ?>">Dashboard</a></li>
                    <li><a href="<?= route_to('web_user_profile') ?>">Profilo</a></li>

                    <li><a href="<?= route_to('web_user_orders') ?>">Ordini</a></li>
                    <li><a href="<?= route_to('web_logout') ?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</aside>