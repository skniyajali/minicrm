@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="float-left">{{ __('Companies') }}</h4>
                    <div class="card-toolbar float-right">
                        <a href="#" id="AddCompany" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-2"></i>New Company</a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Website</th>
                                <th>Action</th>
                            </tr>                            
                        </thead>
                        <tbody>
                            @if($comp->count())                                
                                @foreach($comp as $companies)
                                    
                                    <tr>
                                        <td class="">{{ $companies->id }}</td>
                                        <td><img src="{{ asset('image/'.$companies->logo) }}" alt="{{ $companies->name }}" class="img img-thumbnail" width="70" height="70"></td>
                                        <td>{{ $companies->name }}</td>
                                        <td>{{ $companies->email }}</td>
                                        <td>{{ $companies->website }}</td>
                                        <td>
                                            <a href="#" id="{{ $companies->id }}" class="edit_com btn btn-primary mr-2"><i class="fa fa-pen mr-1"></i>Edit</a>
                                            <a href="#" id="{{ $companies->id }}" class="delete_com btn btn-danger mr-2"><i class="fa fa-trash mr-1"></i>Delete</a>
                                        </td>
                                    </tr>                                    
                                @endforeach 
                            @endif                            
                        </tbody>
                    </table>
                    @if ($comp->count())
                        <div class="d-flex justify-content-center">
                            {{ $comp->links("pagination::bootstrap-4") }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="CompModel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Create New Company</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="com_reg" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
            
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="com_name">Company Name</label>
                    <input type="text" class="form-control" name="com_name" value="{{ old('com_name') }}" id="com_name" required>
                    <div class="invalid-feedback">
                        @error('com_name')
                            {{ $message }}
                        @enderror
                    </div>                    
                </div>
                <div class="form-group">
                    <label for="com_email">Company Email</label>
                    <input type="email" class="form-control" name="com_email" id="com_email" value="{{ old('com_email') }}" required>
                    <div class="invalid-feedback">
                        @error('com_email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="com_web">Company Website</label>
                    <input type="text" class="form-control" name="com_web" id="com_web" value="{{ old('com_web') }}" required>
                    <div class="invalid-feedback">
                        @error('com_web')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="com_logo">Company Logo</label>
                    <input type="file" class="form-control-file" id="com_logo" name="com_logo">                    
                    <div class="invalid-feedback">
                        @error('com_logo')
                            {{ $message }}
                        @enderror
                    </div>                 
                </div>                               
            </div>
            <div class="modal-footer">
                <input type="hidden" name="old_image" id="old_image" value="">
                <input type="hidden" name="id" id="id" value="">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" id="com_submit" class="btn btn-primary" value="Create"/>
            </div>
        </form>
      </div>
    </div>
  </div>

  
@endsection
