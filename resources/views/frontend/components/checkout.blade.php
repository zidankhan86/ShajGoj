
      <!-- Checkout Section Begin -->
      <section class="checkout spad">
          <div class="container">


              <div class="row">
                  <div class="col-lg-12">
                      {{-- <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code --}}
                      </h6>
                  </div>
              </div>
              <div class="checkout__form">

                @if (session('success'))

                <p class="alert alert-success">{{session('success')}}</p>

                @endif
                  <h4>Billing Details</h4>

                  <form action="{{route('pay.now',$products->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                      <div class="row">
                          <div class="col-lg-6 col-md-12">
                              <div class="row">


                                  <div class="col-lg-12">
                                      <div class="checkout__input">
                                          <p>Full Name<span>*</span></p>
                                          <input type="text" name="full_name">

                                        @error('name')

                                        <small class="text-danger">{{$message}}</small>

                                        @enderror

                                      </div>
                                  </div>
                                 
                              </div>

                              <div class="checkout__input">
                                  <p>Address<span>*</span></p>
                                  <input type="text" placeholder="Street Address" class="checkout__input__add" name="address">


                                    @error('address')

                                    <small class="text-danger">{{$message}}</small>

                                    @enderror

                                

                              </div>


                              <input type="hidden" name="total_price" value="{{ $subtotal }}">
                         
                              <div class="row">
                                  <div class="col-lg-6">
                                      <div class="checkout__input">
                                          <p>Phone<span>*</span></p>
                                          <input type="text" name="phone">

                                          @error('phone')

                                          <small class="text-danger">{{$message}}</small>

                                          @enderror
                                      </div>
                                  </div>


                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="product_id" value="{{$products->id}}">
                                <input type="hidden" name="transaction_id">
                                <input type="hidden" name="currency">
                                  <div class="col-lg-6">
                                      <div class="checkout__input">
                                          <p>Email<span>*</span></p>
                                          <input type="text" name="email">

                                          @error('email')

                                          <small class="text-danger">{{$message}}</small>

                                          @enderror
                                      </div>
                                  </div>
                              </div>
                              <div class="checkout__input__checkbox">
                                  <label for="acc">
                                      Create an account? <a href="{{ route('registration') }}">Click here..</a>
                                      <input type="checkbox" id="acc">
                                      <span class="checkmark"></span>
                                  </label>
                              </div>

                              </div>


                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @if(session()->has('cart') && is_array(session()->get('cart')))
                                        @foreach(session()->get('cart') as $data)
                                            <li>{{$data['name']}} <span>{{$data['subtotal']}} Tk.</span></li>
                                        @endforeach
                                    @endif
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>{{ $subtotal ?? 0 }} Tk.</span></div>
                                <div class="checkout__order__total">Total <span>{{ $subtotal ?? 0 }} Tk.</span></div>
                                <div class="checkout__input__checkbox">
                                
                                </div>
                                <ul>
                                    @if(session()->has('cart') && is_array(session()->get('cart')))
                                        @foreach(session()->get('cart') as $data)
                                            <li>
                                                {{-- {{$data['name']}} <span>{{$data['subtotal']}} Tk.</span> --}}
                                                <input type="hidden" name="product_names[]" value="{{$data['name']}}">
                                            </li>
                                        @endforeach
                                    @endif
                                  </ul>
                                <p>Thank you for choosing us.Happy shopping.</p>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>




                      </div>
                  </form>
              </div>


          </div>
      </section>
      <!-- Checkout Section End -->

  </body>

  </html>
