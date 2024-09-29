<aside class="sidebar user_sidebar">
    <div class="user-sidebar-menu-cnt" id="user-sidebar-menu-cnt">
        <div class="user-sidebar-menu-cnt-header">
            <a href="#" onclick="document.getElementById('user-sidebar-menu-cnt').classList.toggle('mobile-show'); return false;" class="user-sidebar-menu-title-show-minicart">
                Area Utente
                <span class="ico-accordion">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                        <path d="m256-424-56-56 280-280 280 280-56 56-224-223-224 223Z" />
                    </svg>
                </span>
            </a>
        </div>
        <div class="user-sidebar-menu-cnt-data">
            <h5>Area Utente</h5>
            <svg viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <path class="user_icon_path" d="M13.5 15.824c3.48-0 6.302-2.822 6.302-6.302s-2.822-6.302-6.302-6.302-6.302 2.822-6.302 6.302c0 0 0 0 0 0.001v-0c0.004 3.479 2.824 6.298 6.302 6.302h0zM13.5 4.72c2.652 0 4.802 2.15 4.802 4.802s-2.15 4.802-4.802 4.802c-2.652 0-4.802-2.15-4.802-4.802v-0c0.003-2.651 2.151-4.8 4.802-4.803h0zM13.5 18.033c-5.956 0.025-10.935 4.183-12.216 9.753l-0.016 0.085c-0.011 0.048-0.017 0.103-0.017 0.16 0 0.414 0.336 0.75 0.75 0.75 0.357 0 0.656-0.25 0.731-0.585l0.001-0.005c1.124-4.988 5.517-8.658 10.768-8.658s9.643 3.67 10.754 8.584l0.014 0.074c0.072 0.34 0.37 0.591 0.726 0.591 0.059 0 0.117-0.007 0.172-0.020l-0.005 0.001c0.34-0.076 0.59-0.375 0.59-0.733 0-0.057-0.006-0.112-0.018-0.165l0.001 0.005c-1.299-5.654-6.276-9.812-12.23-9.838h-0.003zM30.182 11.771c-1.239-0.335-2.325-0.812-3.317-1.426l0.053 0.030c-0.117-0.079-0.261-0.126-0.416-0.126s-0.299 0.047-0.419 0.128l0.003-0.002c-0.939 0.584-2.025 1.061-3.177 1.375l-0.086 0.020c-0.329 0.085-0.568 0.378-0.568 0.728 0 0.060 0.007 0.118 0.020 0.173l-0.001-0.005c0.234 1.015 1.537 6.078 4.229 6.078 2.693 0 3.996-5.063 4.229-6.079 0.012-0.050 0.019-0.108 0.019-0.168 0-0.35-0.239-0.643-0.563-0.727l-0.005-0.001zM26.502 17.245c-0.99 0-2.047-2.323-2.59-4.231 0.994-0.319 1.851-0.702 2.656-1.165l-0.066 0.035c0.739 0.428 1.596 0.811 2.493 1.103l0.096 0.027c-0.557 1.954-1.637 4.231-2.59 4.231z"></path>
            </svg>
            <div class="user-sidebar-menu-cnt">
                <ul class="user-sidebar-menu">
                    <li><a href="<?= route_to('web_dashboard') ?>">Dashboard</a></li>
                    <li><a href="<?= route_to('web_user_profile') ?>">Profilo</a></li>
                    <li><a href="<?= route_to('web_logout') ?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</aside>