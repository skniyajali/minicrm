@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="float-left">{{ __('Companies') }}</h4>
                    <div class="card-toolbar float-right">
                        <a href="{{ route('companies') }}" id="AddCompany" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-2"></i>New Company</a>
                    </div>
                </div>

                <div class="card-body">
                    @if($comp->count())
                        <div class="row">
                            @foreach ($comp as $com)
                                <div class="col-xl-4">                                    
                                    <div class="card mb-3 borde-0 shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex flex-column justify-content-center">  
                                                <div class="d-flex flex-column align-items-center">
                                                    <img src="{{ asset('image/'.$com->logo) }}" alt="..." class="rounded-circle mb-2" width="80" height="80">
                                                </div>                                              
                                                <div class="d-flex flex-column align-items-center">
                                                    <h5 class="font-weight-bold flex-center">{{ $com->name }}</h5>
                                                    <small class="text-sm mt-1">@ {{ $com->email }}</small>
                                                    <small class="text-sm mt-1"><i class="fa fa-globe-asia"></i>{{ $com->website }}</small>
                                                    <small class="text-muted mt-1"><i class="fa fa-clock mr-2"></i>Joined {{ $com->created_at->diffForHumans() }}</small>
                                                </div>                                                                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-danger text-center py-2">Company Not Found</p>
                    @endif
                    <div class="d-flex justify-content-center">
                        @if($comp->count())
                            {{ $comp->links("pagination::bootstrap-4") }}
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="float-left">{{ __('Employess') }}</h4>
                    <div class="card-toolbar float-right">
                        <a href="{{ route('employees') }}" id="" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-2"></i>New Employee</a>
                    </div>
                </div>

                <div class="card-body">
                    @if($emp->count())
                        <div class="row">
                            @foreach ($emp as $emps)
                                <div class="col-xl-4">                                    
                                    <div class="card mb-3 borde-0 shadow-sm">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-center align-items-center flex-row">
                                                <img src="{{ asset('image/'.$emps->companies->logo) }}" alt="..." class="rounded-circle" width="40" height="40">
                                                <h5 class="ml-2 font-weight-bold">{{ $emps->companies->name }}</h5>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-start">
                                                <h5 class="font-weight-bold">{{ $emps->first_name . ' '. $emps->last_name }}</h5>
                                                <span class="text-lg mt-1">@ {{ $emps->email }}</span>
                                                <span class="text-lg mt-1"><i class="fa fa-globe-asia ml-1"></i>{{ $emps->phone }}</span>
                                                <span class="text-muted mt-1"><i class="fa fa-clock ml-1"></i>Joined {{ $emps->created_at->diffForHumans() }}</span>
                                            </div> 
                                        </div>                                        
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-danger text-center py-2">Company Not Found</p>
                    @endif
                    <div class="d-flex justify-content-center">
                        @if($emp->count())
                            {{ $emp->links("pagination::bootstrap-4") }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
