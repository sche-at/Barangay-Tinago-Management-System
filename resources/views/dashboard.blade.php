
@include('templates.header')

<style>
    .announcement-title {
      text-align: center;
      margin: 20px 0;
      font-size: 2rem;
      font-weight: bold;
      color: #007bff;
    }
    .event-list {
      margin-top: 20px;
    }
    .event-item {
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      transition: transform 0.2s ease-in-out;
    }
    .event-item:hover {
      transform: scale(1.02);
    }
    .event-date {
      background-color: #0D7C66;
      color: white;
      padding: 10px 15px;
      text-align: center;
      border-radius: 5px;
      font-size: 1.2rem;
    }
    .event-title {
      font-weight: bold;
      font-size: 1.5rem;
    }
    .event-location {
      color: gray;
    }
    .flame {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .flame:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        @if(Auth::user()->user_type == "resident")
        @php
          $prenatals = App\Models\Prenatal::all()->toArray();
          $immunizes = App\Models\Immunize::all()->toArray();
          $events = App\Models\Event::all()->toArray();

          $allRecordsArray = array_merge($prenatals, $immunizes, $events);
        @endphp
        <div class="announcement-title">Announcements </div>
        <div class="event-list">
          @foreach($allRecordsArray as $record)
          <div class="row event-item bg-light">
              <div class="col-md-2 text-center">
                  <div class="event-date">
                      <div>{{ \Carbon\Carbon::parse($record['created_at'])->format('M. d, Y') }}</div>
                      <div>
                          @if(isset($record['activity'])) <!-- Assuming there's a field to identify prenatal -->
                              <span class="badge bg-danger">Pre-natal</span>
                          @elseif(isset($record['vaccine'])) <!-- Assuming there's a field to identify immunize -->
                              <span class="badge bg-info">Immunize</span>
                          @else
                              <span class="badge bg-success">Event</span>
                          @endif
                      </div>
                  </div>
              </div>
              <div class="col-md-10">
                  <div class="event-title">
                    @if(isset($record['activity'])) <!-- Assuming there's a field to identify prenatal -->
                     {{ $record['activity'] }}
                    @elseif(isset($record['vaccine'])) <!-- Assuming there's a field to identify immunize -->
                      {{ $record['vaccine'] }}
                    @else
                      {{ $record['event_type'] }}
                    @endif
                  </div>
                  <div class="event-location">
                    @if(isset($record['activity'])) <!-- Assuming there's a field to identify prenatal -->
                     {{ $record['venue'] }}
                    @elseif(isset($record['vaccine'])) <!-- Assuming there's a field to identify immunize -->
                      {{ $record['venue'] }}
                    @else
                      {{ $record['event_venue'] }}
                    @endif
                  </div> <!-- Assuming a location field exists -->
                  <p>
                    @if(isset($record['activity'])) <!-- Assuming there's a field to identify prenatal -->
                      {{ 'No description available.' }}
                    @elseif(isset($record['vaccine'])) <!-- Assuming there's a field to identify immunize -->
                      {{ $record['notes'] }}
                    @else
                      {{ 'No description available.' }}
                    @endif
                  </p> <!-- Assuming a description field exists -->
              </div>
          </div>
          @endforeach
        </div>
        @else

        @php
            // Fetch the total counts directly in the view
            $totalResidents = \App\Models\FamilyMember::count();
            $totalHouseholds = \App\Models\Residence::count();

            // Fetch the total population for Resident and the family members
            $totalPopulation = $totalHouseholds + $totalResidents;

            $totalBlotters = \App\Models\Blooter::count();
            $totalUsers = \App\Models\User::count();

        @endphp
        
        <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card flame bg-primary text-white mb-4">
                            <div class="card-body">
                                <h5>Total Household</h5>
                                <h2>{{ $totalHouseholds }}</h2> <!-- Display total residents -->
                              </div>
                            </div>
                          </div>
                          <div class="col-xl-3 col-md-6">
                            <div class="card flame bg-warning text-white mb-4">
                              <div class="card-body">
                                <h5>Total Residence</h5>
                                <h2>{{ $totalPopulation }}</h2> <!-- Display total households -->
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card flame bg-danger text-white mb-4">
                            <div class="card-body">
                                <h5>Total Blotters</h5>
                                <h2>{{ $totalBlotters }}</h2> <!-- Display total blotters -->
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card flame bg-success text-white mb-4">
                            <div class="card-body">
                                <h5>Total Users</h5>
                                <h2>{{ $totalUsers }}</h2> <!-- Display total users -->
                            </div>
                        </div>
                    </div>
                </div>
              <div class="row">
                  <div class="col-xl-12">
                      <div class="card mb-4">
                          <div class="card-header">
                              <i class="fas fa-chart-area me-1"></i>
                              Location Of Barangay Hall Tinago
                          </div>
                          <div class="card-body">
                          <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3922.1683786811097!2d123.82422836451473!3d9.60863975364867!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33aa529c78aa6b05%3A0xd71b6305b6142930!2sTinago%20Barangay%20Hall!5e0!3m2!1sen!2sph!4v1697375840675!5m2!1sen!2sph"
                                width="1120"
                                height="450"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                          </div>
                      </div>
                  </div>
                  <!-- <div class="col-xl-6">
                      <div class="card mb-4">
                          <div class="card-header">
                              <i class="fas fa-chart-bar me-1"></i>
                              Bar Chart Example
                          </div>
                          <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                      </div>
                  </div> -->
              </div>

            @endif
        </div>
    </main>
@include('templates.footer')
