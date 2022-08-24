@extends('layouts.frontend')

@section('title', 'Dashboard')

@push('css_before')
@endpush

@section('content')
    <div class="p-1 flow-y-auto h-100">
        <div class="row h-100" style="width: calc(100% - 0px)">
            <div class="col-3 pt-3 pl-3" style="background: #333">
                <li class="nav-main-item {{ Request::is('app/collection/*') ? 'open' : '' }} " style="background: #444">
                    <a class="nav-main-link text-white nav-main-link-submenu fs-xs" data-toggle="submenu" aria-haspopup="true"
                        aria-expanded="false" href="#">
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        <i class="nav-main-link-icon fa fa-dashboard text-warning" aria-hidden="true"></i>
                        <span class="nav-main-link-name">Dashboard</span>
                    </a>
                </li>
                <li class="nav-main-item open mt-1" style="background: #444">
                    <a class="nav-main-link text-white nav-main-link-submenu fs-xs" data-toggle="submenu"
                        aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        <i class="nav-main-link-icon fa fa-users text-warning" aria-hidden="true"></i>
                        <span class="nav-main-link-name">Staffs</span>
                    </a>

                    <ul class="nav-main-submenu">
                        <li class="nav-main-item">
                            <a class="nav-main-link text-white fs-xs {{ Request::is('admin/staffs') ? 'active' : '' }}"
                                href="{{ route('admin.staffs') }}">
                                <i class="nav-main-link-icon text-warning fa fa-list"></i>
                                <span class="nav-main-link-name">List</span> <!-- $child->title -->
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link text-white fs-xs active  {{ Request::is('admin/staffs') ? 'active' : '' }}"
                                href="{{ route('admin.newstaffs') }}">
                                <i class="nav-main-link-icon text-warning fa fa-user-plus"></i>
                                <span class="nav-main-link-name">Add new staff</span> <!-- $child->title -->
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-main-item {{ Request::is('app/collection/*') ? 'open' : '' }} mt-1"
                    style="background: #444">
                    <a class="nav-main-link text-white nav-main-link-submenu fs-xs" data-toggle="submenu"
                        aria-haspopup="true" aria-expanded="false" href="{{ route('admin.departments') }}">
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        <i class="nav-main-link-icon text-warning fa fa-building" aria-hidden="true"></i>
                        <span class="nav-main-link-name">Departments</span>
                    </a>
                </li>
                <li class="nav-main-item {{ Request::is('app/collection/*') ? 'open' : '' }} mt-1"
                    style="background: #444">
                    <a class="nav-main-link text-white nav-main-link-submenu fs-xs" data-toggle="submenu"
                        aria-haspopup="true" aria-expanded="false" href="{{ route('admin.designations') }}">
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        <i class="nav-main-link-icon text-warning fa fa-list" aria-hidden="true"></i>
                        <span class="nav-main-link-name">Designations</span>
                    </a>
                </li>

                <li class="nav-main-item {{ Request::is('app/collection/*') ? 'open' : '' }} mt-1"
                    style="background: #444">
                    <a class="nav-main-link text-white nav-main-link-submenu fs-xs" data-toggle="submenu"
                        aria-haspopup="true" aria-expanded="false" href="{{ route('admin.events') }}">
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        <i class="nav-main-link-icon text-warning fa fa-list" aria-hidden="true"></i>
                        <span class="nav-main-link-name">Events</span>
                    </a>
                </li>

                <li class="nav-main-item {{ Request::is('app/collection/*') ? 'open' : '' }} mt-1"
                    style="background: #444">
                    <a class="nav-main-link text-white nav-main-link-submenu fs-xs" data-toggle="submenu"
                        aria-haspopup="true" aria-expanded="false" href="{{route('admin.gallery')}}">
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        <i class="nav-main-link-icon text-warning fa fa-photo" aria-hidden="true"></i>
                        <span class="nav-main-link-name">Gallery</span>
                    </a>
                </li>

                <li class="nav-main-item {{ Request::is('app/collection/*') ? 'open' : '' }} mt-5"
                    style="background: #444;">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button style="background: #444; border: none;"
                            class="nav-main-link text-white nav-main-link-submenu fs-xs form-control" data-toggle="submenu"
                            aria-haspopup="true" aria-expanded="false" href="{{ route('logout') }}">
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            <i class="nav-main-link-icon text-warning fa fa-sign-out" aria-hidden="true"></i>
                            <span class="nav-main-link-name">Logout</span>
                        </button>
                    </form>
                </li>
            </div>
            <div class="col-9 overflow-auto">
                @yield('right-content')
            </div>
        </div>
    </div>
@stop
