  @php
      $x = 0;
      $y = 0;

      if ($y === 5) {
          $y = 8;
      }
  @endphp

  <section class="popular-categories section-padding">
      <div class="container wow animate__animated animate__fadeIn">
          <div class="section-title">
              <div class="title">
                  <h3>All Subcategories</h3>

              </div>
              <div class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow"
                  id="carausel-10-columns-arrows"></div>
          </div>


          <div class="carausel-10-columns-cover position-relative">
              <div class="carausel-10-columns" id="carausel-10-columns">

                  @foreach ($categories as $category)
                      @foreach ($category->subcategories as $subcategory)
                          @php
                              if ($y === 6) {
                                  $y = 0;
                              }
                          @endphp
                          <div class="card-2 bg-{{ $y++ }} wow animate__animated animate__fadeInUp"
                              data-wow-delay=".{{ $x++ }}s">

                              <figure class="img-hover-scale overflow-hidden">

                                  <a href="{{ asset('subcategory/' . $subcategory->id . '/products') }}"><img
                                          src="{{ asset( $subcategory->image ) }}"
                                          alt="" />
                                  </a>

                              </figure>

                              <h6>
                                  <a href="{{ asset('subcategory/' . $subcategory->id . '/products') }}">{{ $subcategory->name }}</a>
                              </h6>

                              <span>{{ $subcategory->products->count() }} items</span>
                          </div>
                      @endforeach
                  @endforeach






              </div>
          </div>
      </div>
  </section>
