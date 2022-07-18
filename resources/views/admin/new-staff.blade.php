@extends('admin.dashboard')

@section('right-content')
    <section class="overflow-hidden" style="height: calc(100% - 60px)">
        <div class="h-100">
            <div class="row ">
                <div class="col-12 ">
                    <div class="card shadow-2-strong card-registration w-100" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5"><span class="fs-xs">ADD NEW STAFF /</span> Registration
                                Form</h3>
                            @if (!is_null(\Session::get('alert-success')))
                                <div class="alert alert-success">{{ Session::get('alert-success') }}</div>
                            @elseif (!is_null(\Session::get('alert-danger')))
                                <div class="alert alert-danger">{{ Session::get('alert-success') }}</div>
                            @endif
                            <form method="POST" action="{{ route('admin.addnewstaffs') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-outline">
                                            <label class="form-label fs-xs" for="firstName">First Name</label>
                                            <input type="text" name="fname" id="firstName"
                                                class="form-control form-control-lg" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-outline">
                                            <label class="form-label fs-xs" for="lastName">Last Name</label>
                                            <input type="text" name="lname" id="lastName"
                                                class="form-control form-control-lg" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-4 pb-2">
                                        <div class="form-outline">
                                            <label class="form-label fs-xs" for="emailAddress">Email</label>
                                            <input type="email" name="email" id="emailAddress"
                                                class="form-control form-control-lg" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 pb-2">
                                        <div class="form-outline">
                                            <label class="form-label fs-xs" for="phoneNumber">Phone Number</label>
                                            <input type="tel" name="phone" id="phoneNumber"
                                                class="form-control form-control-lg" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label fs-xs select-label">Department</label>
                                        <select name="department" class="select form-control fs-xs">
                                            <option value="1">Choose option</option>
                                            @foreach (departments() as $dep)
                                                <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fs-xs select-label">Designation</label>
                                        <select name="designation" class="select form-control fs-xs">
                                            <option value="1">Choose option</option>
                                            @foreach (designations() as $des)
                                                <option value="{{ $des->id }}">{{ $des->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fs-xs select-label">Role</label>
                                        <select name="role" class="select form-control fs-xs">
                                            <option value="1">Choose option</option>
                                            @foreach (roles() as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-4 pt-2">
                                    <input class="btn btn-primary btn-lg" type="submit" value="Submit" />
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
