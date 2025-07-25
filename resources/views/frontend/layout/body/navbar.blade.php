          @php
              $categories = App\Models\Category::with('subcategories')->get();
          @endphp

          <!-- Header  -->
          <header class="header-area header-style-1 header-height-2">
              <div class="mobile-promotion">
                  <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong>
                      left</span>
              </div>
              <div class="header-top header-top-ptb-1 d-none d-lg-block">
                  <div class="container">
                      <div class="row align-items-center">
                          <div class="col-xl-3 col-lg-4">
                              <div class="header-info">
                                  <ul>
                                      <li><a href="page-account.html">My Cart</a></li>
                                      <li><a href="shop-wishlist.html">Checkout</a></li>
                                      <li><a href="shop-order.html">Order Tracking</a></li>
                                  </ul>
                              </div>
                          </div>
                          <div class="col-xl-6 col-lg-4">
                              <div class="text-center">
                                  <div id="news-flash" class="d-inline-block">
                                      <ul>
                                          <li>100% Secure delivery without contacting the courier</li>
                                          <li>Supper Value Deals - Save more with coupons</li>
                                          <li>Trendy 25silver jewelry, save up 35% off today</li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                          <div class="col-xl-3 col-lg-4">
                              <div class="header-info header-info-right">
                                  <ul>

                                      <li>
                                          <a class="language-dropdown-active" href="#">English <i
                                                  class="fi-rs-angle-small-down"></i></a>
                                          <ul class="language-dropdown">
                                              <li>
                                                  <a href="#"><img
                                                          src="{{ asset('build/assets/imgs/theme/flag-fr.png') }}"
                                                          alt="" />Français</a>
                                              </li>
                                              <li>
                                                  <a href="#"><img
                                                          src="{{ asset('build/assets/imgs/theme/flag-dt.png') }}"
                                                          alt="" />Deutsch</a>
                                              </li>
                                              <li>
                                                  <a href="#"><img
                                                          src="{{ asset('build/assets/imgs/theme/flag-ru.png') }}"
                                                          alt="" />Pусский</a>
                                              </li>
                                          </ul>
                                      </li>

                                      <li>Need help? Call Us: <strong class="text-brand"> + 1800 900</strong></li>

                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
                  <div class="container">
                      <div class="header-wrap">



                          <div class="logo logo-width-1">
                              <a href="index.html"><img src="{{ asset('build/assets/imgs/theme/logo.svg') }}"
                                      alt="logo" /></a>
                          </div>

                          <div class="search-style-2">
                              <form action="#">
                                  <select class="select-active">
                                      <option>All Categories</option>

                                      @foreach ($categories as $category)
                                          <option>{{ $category->name }}</option>
                                      @endforeach
                                  </select>
                                  <input type="text" placeholder="Search for items..." />
                              </form>
                          </div>


                          <div class="header-right">
                              <div class="header-action-right">
                                  <div class="header-action-2">


                                      {{-- <div class="header-action-icon-2">
                                    <a href="shop-wishlist.html">
                                        <img class="svgInject" alt="Nest"
                                            src="build/assets/imgs/theme/icons/icon-heart.svg" />
                                        <span class="pro-count blue">0</span>
                                    </a>
                                    <a href="shop-wishlist.html"><span class="lable">Wishlist</span></a>
                                </div> --}}


                                      <div class="header-action-icon-2">
                                          <a class="mini-cart-icon" href="{{ route('cart.index') }}">
                                              <img alt="Nest"
                                                  src="{{ asset('build/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                              @if (auth()->check())
                                                  <span id="cartCount" class="pro-count blue">

                                                      @if (isset($shoppingCart) && $shoppingCart->count())
                                                          {{ $shoppingCart->count() }}
                                                      @else
                                                          0
                                                      @endif

                                                  </span>
                                              @endif
                                          </a>
                                          <a class="update-hidden-total-price" href="{{ route('cart.index') }}"><span
                                                  class="lable">Cart</span></a>

                                          @if (auth()->check())

                                              <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                                  <ul id="dropdown-cart">

                                                      @if (isset($shoppingCart) && $shoppingCart->count())
                                                          @foreach ($shoppingCart as $product)
                                                              <li class="product-to-delete-{{ $product->product->id }}" data-id="{{$product->product->id}}">
                                                                  <div class="shopping-cart-img">
                                                                      <a href="">
                                                                          <img
                                                                              src="{{ asset($product->product->image) }}" />
                                                                      </a>
                                                                  </div>
                                                                  <div class="shopping-cart-title">
                                                                      <h4>
                                                                          <a
                                                                              href="">{{ $product->product->name }}</a>
                                                                      </h4>
                                                                      <h4>
                                                                          <span
                                                                              data-id="{{ $product->product->id }}">{{ $product->quantity }}
                                                                              ×
                                                                          </span>${{ $product->price }}
                                                                      </h4>
                                                                  </div>




                                                                  <button class="delete-btn" type="button"
                                                                      data-id="{{ $product->product->id }}"
                                                                      style="border-radius : 100% !important ; width:35px;height :35px"><i
                                                                          style="font-size:20px"
                                                                          class="fi-rs-trash"></i></button>


                                                              </li>
                                                          @endforeach
                                                      @else
                                                          No item added to cart
                                                      @endif


                                                  </ul>
                                                  <div class="shopping-cart-footer d-flex">

                                                      <div class="shopping-cart-total ">
                                                          <h4>Total
                                                              <span id="totalPriceCart" class="total-price-cart">

                                                                  @php $total = 0; @endphp

                                                                  @if (isset($shoppingCart) && $shoppingCart->count())
                                                                      @foreach ($shoppingCart as $product)
                                                                          @php $total += $product->total; @endphp
                                                                      @endforeach

                                                                      $ {{ $total }}
                                                                  @else
                                                                      0
                                                                  @endif
                                                              </span>
                                                          </h4>
                                                      </div>

                                                      <a href="{{ route('cart.index') }}"
                                                          class="products-btn-add-cart update-hidden-total-price"
                                                          style="flex: 1; margin-left:15px ; display:flex !important;align-item:center;justify-content:center"><i
                                                              class=" mr-5"></i>Go to cart
                                                      </a>
                                                  </div>
                                              </div>

                                          @endif

                                      </div>


                                      {{-- @dd({{ explode(' ', auth()->user()->name)[0] }}) --}}




                                      @if (auth()->check())
                                          <div class="header-action-icon-2">
                                              <a href="page-account.html">
                                                  <img class="svgInject" alt="Nest"
                                                      src="{{ asset('build/assets/imgs/theme/icons/icon-user.svg') }}" />
                                              </a>
                                              <a href="page-account.html"><span class="lable ml-0">Account</span></a>
                                              <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                                  <ul>
                                                      <li>
                                                          <a href="page-account.html"><i
                                                                  class="fi fi-rs-user mr-10"></i>{{ ucfirst(explode(' ', auth()->user()->name)[0]) }}</a>
                                                      </li>
                                                      <li>
                                                          <a href="page-account.html"><i
                                                                  class="fi fi-rs-location-alt mr-10"></i>Order
                                                              Tracking</a>
                                                      </li>
                                                      <li>
                                                          <a href="page-account.html"><i
                                                                  class="fi fi-rs-label mr-10"></i>My
                                                              Voucher</a>
                                                      </li>
                                                      <li>
                                                          <a href="shop-wishlist.html"><i
                                                                  class="fi fi-rs-heart mr-10"></i>My
                                                              Wishlist</a>
                                                      </li>
                                                      <li>
                                                          <a href="page-account.html"><i
                                                                  class="fi fi-rs-settings-sliders mr-10"></i>Setting</a>
                                                      </li>
                                                      <li>


                                                          <form method="POST" action="{{ route('logout') }}">
                                                              @csrf

                                                              <button type="submit" class="delete-btn">
                                                                  <img style="width: 30px " class="svgInject"
                                                                      alt="Nest"
                                                                      src="{{ asset('build/assets/imgs/theme/icons/logout-svgrepo-com.svg') }}" />



                                                                  {{ __('Log Out') }}

                                                              </button>

                                                          </form>


                                                      </li>
                                                  </ul>
                                              </div>
                                          </div>
                                      @else
                                          <a href="{{ route('login') }}">
                                              <img class="svgInject" alt="Nest"
                                                  src="{{ asset('build/assets/imgs/theme/icons/icon-user.svg') }}" />
                                          </a>
                                          <a href="{{ route('login') }}"><span class="lable ml-0">Login</span></a>
                                      @endif



                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>








              <div class="header-bottom header-bottom-bg-color sticky-bar">
                  <div class="container">
                      <div class="header-wrap header-space-between position-relative">
                          <div class="logo logo-width-1 d-block d-lg-none">
                              <a href="index.html"><img src="{{ asset('build/assets/imgs/theme/logo.svg') }}"
                                      alt="logo" /></a>
                          </div>
                          <div class="header-nav d-none d-lg-flex">

                              <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                                  <nav>
                                      <ul>

                                          <li>
                                              <a class="active home-btn">Home </a>

                                          </li>
                                          <li>
                                              <a href="#">About</a>
                                          </li>



                                          {{-- Mega menu --}}
                                          <li class="position-static">
                                              <a href="#">Categories <i class="fi-rs-angle-down"></i></a>
                                              <ul class="mega-menu">

                                                  @foreach ($categories as $category)
                                                      <li class="sub-mega-menu sub-mega-menu-width-100">
                                                          <button class="fetchProductByCategory-btn"
                                                              style=" display: flex;
                                                                align-items: center;  
                                                                padding: 0;
                                                                margin:0 ;  
                                                                line-height: 1.5;
                                                                height: 50px;  
                                                                color: #253d4e; 
                                                                font-size: 14px;
                                                                background: none;  
                                                                border: none;  
                                                                gap: 5px;
                                                                width:100%;
                                                                background-color: #eeeeee;
                                                                padding: 5px 10px;
                                                                border-radius: 5px;
                                                                font-weight: 600;
                                                                "
                                                              data-id="{{ $category->id }}">

                                                              <img style="width:30px"
                                                                  src="{{ asset($category->image) }}"
                                                                  alt="" />
                                                              {{ $category->name }}
                                                              <span class="count-2"
                                                                  style="">{{ $category->products->count() }}</span>

                                                          </button>
                                                          <ul>
                                                              @foreach ($category->subcategories as $subcategory)
                                                                  <li><button class="fetchProductBySubcategory-btn"
                                                                          style=" display: flex;
                                                                            align-items: center;  
                                                                            padding: 0 0 0 10px;
                                                                            margin:0 ;
                                                                            line-height: 1.5;  
                                                                            color: #253d4e; 
                                                                            font-size: 14px;
                                                                            background: none;  
                                                                            border: none;  
                                                                            gap: 5px;
                                                                            width:100%"
                                                                          data-id="{{ $subcategory->id }}">

                                                                          <img style="width:30px"
                                                                              src="{{ asset($subcategory->image) }}"
                                                                              alt="" />
                                                                          {{ $subcategory->name }}


                                                                      </button>
                                                                  </li>
                                                              @endforeach

                                                          </ul>
                                                      </li>
                                                  @endforeach




                                              </ul>
                                          </li>

                                          <li>
                                              <a href="#">Pages <i class="fi-rs-angle-down"></i></a>
                                              <ul class="sub-menu">
                                                  <li><a href="#">Contact</a></li>
                                                  <li><a href="#">Privacy Policy</a></li>
                                                  <li><a href="#">Terms of Service</a></li>
                                                  <li><a href="{{ route('order.index') }}">My orders</a></li>
                                              </ul>
                                          </li>
                                          <li>
                                              <a href="#">Contact</a>
                                          </li>
                                      </ul>
                                  </nav>
                              </div>
                          </div>



                          <div class="header-action-icon-2 d-block d-lg-none">
                              <div class="burger-icon burger-icon-white">
                                  <span class="burger-icon-top"></span>
                                  <span class="burger-icon-mid"></span>
                                  <span class="burger-icon-bottom"></span>
                              </div>
                          </div>
                          {{-- <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="shop-wishlist.html">
                                    <img alt="Nest" src="build/assets/imgs/theme/icons/icon-heart.svg" />
                                    <span class="pro-count white">4</span>
                                </a>
                            </div>



                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="#">
                                    <img alt="Nest" src="build/assets/imgs/theme/icons/icon-cart.svg" />
                                    <span class="pro-count white"></span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="shop-product-right.html"><img alt="Nest"
                                                        src="build/assets/imgs/shop/thumbnail-3.jpg" /></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="shop-product-right.html">Plain Striola Shirts</a></h4>
                                                <h3><span>1 × </span>$800.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="shop-product-right.html"><img alt="Nest"
                                                        src="build/assets/imgs/shop/thumbnail-4.jpg" /></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="shop-product-right.html">Macbook Pro 2022</a></h4>
                                                <h3><span>1 × </span>$3500.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>$383.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="shop-cart.html">View cart</a>
                                            <a href="shop-checkout.html">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                      </div>
                  </div>
              </div>
          </header>

          <!-- End Header  -->




          <div class="mobile-header-active mobile-header-wrapper-style">
              <div class="mobile-header-wrapper-inner">
                  <div class="mobile-header-top">
                      <div class="mobile-header-logo">
                          <a href="index.html"><img src="{{ asset('build/assets/imgs/theme/logo.svg') }}"
                                  alt="logo" /></a>
                      </div>
                      <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                          <button class="close-style search-close">
                              <i class="icon-top"></i>
                              <i class="icon-bottom"></i>
                          </button>
                      </div>
                  </div>
                  <div class="mobile-header-content-area">
                      <div class="mobile-search search-style-3 mobile-header-border">
                          <form action="#">
                              <input type="text" placeholder="Search for items…" />
                              <button type="submit"><i class="fi-rs-search"></i></button>
                          </form>
                      </div>
                      <div class="mobile-menu-wrap mobile-header-border">
                          <!-- mobile menu start -->
                          <nav>
                              <ul class="mobile-menu font-heading">
                                  <li class="menu-item-has-children">
                                      <a href="index.html">Home</a>

                                  </li>
                                  <li class="menu-item-has-children">
                                      <a href="shop-grid-right.html">shop</a>
                                      <ul class="dropdown">
                                          <li><a href="shop-grid-right.html">Shop Grid – Right Sidebar</a></li>
                                          <li><a href="shop-grid-left.html">Shop Grid – Left Sidebar</a></li>
                                          <li><a href="shop-list-right.html">Shop List – Right Sidebar</a></li>
                                          <li><a href="shop-list-left.html">Shop List – Left Sidebar</a></li>
                                          <li><a href="shop-fullwidth.html">Shop - Wide</a></li>
                                          <li class="menu-item-has-children">
                                              <a href="#">Single Product</a>
                                              <ul class="dropdown">
                                                  <li><a href="shop-product-right.html">Product – Right Sidebar</a>
                                                  </li>
                                                  <li><a href="shop-product-left.html">Product – Left Sidebar</a></li>
                                                  <li><a href="shop-product-full.html">Product – No sidebar</a></li>
                                                  <li><a href="shop-product-vendor.html">Product – Vendor Infor</a>
                                                  </li>
                                              </ul>
                                          </li>
                                          <li><a href="shop-filter.html">Shop – Filter</a></li>
                                          <li><a href="shop-wishlist.html">Shop – Wishlist</a></li>
                                          <li><a href="shop-cart.html">Shop – Cart</a></li>
                                          <li><a href="shop-checkout.html">Shop – Checkout</a></li>
                                          <li><a href="shop-compare.html">Shop – Compare</a></li>
                                          <li class="menu-item-has-children">
                                              <a href="#">Shop Invoice</a>
                                              <ul class="dropdown">
                                                  <li><a href="shop-invoice-1.html">Shop Invoice 1</a></li>
                                                  <li><a href="shop-invoice-2.html">Shop Invoice 2</a></li>
                                                  <li><a href="shop-invoice-3.html">Shop Invoice 3</a></li>
                                                  <li><a href="shop-invoice-4.html">Shop Invoice 4</a></li>
                                                  <li><a href="shop-invoice-5.html">Shop Invoice 5</a></li>
                                                  <li><a href="shop-invoice-6.html">Shop Invoice 6</a></li>
                                              </ul>
                                          </li>
                                      </ul>
                                  </li>

                                  <li class="menu-item-has-children">
                                      <a href="#">Mega menu</a>
                                      <ul class="dropdown">
                                          <li class="menu-item-has-children">
                                              <a href="#">Women's Fashion</a>
                                              <ul class="dropdown">
                                                  <li><a href="shop-product-right.html">Dresses</a></li>
                                                  <li><a href="shop-product-right.html">Blouses & Shirts</a></li>
                                                  <li><a href="shop-product-right.html">Hoodies & Sweatshirts</a></li>
                                                  <li><a href="shop-product-right.html">Women's Sets</a></li>
                                              </ul>
                                          </li>
                                          <li class="menu-item-has-children">
                                              <a href="#">Men's Fashion</a>
                                              <ul class="dropdown">
                                                  <li><a href="shop-product-right.html">Jackets</a></li>
                                                  <li><a href="shop-product-right.html">Casual Faux Leather</a></li>
                                                  <li><a href="shop-product-right.html">Genuine Leather</a></li>
                                              </ul>
                                          </li>
                                          <li class="menu-item-has-children">
                                              <a href="#">Technology</a>
                                              <ul class="dropdown">
                                                  <li><a href="shop-product-right.html">Gaming Laptops</a></li>
                                                  <li><a href="shop-product-right.html">Ultraslim Laptops</a></li>
                                                  <li><a href="shop-product-right.html">Tablets</a></li>
                                                  <li><a href="shop-product-right.html">Laptop Accessories</a></li>
                                                  <li><a href="shop-product-right.html">Tablet Accessories</a></li>
                                              </ul>
                                          </li>
                                      </ul>
                                  </li>
                                  <li class="menu-item-has-children">
                                      <a href="blog-category-fullwidth.html">Blog</a>
                                      <ul class="dropdown">
                                          <li><a href="blog-category-grid.html">Blog Category Grid</a></li>
                                          <li><a href="blog-category-list.html">Blog Category List</a></li>
                                          <li><a href="blog-category-big.html">Blog Category Big</a></li>
                                          <li><a href="blog-category-fullwidth.html">Blog Category Wide</a></li>
                                          <li class="menu-item-has-children">
                                              <a href="#">Single Product Layout</a>
                                              <ul class="dropdown">
                                                  <li><a href="blog-post-left.html">Left Sidebar</a></li>
                                                  <li><a href="blog-post-right.html">Right Sidebar</a></li>
                                                  <li><a href="blog-post-fullwidth.html">No Sidebar</a></li>
                                              </ul>
                                          </li>
                                      </ul>
                                  </li>
                                  <li class="menu-item-has-children">
                                      <a href="#">Pages</a>
                                      <ul class="dropdown">
                                          <li><a href="page-about.html">About Us</a></li>
                                          <li><a href="page-contact.html">Contact</a></li>
                                          <li><a href="page-account.html">My Account</a></li>
                                          <li><a href="page-login.html">Login</a></li>
                                          <li><a href="page-register.html">Register</a></li>
                                          <li><a href="page-forgot-password.html">Forgot password</a></li>
                                          <li><a href="page-reset-password.html">Reset password</a></li>
                                          <li><a href="page-purchase-guide.html">Purchase Guide</a></li>
                                          <li><a href="page-privacy-policy.html">Privacy Policy</a></li>
                                          <li><a href="page-terms.html">Terms of Service</a></li>
                                          <li><a href="page-404.html">404 Page</a></li>
                                      </ul>
                                  </li>
                                  <li class="menu-item-has-children">
                                      <a href="#">Language</a>
                                      <ul class="dropdown">
                                          <li><a href="#">English</a></li>
                                          <li><a href="#">French</a></li>
                                          <li><a href="#">German</a></li>
                                          <li><a href="#">Spanish</a></li>
                                      </ul>
                                  </li>
                              </ul>
                          </nav>
                          <!-- mobile menu end -->
                      </div>
                      <div class="mobile-header-info-wrap">
                          <div class="single-mobile-header-info">
                              <a href="page-contact.html"><i class="fi-rs-marker"></i> Our location </a>
                          </div>
                          <div class="single-mobile-header-info">
                              <a href="page-login.html"><i class="fi-rs-user"></i>Log In / Sign Up </a>
                          </div>
                          <div class="single-mobile-header-info">
                              <a href="#"><i class="fi-rs-headphones"></i>(+01) - 2345 - 6789 </a>
                          </div>
                      </div>
                      <div class="mobile-social-icon mb-50">
                          <h6 class="mb-15">Follow Us</h6>
                          <a href="#"><img
                                  src="{{ asset('build/assets/imgs/theme/icons/icon-facebook-white.svg') }}"
                                  alt="" /></a>
                          <a href="#"><img
                                  src="{{ asset('build/assets/imgs/theme/icons/icon-twitter-white.svg') }}"
                                  alt="" /></a>
                          <a href="#"><img
                                  src="{{ asset('build/assets/imgs/theme/icons/icon-instagram-white.svg') }}"
                                  alt="" /></a>
                          <a href="#"><img
                                  src="{{ asset('build/assets/imgs/theme/icons/icon-pinterest-white.svg ') }}"
                                  alt="" /></a>
                          <a href="#"><img
                                  src="{{ asset('build/assets/imgs/theme/icons/icon-youtube-white.svg') }}"
                                  alt="" /></a>
                      </div>
                      <div class="site-copyright">Copyright 2022 © Nest. All rights reserved. Powered by AliThemes.
                      </div>
                  </div>
              </div>
          </div>
          <!--End header-->
