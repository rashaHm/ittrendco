@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Home'])
    <div class="container-fluid py-4">
        <div class="row">
            @foreach($products as $product)
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        
                                        <h5 class="font-weight-bolder">
                                            {{$product->name}}
                                        </h5><p class="text-sm mb-0 text-uppercase font-weight-bold">{{$product->price}} $</p>
                                        <!--<p class="mb-0">
                                            <span class="text-success text-sm font-weight-bolder">+5%</span> 
                                        </p>-->
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                        <a href="{{ route('add_to_cart',['product_id' => $product->id ]) }}"><i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
