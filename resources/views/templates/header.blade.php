<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="" />
        <title>Barangay Tinago Management System</title>
        <!-- <link href="{{ asset('css/style.min.css') }}" rel="stylesheet" /> -->
        <!-- <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet" /> -->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <script src="{{ asset('css/all.js') }}" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-success">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3">
            <img src="{{ asset('assets/img/tinago.png') }}" alt="Barangay Logo" style="width: 83px; height: 83px;">BTMS</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i> {{ Auth::user()->email }}</a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('dashboard.profile') }}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('dashboard.changepassword') }}">Change Password</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link text-decoration-none" 
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>{{ __('Log Out') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu bg-success">
                        <div class="nav mt-3">
                
                            <!-- Dashboard (Visible for all users) -->
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt text-black"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Menus</div>
                            @if(Auth::user()->user_type == "resident")
                            <a class="nav-link" href="{{ route('transactions.transactions') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-exchange-alt text-black"></i></div>
                                Request
                            </a>
                            <a class="nav-link" href="{{ route('transactions.history') }}">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-history text-black"></i>
                                    @php
                                        $userId = Auth::id(); // Get the current user's ID
                                        $unreadTransactionsCount = \App\Models\Transactions::where('user_id', $userId)
                                            ->where('is_read', false)
                                            ->whereIn('status', ['Not Ready', 'Processing', 'Ready for Pickup']) // Only count active transactions
                                            ->count();
                                    @endphp
                                    @if($unreadTransactionsCount > 0)
                                        <span class="badge bg-danger text-white rounded-circle position-absolute" 
                                              style="top: 4px; right: 90px; font-size: 0.7rem; padding: 0.2rem 0.5rem;">
                                            {{ $unreadTransactionsCount }}
                                        </span>
                                    @endif
                                </div>
                                Transaction
                            </a>

                            <a class="nav-link" href="{{ route('comments.comments') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-exchange-alt text-black"></i></div>
                                Comments
                            </a>
                            
                            <!-- About Us (Visible for all users) -->
                            <div class="sb-sidenav-menu-heading">Barangay Info</div>
                            <a class="nav-link" href="{{ route('dashboard.about-us') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table text-black"></i></div>
                                About Us
                            </a>
                            @else

                
                            <!-- Residence Management -->
                            <a class="nav-link collapsed {{ Auth::user()->user_type == 'secretary' || Auth::user()->user_type == 'captain' ? '' : 'disabled' }}" href="#" 
                               data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts"
                               {{ Auth::user()->user_type != 'secretary' && Auth::user()->user_type != 'captain' ? 'aria-disabled=true' : '' }}>
                                <div class="sb-nav-link-icon"><i class="fas fa-house text-black"></i></div>
                                Residence Management
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-black"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('residence.addresidence') }}">Add Resident</a>
                                    <a class="nav-link" href="{{ route('blooter.blooters') }}">Blotter Record</a>
                                    <a class="nav-link" href="{{ route('residence.view') }}">Residence List</a>
                                </nav>
                            </div>
                
                            <!-- Financial Management -->
                            <a class="nav-link collapsed {{ Auth::user()->user_type == 'treasurer' || Auth::user()->user_type == 'captain' ? '' : 'disabled' }}" 
                                href="#" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#collapsePages" 
                                aria-expanded="false" 
                                aria-controls="collapsePages"
                                {{ Auth::user()->user_type != 'treasurer' && Auth::user()->user_type != 'captain' ? 'aria-disabled=true' : '' }}>
                                
                                <div class="sb-nav-link-icon position-relative">
                                    <i class="fas fa-donate text-black"></i>
                                    @php
                                        $allTransactionsCount = \App\Models\Transactions::whereIn('status', ['Not Ready', 'Processing', 'Ready for Pickup'])
                                            ->where('deleted_by_user', false)
                                            ->where('is_read', false)
                                            ->count();
                                    @endphp
                                    @if($allTransactionsCount > 0)
                                        <span class="badge bg-danger rounded-pill position-absolute" 
                                              style="top: -20px; right: -150px; font-size: 0.65rem; min-width: 1rem;">
                                            {{ $allTransactionsCount }}
                                        </span>
                                    @endif
                                </div>
                                <span class="ml-2">Financial Management</span>
                                <div class="sb-sidenav-collapse-arrow">
                                    <i class="fas fa-angle-down text-black"></i>
                                </div>
                            </a>
                            
                             
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="{{ route('budget.budgetplan') }}">Budget Planning</a>
                                    <a class="nav-link" href="{{ route('transactions.report') }}">Transaction Reporting</a>
                                </nav>
                            </div>
                
                            <!-- Event Management -->
                            <a class="nav-link collapsed {{ Auth::user()->user_type == 'event' || Auth::user()->user_type == 'captain' ? '' : 'disabled' }}" href="#" 
                               data-bs-toggle="collapse" data-bs-target="#collapseLayoutsevent" aria-expanded="false" aria-controls="collapseLayoutsevent"
                               {{ Auth::user()->user_type != 'event' && Auth::user()->user_type != 'captain' ? 'aria-disabled=true' : '' }}>
                                <div class="sb-nav-link-icon"><i class="fas fa-globe text-black"></i></div>
                                Event Management
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-black"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsevent" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('events') }}">Events</a>
                                </nav>
                            </div>
                
                            <!-- Health Worker Management -->
                            <a class="nav-link collapsed {{ Auth::user()->user_type == 'health' || Auth::user()->user_type == 'captain' ? '' : 'disabled' }}" href="#" 
                               data-bs-toggle="collapse" data-bs-target="#collapseLayoutsworker" aria-expanded="false" aria-controls="collapseLayoutsworker"
                               {{ Auth::user()->user_type != 'health' && Auth::user()->user_type != 'captain' ? 'aria-disabled=true' : '' }}>
                                <div class="sb-nav-link-icon"><i class="fas fa-hand-holding-heart text-black"></i></div>
                                Health Worker Management
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down text-black"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsworker" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('immunize') }}">Immunization Schedule</a>
                                    {{-- <a class="nav-link" href="{{ route('prenatal') }}">Prenatal Schedule</a> --}}
                                </nav>
                            </div>
                            
                            <!-- User Management (Visible for captain only) -->
                            <a class="nav-link {{ Auth::user()->user_type == 'captain' ? '' : 'disabled' }}" href="{{ route('users.users') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-users text-black"></i></div>
                                User Management
                            </a>

                            <a class="nav-link" href="{{ route('comments.comments') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-exchange-alt text-black"></i></div>
                                Comments
                            </a>

                            <!-- About Us (Visible for all users) -->
                            <div class="sb-sidenav-menu-heading">Barangay Info</div>
                            <a class="nav-link" href="{{ route('dashboard.about-us') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table text-black"></i></div>
                                About Us
                            </a>

                            @endif
                        </div>
                    </div>
                
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ Auth::user()->email }}
                    </div>
                </nav>
            </div>