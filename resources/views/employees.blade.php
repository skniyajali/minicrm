@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="float-left">{{ __('Employees') }}</h4>
                    <div class="card-toolbar float-right">
                        <a href="#" id="AddEmployee" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-2"></i>New Employee</a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Company</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>                            
                        </thead>
                        <tbody>
                            @if($emp->count())                                
                                @foreach($emp as $emps)                                                                                            
                                    <tr>
                                        <td class="">{{ $emps->id }}</td>
                                        <td>{{ $emps->companies->name }}</td>                                   
                                        <td>{{ $emps->first_name }}</td>
                                        <td>{{ $emps->last_name }}</td>
                                        <td>{{ $emps->email }}</td>
                                        <td>{{ $emps->phone }}</td>
                                        <td>
                                            <a href="#" id="{{ $emps->id }}" class="edit_emp btn btn-primary mr-2"><i class="fa fa-pen mr-1"></i>Edit</a>
                                            <a href="#" id="{{ $emps->id }}" class="delete_emp btn btn-danger mr-2"><i class="fa fa-trash mr-1"></i>Delete</a>
                                        </td>
                                    </tr>                                 
                                @endforeach 
                            @endif                            
                        </tbody>
                    </table>
                    @if ($emp->count())
                        <div class="d-flex justify-content-center">
                            {{ $emp->links("pagination::bootstrap-4") }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="EmpModel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Create New Employee</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="emp_reg" method="post" class="needs-validation" novalidate>
            
            <div class="modal-body">
                @csrf

                <div class="form-group">
                    <label for="com_name">Choose a Company</label>
                    <select class="custom-select" id="com_name" name="com_name">
                        @if ($com->count())
                            <option value="">Choose a Company</option>
                            @foreach ($com as $comp)
                                <option value="{{ $comp->id }}">{{ $comp->name }}</option>
                            @endforeach
                        @else
                            <option value="">Company Not Avilable</option>
                        @endif                        
                    </select>
                    <div class="invalid-feedback">
                        @error('com_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="emp_fname">Employee First Name</label>
                    <input type="text" class="form-control" name="emp_fname" value="{{ old('emp_fname') }}" id="emp_fname" required>
                    <div class="invalid-feedback">
                        @error('emp_fname')
                            {{ $message }}
                        @enderror
                    </div>                    
                </div>

                <div class="form-group">
                    <label for="emp_lname">Employee Last Name</label>
                    <input type="text" class="form-control" name="emp_lname" value="{{ old('emp_lname') }}" id="emp_lname" required>
                    <div class="invalid-feedback">
                        @error('emp_lname')
                            {{ $message }}
                        @enderror
                    </div>                    
                </div>

                <div class="form-group">
                    <label for="emp_email">Employee Email</label>
                    <input type="email" class="form-control" name="emp_email" id="emp_email" value="{{ old('emp_email') }}" required>
                    <div class="invalid-feedback">
                        @error('emp_email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>   
                <div class="form-group">
                    <label for="emp_phone">Employee Phone</label>
                    <input type="number" class="form-control" name="emp_phone" id="emp_phone" value="{{ old('emp_phone') }}" required>                    
                    @error('emp_phone')<span class="text-sm text-danger">{{ $message }}</span>@enderror
                </div>                                            
            </div>
            <div class="modal-footer">
                <input type="hidden" name="emp_id" id="emp_id" value="">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" id="emp_submit" class="btn btn-primary" value="Create"/>
            </div>
        </form>
      </div>
    </div>
  </div>

@endsection