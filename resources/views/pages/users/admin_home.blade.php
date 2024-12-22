@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Home'])
    <div class="container-fluid py-4">
        <div class="row">
        <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">                                        
                                        <h6 class="font-weight-bolder">
                                            Users
                                        </h6><p class="text-sm mb-0 text-uppercase font-weight-bold"> </p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-warning shadow-warning text-center text-lg text-white rounded-circle rounded-xs pt-2">
                                        <span class="text-sm font-weight-bolder">{{ $users }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">                                        
                                        <h6 class="font-weight-bolder">
                                            Categories 
                                        </h6><p class="text-sm mb-0 text-uppercase font-weight-bold"> </p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-warning shadow-warning text-center text-lg text-white rounded-circle rounded-xs pt-2">
                                        <span class="text-sm font-weight-bolder">{{ $categories }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">                                        
                                        <h6 class="font-weight-bolder">
                                            Products 
                                        </h6><p class="text-sm mb-0 text-uppercase font-weight-bold"> </p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-warning shadow-warning text-center text-lg text-white rounded-circle rounded-xs pt-2">
                                        <span class="text-sm font-weight-bolder">{{ $products }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection
