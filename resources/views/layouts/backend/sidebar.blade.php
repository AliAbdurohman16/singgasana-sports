<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <img src="{{ asset('backend') }}/assets/images/logo/Logo-SSRC-cut.png" alt="Logo"/>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ Request::is('dashboard*') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub {{ Request::is(['write_articles*', 'article*', 'category*']) ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-pen-fill"></i>
                        <span>Artikel</span>
                    </a>
                    <ul class="submenu {{ Request::is(['write_articles*', 'article*', 'category*']) ? 'active' : '' }}">
                        <li class="submenu-item {{ Request::is('write_articles*') ? 'active' : '' }}">
                            <a href="{{ route('write_articles.index') }}">Tulis Artikel</a>
                        </li>
                        <li class="submenu-item {{ Request::is('article*') ? 'active' : '' }}">
                            <a href="{{ route('article.index') }}">Artikel Blog</a>
                        </li>
                        <li class="submenu-item {{ Request::is('category*') ? 'active' : '' }}">
                            <a href="{{ route('category.index') }}">Kategori Artikel</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item {{ Request::is('page*') ? 'active' : '' }}">
                    <a href="{{ route('page.index') }}" class="sidebar-link">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span>Halaman</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('facility*') ? 'active' : '' }}">
                    <a href="{{ route('facility.index') }}" class="sidebar-link">
                        <i class="bi bi-journal-check"></i>
                        <span>Fasilitas</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('membership*') ? 'active' : '' }}">
                    <a href="{{  route('membership.index') }}" class="sidebar-link">
                        <i class="bi bi-ticket-detailed-fill"></i>
                        <span>Data Booking</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub {{ Request::is(['gallery_categories*', 'gallery_images*']) ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-image-fill"></i>
                        <span>Galeri</span>
                    </a>
                    <ul class="submenu {{ Request::is(['gallery_categories*', 'gallery_images*']) ? 'active' : '' }}">
                        <li class="submenu-item {{ Request::is('gallery_categories*') ? 'active' : '' }}">
                            <a href="{{ route('gallery_categories.index') }}">Kategori Foto</a>
                        </li>
                        <li class="submenu-item {{ Request::is('gallery_images*') ? 'active' : '' }}">
                            <a href="{{ route('gallery_images.index') }}">Foto</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-title">Akun &amp; Pengaturan</li>

                <li class="sidebar-item has-sub {{ Request::is(['profile*', 'change_password*']) ? 'active' : '' }}">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-person-badge-fill"></i>
                        <span>Akun</span>
                    </a>
                    <ul class="submenu {{ Request::is(['profile*', 'change_password*']) ? 'active' : '' }}">
                        <li class="submenu-item {{ Request::is('profile*') ? 'active' : '' }}">
                            <a href="{{ route('profile.index') }}">Profil</a>
                        </li>
                        <li class="submenu-item {{ Request::is('change_password*') ? 'active' : '' }}">
                            <a href="{{ route('change_password.index') }}">Ganti Kata Sandi</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item {{ Request::is('setting*') ? 'active' : '' }}">
                    <a href="{{ route('setting.index') }}" class="sidebar-link">
                        <i class="bi bi-gear-fill"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{ route('logout') }}" class="sidebar-link"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        <i class="bi bi-door-open"></i>
                        <span>Keluar</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
