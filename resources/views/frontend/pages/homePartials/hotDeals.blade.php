 <section class="section-padding mb-30">
     <div class="container">
         <div class="row">
             <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp"
                 data-wow-delay="0">


                 <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                 <div class="product-list-small animated animated">


                     @foreach ($hotDealsProducts as $product)
                         <article class="row align-items-center hover-up">
                             <figure class="col-md-4 mb-0">
                                 <a href="shop-product-right.html"><img src="{{ asset( $product->image) }}"
                                         alt="{{ $product->name }}" alt="" /></a>
                             </figure>
                             <div class="col-md-8 mb-0">
                                 <h6>
                                     <a href="shop-product-right.html">{{ $product->name }}</a>
                                 </h6>
                                 <div class="product-rate-cover">
                                     <div class="product-rate d-inline-block">

                                         <div class="product-rating"
                                             style="width: {{ $product->rating_average * 20 }}%"></div>
                                     </div>
                                     <span class="font-small ml-5 text-muted"> ({{ $product->rating_average }})</span>
                                 </div>
                                 <div class="product-price">
                                     <span>${{ $product->sale_price }}</span>
                                     <span class="old-price">${{ $product->price }}</span>
                                 </div>
                             </div>
                         </article>
                     @endforeach





                 </div>



             </div>



             <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp"
                 data-wow-delay=".1s">
                 <h4 class="section-title style-1 mb-30 animated animated"> Top Rated </h4>
                 <div class="product-list-small animated animated">


                     @foreach ($topRatedProducts as $product)
                         <article class="row align-items-center hover-up">
                             <figure class="col-md-4 mb-0">
                                 <a href="shop-product-right.html"><img src="{{ asset( $product->image) }}"
                                         alt="{{ $product->name }}" alt="" /></a>
                             </figure>
                             <div class="col-md-8 mb-0">
                                 <h6>
                                     <a href="shop-product-right.html">{{ $product->name }}</a>
                                 </h6>
                                 <div class="product-rate-cover">
                                     <div class="product-rate d-inline-block">

                                         <div class="product-rating"
                                             style="width: {{ $product->rating_average * 20 }}%"></div>
                                     </div>
                                     <span class="font-small ml-5 text-muted"> ({{ $product->rating_average }})</span>
                                 </div>
                                 <div class="product-price">
                                     <span>${{ $product->sale_price }}</span>
                                     <span class="old-price">${{ $product->price }}</span>
                                 </div>
                             </div>
                         </article>
                     @endforeach



                 </div>
             </div>
             <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp"
                 data-wow-delay=".2s">
                 <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                 <div class="product-list-small animated animated">



                     @foreach ($RecentlyAddedProducts as $product)
                         <article class="row align-items-center hover-up">
                             <figure class="col-md-4 mb-0">
                                 <a href="shop-product-right.html"><img src="{{ asset( $product->image) }}"
                                         alt="{{ $product->name }}" alt="" /></a>
                             </figure>
                             <div class="col-md-8 mb-0">
                                 <h6>
                                     <a href="shop-product-right.html">{{ $product->name }}</a>
                                 </h6>
                                 <div class="product-rate-cover">
                                     <div class="product-rate d-inline-block">

                                         <div class="product-rating"
                                             style="width: {{ $product->rating_average * 20 }}%"></div>
                                     </div>
                                     <span class="font-small ml-5 text-muted"> ({{ $product->rating_average }})</span>
                                 </div>
                                 <div class="product-price">
                                     <span>${{ $product->sale_price }}</span>
                                     <span class="old-price">${{ $product->price }}</span>
                                 </div>
                             </div>
                         </article>
                     @endforeach


                 </div>
             </div>
             <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp"
                 data-wow-delay=".3s">
                 <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
                 <div class="product-list-small animated animated">



                      @foreach ($specialDealsProducts as $product)
                         <article class="row align-items-center hover-up">
                             <figure class="col-md-4 mb-0">
                                 <a href="shop-product-right.html"><img src="{{ asset( $product->image) }}"
                                         alt="{{ $product->name }}" alt="" /></a>
                             </figure>
                             <div class="col-md-8 mb-0">
                                 <h6>
                                     <a href="shop-product-right.html">{{ $product->name }}</a>
                                 </h6>
                                 <div class="product-rate-cover">
                                     <div class="product-rate d-inline-block">

                                         <div class="product-rating"
                                             style="width: {{ $product->rating_average * 20 }}%"></div>
                                     </div>
                                     <span class="font-small ml-5 text-muted"> ({{ $product->rating_average }})</span>
                                 </div>
                                 <div class="product-price">
                                     <span>${{ $product->sale_price }}</span>
                                     <span class="old-price">${{ $product->price }}</span>
                                 </div>
                             </div>
                         </article>
                     @endforeach


                 </div>
             </div>
         </div>
     </div>
 </section>
