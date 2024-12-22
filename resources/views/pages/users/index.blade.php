@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Users'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Users</h6>
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <a href="{{route('add_user')}}" class="btn btn-primary btn-sm ms-auto">Add User</a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Joined Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if( count($all_users)>0)
                                    @foreach($all_users as $u)
                                        <tr>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{$u->username}}</p>
                                            </td>

                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{$u->email}}</p>
                                            </td>
                                            <td>
                                                <p class="text-sm font-weight-bold mb-0">{{$u->getRoleNames()[0]}}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-sm font-weight-bold mb-0">{{$u->created_at}}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
