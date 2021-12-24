@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="d-flex justify-content-between">
                    <h4 class="m-3">Add User</h4>
                    <button  data-bs-toggle="modal" data-bs-target="#addUser"class="btn btn-warning m-3">Add user</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th colspan='2'>Action</th>
                        </tr>
                    </thead>
                    @foreach($user as $key=>$info)
                       
                    <tbody>
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$info->name}}</td>
                            <td>{{$info->email}}</td>
                            @if($info->is_admin==1)
                                <td>Cashier</td>
                            @else
                                <td>Admin</td>
                            @endif

                            @if(Auth::user()->is_admin==2)
                                 <td>
                                    <button data-bs-toggle="modal" data-bs-target="#edituser{{$info->id}}" class="btn btn-secondary">Edit</button>
                                    </td>
                                    <td>
                                    <button  class="btn btn-danger">Delete</button>
                                </td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                    </tbody>
                    <!-- Modal for edit user -->
                    <div class="modal right fade" id="edituser{{ $info->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit User </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- this is edit form-->
                                    <form action="/saveuserInfo/{{$info->id}}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                            <div class="col-md-12">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$info->name}}" required autocomplete="name" autofocus>

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-12">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $info->email }}" required autocomplete="email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="is_admin" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                                            <div class="col-md-12">
                                                <select name="is_admin" id="" class="form-control @error('is_admin') is-invalid @enderror">
                                                    @if($info->is_admin == 1)
                                                        <option value="1">Cashier</option>
                                                    @else
                                                        <option value="2">Admin</option>
                                                    @endif
                                                </select>

                                                @error('is_admin')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary m-2">
                                                    {{ __('Register') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            
                                </div>
                            </div>
                        </div>
                        <!-- Modal End-->
                   
                    @endforeach
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                   <h4 class="m-3">Search</h4>
                </div>
                <div class="card-body d-flex">
                        <input type="text" placeholder="search user">
                        <button class="btn btn-primary m-2" >Search</button>
                </div>
            </div>
        </div>
    </div>
</div>
     <!-- Modal  for add user-->
    <div class="modal right fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD New User </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/userInfo">
                    @csrf
                    
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_admin" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                        <div class="col-md-12">
                            <select name="is_admin" id="" class="form-control @error('is_admin') is-invalid @enderror">
                                <option value="1">Cashier</option>
                                <option value="2">Admin</option>
                            </select>

                            @error('is_admin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary m-2">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
            </div>
        </div>
    </div>
    <!-- Modal End-->


    <!-- Modal for edit user -->
    <div class="modal right fade" id="edituser{{ $info->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- this is edit form-->
                <form method="POST" action="/userInfo">
                    @csrf
                    
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$info->name}}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_admin" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                        <div class="col-md-12">
                            <select name="is_admin" id="" class="form-control @error('is_admin') is-invalid @enderror">
                                <option value="1">Cashier</option>
                                <option value="2">Admin</option>
                            </select>

                            @error('is_admin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary m-2">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
          
            </div>
        </div>
    </div>
    <!-- Modal End-->

    <style>
        .modal.right .modal-dialog{
            position: absolute;
                 top:30px;
                 left:360px;
                 margin:0px;
                 max-width:800px;
               
        }
        .modal.right .modal-content{
            max-width:800px;
            
        }
    </style>

@endsection