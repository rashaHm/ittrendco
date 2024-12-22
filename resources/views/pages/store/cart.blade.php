@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Cart'])
    
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Cart</h6>
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <a href="{{route('home')}}" class="btn btn-primary btn-sm ms-auto">Shop more</a>
                        </div>
                        @if( count($cart_products)>0)
                            <div class="d-flex align-items-center">
                                <a href="{{route('purchase')}}" class="btn btn-primary btn-sm ms-auto">Purchase</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">quantity
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                    @if( count($cart_products)>0)
                                        @foreach($cart_products as $cart_product)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-3 py-1">
                                                        <div>
                                                            <img src="{{ './storage/uploads/' . $cart_product->image }}" class="avatar me-3" alt="image">
                                                        </div>
                                                    
                                                    </div>
                                                </td>
                                                <td>
                                                <h6 class="mb-0 text-sm">{{$cart_product->name}}</h6>
                                                </td>
                                                <td>
                                                <p class="mb-0 text-sm">{{$cart_product->price}}</p>
                                                </td>
                                                <td>
                                                <p class="mb-0 text-sm">{{$cart_product->pivot->quantity}}</p>
                                                </td>
                                                <td>
                                                <a href="{{ route('remove_from_cart',['product_id' => $cart_product->id ]) }}" class="mb-0 text-sm">Remove</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    
                                    @else
                                    <tr>
                                        <td colspan="4">
                                            <p class="mb-0 text-sm text-center">No items in cart!</p>
                                        </td>
                                    </tr>
                                    @endif
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
