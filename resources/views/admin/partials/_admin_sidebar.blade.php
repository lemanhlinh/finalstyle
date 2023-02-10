<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">@lang('form.final_style')</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item @if (request()->is('admin/users*')) menu-open @endif">
                    <a href="#" class="nav-link @if (request()->is('admin/users*')) active @endif">
                        <i class="fas fa-user"></i>
                        <p>
                            @lang('form.user.title')
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link @if (request()->is('admin/users*')) active @endif">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    @lang('form.user.manage')
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                @can('view_article')
                    <li class="nav-item @if (request()->is('admin/article*')) menu-open @endif">
                        <a href="#" class="nav-link @if (request()->is('admin/article*')) active @endif">
                            <i class="fas fa-newspaper"></i>
                            <p>
                                @lang('form.article.')
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.article-category.index') }}" class="nav-link @if (request()->is('admin/article-category')) active @endif">
                                    <i class="nav-icon fas fa-child"></i>
                                    <p>
                                        @lang('form.article_category.manage')
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.article.index') }}" class="nav-link @if (request()->is('admin/article')) active @endif">
                                    <i class="nav-icon fas fa-child"></i>
                                    <p>
                                        @lang('form.article.')
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan
                @can('view_role')
                    <li class="nav-item">
                        <a href="{{ route('admin.roles.index') }}" class="nav-link @if (request()->is('admin/role*')) active @endif">
                            <i class="nav-icon far fa-plus-square" aria-hidden="true"></i>
                            <p>
                                @lang('form.roles.')
                            </p>
                        </a>
                    </li>
                @endcan
                @can(['view_article'])
                    <li class="nav-item">
                        <a href="{{ route('admin.setting.index') }}" class="nav-link @if (request()->is('admin/setting*')) active @endif">
                            <i class="nav-icon fas fa-school"></i>
                            <p>
                                @lang('form.setting.manage')
                            </p>
                        </a>
                    </li>
                @endcan
                @can('view_roll_call')
                    <li class="nav-item">
                        <a href="{{ route('admin.roll-calls.index') }}" class="nav-link @if (request()->is('admin/roll-call*')) active @endif">
                            <i class="nav-icon fas fa-check"></i>
                            <p>
                                @lang('form.roll_call.')
                            </p>
                        </a>
                    </li>
                @endcan
                @can('view_manner')
                    <li class="nav-item">
                        <a href="{{ route('admin.trainee-manners.index') }}" class="nav-link @if (request()->is('admin/trainee-manner*')) active @endif">
                            <i class="nav-icon fas fa-gavel"></i>
                            <p>
                                @lang('form.trainee_manner.')
                            </p>
                        </a>
                    </li>
                @endcan
                @can('view_lesson_scores')
                    <li class="nav-item">
                        <a href="{{ route('admin.lesson-scores.index') }}" class="nav-link @if (request()->is('admin/lesson-score*')) active @endif">
                            <i class="nav-icon fa fa-fax"></i>
                            <p>
                                @lang('form.lesson_scores.')
                            </p>
                        </a>
                    </li>
                @endcan
                @can('view_order')
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}" class="nav-link @if (request()->is('admin/order*')) active @endif">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                @lang('form.order.manage')
                            </p>
                        </a>
                    </li>
                @endcan
                @can('view_company')
                    <li class="nav-item">
                        <a href="{{ route('admin.companies.index') }}" class="nav-link @if (request()->is('admin/companies*')) active @endif">
                            <i class="nav-icon far fa-building"></i>
                            <p>
                                @lang('form.companies.manage')
                            </p>
                        </a>
                    </li>
                @endcan
                @can('view_work')
                    <li class="nav-item">
                        <a href="{{ route('admin.works.index') }}" class="nav-link @if (request()->is('admin/work*')) active @endif">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                @lang('form.manage_work')
                            </p>
                        </a>
                    </li>
                @endcan

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
