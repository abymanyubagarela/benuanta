
<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item <?= $parent=='dashboard'?'active':'' ?>" data-item="dashboard">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item <?= $parent=='peminjaman'?'active':'' ?>" data-item="extrakits">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Arrow-Loop"></i>
                    <span class="nav-text">Peminjaman</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item <?= $parent=='pengembalian'?'active':'' ?>" data-item="apps">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Arrow-Mix"></i>
                    <span class="nav-text">Pengembalian</span>
                </a>
                <div class="triangle"></div>
            </li>
        </ul>
    </div>
    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <header>
            <div class="logo">
                <img src="<?= base_url().'dist-assets/'?>images/logo-text.png" alt="">
            </div>
        </header>
        <!-- Submenu Dashboards -->
        <div class="submenu-area" data-parent="dashboard">
            <header>
                <h6>Dashboards</h6>
            </header>
            <ul class="childNav">
                <li class="nav-item">
                    <a href="<?= base_url().'welcome'; ?>">
                        <i class="nav-icon i-Bar-Chart-2"></i>
                        <span class="item-name">Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="submenu-area" data-parent="extrakits">
            <header>
                <h6>Peminjaman</h6>
            </header>
            <ul class="childNav">
                <li class="nav-item">
                    <a href="<?= base_url().'peminjaman-kendaraan'; ?>">
                        <i class="nav-icon i-Bicycle"></i>
                        <span class="item-name">Kendaraan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url().'peminjaman-ruangan'; ?>">
                        <i class="nav-icon i-Blackboard"></i>
                        <span class="item-name">Ruangan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url().'peminjaman-perangkat-it'; ?>"> 
                        <i class="nav-icon i-Wireless"></i>
                        <span class="item-name">Perangkat IT</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="submenu-area" data-parent="apps">
            <header>
                <h6>Pengembalian</h6>
            </header>
            <ul class="childNav">
                <li class="nav-item">
                    <a href="<?= base_url().'peminjaman-kendaraan/pengembalian'; ?>">
                        <i class="nav-icon i-Bicycle"></i>
                        <span class="item-name">Kendaraan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url().'peminjaman-ruangan/pengembalian'; ?>">
                        <i class="nav-icon i-Blackboard"></i>
                        <span class="item-name">Ruangan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url().'peminjaman-perangkat-it/pengembalian'; ?>"> 
                        <i class="nav-icon i-Wireless"></i>
                        <span class="item-name">Perangkat IT</span>
                    </a>
                </li>
            </ul>
        </div>


    </div>
</div>