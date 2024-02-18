<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
            <li class="nav-item">
                <a href="{{ route('index') }}" class="nav-link">
                    <i class="nav-icon fas fa-backward"></i>
                    <p>
                        Вернуться на сайт
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.request.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Записи
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.category.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-tag"></i>
                    <p>
                        Категории
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.service.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-sticky-note"></i>
                    <p>
                        Услуги
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.image.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-image"></i>
                    <p>
                        Мои работы
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.rest.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-calendar"></i>
                    <p>
                        Нерабочие дни
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</aside>
