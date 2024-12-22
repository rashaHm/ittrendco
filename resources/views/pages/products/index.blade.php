@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Products'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Products</h6>
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <a href="{{route('add_product')}}" class="btn btn-primary btn-sm ms-auto">Add Product</a>
                            </div>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Stock
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                                    @if( count($products)>0)
                                        @foreach($products as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div>
                                                        <img src="{{ './storage/uploads/' . $product->image }}" class="avatar me-3" alt="image">
                                                    </div>
                                                
                                                </div>
                                            </td>
                                            <td>
                                            <h6 class="mb-0 text-sm">{{$product->name}}</h6>
                                            </td>
                                            <td>
                                            <p class="mb-0 text-sm">{{$product->price}}</p>
                                            </td>
                                            <td>
                                            <p class="mb-0 text-sm">{{$product->stock}}</p>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">
                                                <p class="mb-0 text-sm text-center">No Products!</p>
                                            </td>
                                        </tr>
                                    @endif
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
