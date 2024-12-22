@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Add Product'])
    
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
          
                <div class="card">
                    @if(isset($error))
                        <div class="alert alert-secondary m-3" role="alert">
                            {{$message}}
                        </div>
                    @endif
                    <form role="form" method="POST" action={{ route('store_user') }} enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Add User</p>
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                            </div>
                        </div>
                        <div class="card-body">
                           
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Name</label>
                                        <input required class="form-control" type="text" name="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email</label>
                                        <input type="text" required  class="form-control" name="email"/>
                                    </div>
                                </div>
                               
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Password</label>
                                        <input class="form-control" type="password" required name="password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Confirm Password</label>
                                        <input type="password"  class="form-control" required name="confirm_password"/>
                                    </div>
                                </div>
                               
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Role</label>
                                        <select required name="role" class="form-control" >
                                            <option value="admin">Admin</option>
                                            <option value="cooker">Cooker</option>
                                            <option value="customer">Customer</option>
                                        </select>
                                    </div>
                                </div>                               
                            </div>
                        </div>
                    </form>
                </div>
            </div>
         
        </div>
       <!-- @include('layouts.footers.auth.footer') -->
    </div>
@endsection
