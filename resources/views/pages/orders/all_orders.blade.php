@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Orders'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Orders</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">State</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created at</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Cart ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @if( count($orders)>0)
                                        @foreach($orders as $order)
                                        <tr>
                                            <td>
                                                <h6 class="mb-0 text-sm text-center">{{$order->id}}</h6>
                                            </td>
                                            <td>
                                                @if($order->state == "in_progress")
                                                    <h6 class="mb-0 text-sm text-center">In Progress</h6>
                                                @elseif($order->state == "pending")
                                                    <h6 class="mb-0 text-sm text-center">Pending</h6>
                                                @elseif($order->state == "done")
                                                    <h6 class="mb-0 text-sm text-center">Done</h6>
                                                @endif
                                                
                                            </td>
                                            <td>
                                                <p class="mb-0 text-sm text-center">{{$order->created_at}}</p>
                                            </td>
                                            <td>
                                                <p class="mb-0 text-sm text-center">{{$order->cart_id}}</p>
                                            </td>
                                            <td class="flex">
                                                @if($order->state == "pending")
                                                <form action="{{route('update_order',['order_id' => $order->id])}}" method="POST"> 
                                                    @csrf
                                                    <input type="hidden" value="in_progress" name="order_state">
                                                    <button type="submit" class="btn btn-primary btn-xs ms-auto">In Progress</button>
                                                </form>
                                                <form action="{{route('update_order',['order_id' => $order->id])}}" method="POST"> 
                                                    @csrf
                                                    <input type="hidden" value="done" name="order_state">
                                                    <button type="submit" class="btn btn-primary btn-xs ms-auto">Done</button>
                                                </form>
                                                @elseif($order->state == "in_progress")
                                                    <form action="{{route('update_order',['order_id' => $order->id])}}" method="POST"> 
                                                        @csrf
                                                        <input type="hidden" value="done" name="order_state">
                                                        <button type="submit" class="btn btn-primary btn-xs ms-auto">Done</button>
                                                    </form>
                                                
                                                @endif
                                            </td>
                                           
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">
                                                <p class="mb-0 text-sm text-center text-center">No Orders!</p>
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
