@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Categories'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Categories</h6>
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <a href="{{route('add_category')}}" class="btn btn-primary btn-sm ms-auto">Add Category</a>
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
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @if( count($categories)>0)
                                        @foreach($categories as $category)
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div>
                                                        <img src="{{ './storage/uploads/' . $category->image }}" class="avatar me-3" alt="image">
                                                    </div>
                                                
                                                </div>
                                            </td>
                                            <td>
                                            <h6 class="mb-0 text-sm">{{$category->name}}</h6>
                                            </td></tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">
                                                <p class="mb-0 text-sm text-center">No Categories!</p>
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
