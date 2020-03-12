<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-users nav-icon">

                        </i>
                        {{ trans('cruds.userManagement.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('permission_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-unlock-alt nav-icon">

                                    </i>
                                    {{ trans('cruds.permission.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-briefcase nav-icon">

                                    </i>
                                    {{ trans('cruds.role.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-user nav-icon">

                                    </i>
                                    {{ trans('cruds.user.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('item_category_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-tasks nav-icon">

                        </i>
                        {{ trans('cruds.itemCategory.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('brand_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.brands.index") }}" class="nav-link {{ request()->is('admin/brands') || request()->is('admin/brands/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-bars nav-icon">

                                    </i>
                                    {{ trans('cruds.brand.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('item_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.items.index") }}" class="nav-link {{ request()->is('admin/items') || request()->is('admin/items/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-shopping-cart nav-icon">

                                    </i>
                                    {{ trans('cruds.item.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('requestor_access')
                <li class="nav-item nav-dropdown">
                    <a class="nav-link  nav-dropdown-toggle" href="#">
                        <i class="fa-fw fas fa-user nav-icon">

                        </i>
                        {{ trans('cruds.requestor.title') }}
                    </a>
                    <ul class="nav-dropdown-items">
                        @can('account_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.accounts.index") }}" class="nav-link {{ request()->is('admin/accounts') || request()->is('admin/accounts/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-list-ul nav-icon">

                                    </i>
                                    {{ trans('cruds.account.title') }}
                                </a>
                            </li>
                        @endcan
                        @can('department_access')
                            <li class="nav-item">
                                <a href="{{ route("admin.departments.index") }}" class="nav-link {{ request()->is('admin/departments') || request()->is('admin/departments/*') ? 'active' : '' }}">
                                    <i class="fa-fw fas fa-list-ul nav-icon">

                                    </i>
                                    {{ trans('cruds.department.title') }}
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('approved_request_access')
                <li class="nav-item">
                    <a href="{{ route("admin.approved-requests.index") }}" class="nav-link {{ request()->is('admin/approved-requests') || request()->is('admin/approved-requests/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-list-alt nav-icon">

                        </i>
                        Item Requests
                    </a>
                </li>
            @endcan
            @can('item_release_record_access')
                <li class="nav-item">
                    <a href="{{ route("admin.item-release-records.index") }}" class="nav-link {{ request()->is('admin/item-release-records') || request()->is('admin/item-release-records/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-clipboard-list nav-icon">

                        </i>
                        {{ trans('cruds.itemReleaseRecord.title') }}
                    </a>
                </li>
            @endcan
            @can('supplier_access')
            <li class="nav-item">
                <a href="{{ route("admin.suppliers.index") }}" class="nav-link {{ request()->is('admin/suppliers') || request()->is('admin/suppliers/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-user nav-icon">

                    </i>
                    {{ trans('cruds.supplier.title') }}
                </a>
            </li>
            @endcan
                 
          
          <!--  <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li> -->
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>