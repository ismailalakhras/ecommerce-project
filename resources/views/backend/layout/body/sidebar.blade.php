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


        {{-- <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Subcategory</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('admin.subcategory.index') }}">
                        <i class="bx bx-right-arrow-alt"></i>
                        All Subcategories
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.subcategory.create') }}">
                        <i class="bx bx-right-arrow-alt"></i>
                        New Subcategory
                    </a>
                </li>
            </ul>
        </li> --}}


        <li>
            <a href="{{ route('admin.user.index') }}" class="has-arrow no-after ">
                <div class="parent-icon"><img  style="width:25px" src="{{asset('images/user.svg')}}" alt="">
                </div>
                <div class="menu-title ">User</div>
            </a>

        </li>


        <li>
            <a href="{{ route('admin.category.index') }}" class="has-arrow no-after ">
                <div class="parent-icon"><img  style="width:25px" src="{{asset('images/category.svg')}}" alt="">
                </div>
                <div class="menu-title ">Category</div>
            </a>

        </li>

        <li>
            <a href="{{ route('admin.subcategory.index') }}" class="has-arrow no-after">
                <div class="parent-icon"><img  style="width:25px" src="{{asset('images/subcategory.svg')}}" alt="">
                </div>
                <div class="menu-title">Subcategory</div>
            </a>

        </li>

        <li>
            <a href="{{ route('admin.product.index') }}" class="has-arrow no-after">
                <div class="parent-icon"><img  style="width:25px" src="{{asset('images/product.svg')}}" alt="">
                </div>
                <div class="menu-title">Product</div>
            </a>

        </li>

        <li>
            <a href="{{ route('admin.order.index') }}" class="has-arrow no-after">
                <div class="parent-icon"><img  style="width:25px" src="{{asset('images/order.svg')}}" alt="">
                </div>
                <div class="menu-title">Order</div>
            </a>

        </li>

        <li>
            <a href="{{ route('admin.coupon.index') }}" class="has-arrow no-after">
                <div class="parent-icon"><img  style="width:25px" src="{{asset('images/order.svg')}}" alt="">
                </div>
                <div class="menu-title">Coupon</div>
            </a>

        </li>

    </ul>
    <!--end navigation-->
</div>
