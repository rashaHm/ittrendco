@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Billing'])
    <div class="container-fluid py-4">
        <div class="row">
        <div class="alert alert-success" role="alert">
                <strong>
                    Payment has been made successfully!
                </strong>
            </div>
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Billing Information</h6>
                        <div class="d-flex float-right">
                            <span class="mb-2 text-md">Total: <span
                            class="text-dark font-weight-bold text-md">{{ $total }} $</span></span>
                        </div>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-3 text-lg">{{$payment->first_name}} {{$payment->last_name}}</h6>
                                    <span class="mb-2 text-md">Email: <span
                                            class="text-dark font-weight-bold ms-sm-2">{{ $payment->email }}</span></span>
                                    <span class="mb-2 text-md">Phone: <span
                                            class="text-dark ms-sm-2 font-weight-bold">{{$payment->phone}}</span></span>
                                    <span class="text-md">Address: <span
                                            class="text-dark ms-sm-2 font-weight-bold">{{$payment->phone}}</span></span>
                                    <span class="text-md">Method: <span
                                            class="text-dark ms-sm-2 font-weight-bold">{{$payment->method}}</span></span>
                                    <span class="text-md">Notes: <span
                                            class="text-dark ms-sm-2 font-weight-bold">{{$payment->notes}}</span></span>
                                </div>
                            </li>
                        </ul>
                        <div class="d-flex align-items-center">
                            <a href="{{route('home')}}" class="btn btn-primary btn-sm ms-auto">Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
