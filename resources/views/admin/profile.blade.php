@include('templates.header')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 mt-4">
            <div class="row">
                <div class="col-xl-4 col-lg-6 mb-4">
                    <!-- Profile picture card -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header text-center">
                            <h5 class="mb-0">Profile Picture</h5>
                        </div>
                        <div class="card-body text-center">
                            <!-- Profile picture image with default icon -->
                            <div id="profile-picture-preview" class="mb-3">
                                <img src="{{ asset('assets/img/avatar.png') }}" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-6 mb-4">
                    <!-- Account details card -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">
                            <form>
                                <!-- Form Group (username) -->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputUsername">Username</label>
                                    <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="{{ Auth::user()->username }}" disabled>
                                </div>
                                <!-- Form Row -->
                                <div class="row g-3 mb-3">
                                    <!-- Form Group (first name) -->
                                    <div class="col-md-12">
                                        <label class="small mb-1" for="inputFirstName">Name</label>
                                        <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" value="{{ Auth::user()->name }}" disabled>
                                    </div>
                                </div>
                                <!-- Form Row -->
                                <div class="row g-3 mb-3">
                                    <!-- Form Group (organization name) -->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputOrgName">Contact</label>
                                        <input class="form-control" id="inputOrgName" type="number" placeholder="Enter your number" value="{{ Auth::user()->contact }}" disabled>
                                    </div>
                                    <!-- Form Group (location) -->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputLocation">Email Address</label>
                                        <input class="form-control" id="inputLocation" type="text" placeholder="Enter your location" value="{{ Auth::user()->email }}" disabled>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('templates.footer')
</div>
