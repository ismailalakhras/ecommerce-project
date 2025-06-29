<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Rukada</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Category</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.category.index') }}">
                        <i class="bx bx-right-arrow-alt"></i>
                        All Categories
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.category.store') }}">
                        <i class="bx bx-right-arrow-alt"></i>
                        Create New Category
                    </a>
                </li>

            </ul>
        </li>

    </ul>
    <!--end navigation-->
</div>
