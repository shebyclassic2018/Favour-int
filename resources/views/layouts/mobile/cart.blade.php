<div class="mobile_menwrap d-lg-none" id="mobileCart">
  <div class="mobile_cart_wrap d-flex flex-column">
    <h5 class="mobile_title">
      Cart
      <span class="sidebarclose" id="mobileCartClose">
        <i class="las la-times"></i>
      </span>
    </h5>
    <div class="px-3 py-3 flex-grow-1 d-flex flex-column">

      <div class="cart_droptitle">
        @if(session('cart'))
          <h4 class="text_lg">
            {{ count(session('cart')) }} Item{{ count(session('cart')) > 1 ? 's' : ''}}
          </h4>
        @else
          <h4 class="text_lg">You have no item in cart</h4>
        @endif
      </div>

      <div class="cartsdrop_wrap">
        @if(session('cart'))
          @foreach(session('cart') as $id => $details)
            <a href="{{ route('shop.show', $details['slug']) }}" class="single_cartdrop mb-3">
              <span class="remove_cart"><i class="las la-times"></i></span>
              <div class="cartdrop_img">
                <img loading="lazy" src="{{ asset('media/items/'.$details['image']) }}" alt="product">
              </div>
              <div class="cartdrop_cont">
                <h5 class="text_lg mb-0 default_link">
                  {{ $details['name'] }}
                </h5>
                <p class="mb-0 text_xs text_p">x{{ $details['quantity'] }}<span class="ms-2">$@money_format($details['price'])</span></p>
              </div>
            </a>
          @endforeach
        @endif
      </div>

      <div class="mt-auto">
        @if(session('cart'))
          <div class="total_cartdrop">
            <h4 class="text_lg text-uppercase mb-0">Sub Total:</h4>
            @php $total = 0 @endphp
            @foreach((array) session('cart') as $id => $details)
              @php $total += $details['price'] * $details['quantity'] @endphp
            @endforeach
            <h4 class="text_lg mb-0 ms-2">$@money_format($total)</h4>
          </div>
        @endif
        <div class="cartdrop_footer mt-3 d-flex">

          @if(session('cart'))
            <a href="{{ route('app.cart') }}" class="default_btn w-50 text_xs px-1">
              View Cart
            </a>
            <a href="{{ route('order.checkout') }}" class="default_btn second ms-3 w-50 text_xs px-1">
              Checkout
            </a>
          @else
            <a href="{{ route('shop.all', 'grid') }}" class="default_btn w-100 text_xs px-1">
              Shopping
            </a>
          @endif
        </div>
      </div>
      
    </div>
  </div>
</div>