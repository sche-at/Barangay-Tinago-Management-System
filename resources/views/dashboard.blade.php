@include('templates.header')

<style>
    .announcement-title {
        text-align: center;
        margin: 30px 0;
        font-size: 2.5rem;
        font-weight: 800;
        color: #0D7C66;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .event-list {
        margin-top: 30px;
        padding: 0 20px;
    }

    .event-item {
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(13, 124, 102, 0.1);
        margin-bottom: 25px;
        transition: all 0.3s ease;
        border-left: 5px solid #0D7C66;
        background: linear-gradient(to right, #ffffff, #f8f9fa);
        margin-left: 40%;
        width: 90%;
        position: relative;
        overflow: hidden;
    }

    .event-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(13, 124, 102, 0.15);
    }

    .event-date {
        background: linear-gradient(135deg, #0D7C66, #0a5d4d);
        color: white;
        padding: 15px;
        border-radius: 10px;
        font-size: 1.1rem;
        box-shadow: 0 4px 8px rgba(13, 124, 102, 0.2);
    }

    .event-date .number {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 5px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
    }

    .event-title {
        font-weight: bold;
        font-size: 1.6rem;
        color: #2c3e50;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #eee;
    }

    .event-location {
        color: #566573;
        font-size: 1.1rem;
        margin: 10px 0;
        padding: 8px 0;
    }

    .badge {
        padding: 8px 15px;
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        border-radius: 20px;
        margin-top: 10px;
    }

    .bg-danger {
        background-color: #e74c3c !important;
    }

    .bg-info {
        background-color: #3498db !important;
    }

   

    .immunization-details {
        background-color: #f8f9fa;
        padding: 12px 15px;
        border-radius: 8px;
        margin: 15px 0;
        border: 1px solid #e9ecef;
    }

    .text-muted {
        color: #626567 !important;
        font-size: 1rem;
    }

    .mt-2 {
        margin-top: 15px !important;
    }

    marquee {
        font-size: 30px;
        margin: 20px 0;
    }
.scroll{
    background: linear-gradient(45deg, #0D7C66, #0a5d4d);
}
    .marquee-text {
        
        color: white;
        padding: 10px 20px;
        border-radius: 25px;
        box-shadow: 0 4px 6px rgba(13, 124, 102, 0.1);
        display: inline-block;
        font-weight: 600;
        letter-spacing: 1px;
    }

    /* QR Code Styling */
    .qr-container {
        position: fixed;
        left: 300px;
        top: 55%;
        transform: translateY(-50%);
        z-index: 1000;
        background-color: white;
        padding: 10px;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        
    }

    .qr-container:hover {
        transform: translateY(-52%) scale(1.05);
    }

    .qr-container img {
    border-radius: 8px !important;
    width: 500px !important;    /* Change this value to whatever size you want */
    height: 500px !important;   /* Keep same as width */
    object-fit: contain !important;
}

    /* Additional Enhancements */
    strong {
        color: #0D7C66;
        font-weight: 600;
    }

    p {
        line-height: 1.6;
        color: #444;
    }
    /* Update QR container style to include padding for text */
.qr-container {
    position: fixed;
    left: 300px;
    top: 65%;
    transform: translateY(-50%);
    z-index: 1000;
    background-color: white;
    padding: 15px;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    text-align: center;
}

.qr-container:hover {
    transform: translateY(-52%) scale(1.05);
}

/* Style for the payment text inside QR container */
.qr-payment-text {
    background: linear-gradient(45deg, #0D7C66, #0a5d4d);
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    font-weight: bold;
    font-size: 0.85rem;
    margin-bottom: 10px;
    display: block;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.02);
    }
    100% {
        transform: scale(1);
    }
}


</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            @if(Auth::user()->user_type == "resident")
            @php
                $prenatals = App\Models\Prenatal::select('*', 'created_at as sort_date')->get()->toArray();
                $immunizes = App\Models\Immunize::select('*', 'created_at as sort_date')->get()->toArray();
                $events = App\Models\Event::select('*', 'created_at as sort_date')->get()->toArray();

                $allRecordsArray = array_merge($prenatals, $immunizes, $events);
                usort($allRecordsArray, function($a, $b) {
                    return strtotime($b['created_at']) - strtotime($a['created_at']);
                });
            @endphp

            <div class="announcement-title">📢 Announcements</div>
            
            <div class="qr-container">
              <div class="qr-payment-text">
                  PLEASE SCAN THE CODE FOR PAYMENT 💳
              </div>
              @if(file_exists(public_path('assets/img/gcash.jpg')))
                  <img src="{{ asset('assets/img/gcash.jpg') }}" alt="QR Code">
              @else
                  <div class="qr-placeholder">
                      <span>QR</span>
                  </div>
              @endif
          </div>
<div class= "scroll">
            <marquee behavior="scroll" direction="left" scrollamount="15">
                <span class="marquee-text">🏢 BARANGAY TINAGO MANAGEMENT SYSTEM 🏢</span>
            </marquee>
</div>
            <div class="event-list">
                @foreach($allRecordsArray as $key => $record)
                <div class="row event-item">
                    <div class="col-md-4">
                        <div class="event-date">
                            <div class="number">{{ $key + 1 }}</div>
                            <div>
                                @if(isset($record['activity']))
                                    When: {{ \Carbon\Carbon::parse($record['created_at'])->format('M. d, Y') }}
                                @elseif(isset($record['vaccine']))
                                    <div>When: {{ \Carbon\Carbon::parse($record['date'])->format('M. d, Y') }}</div>
                                    <div>@ {{ \Carbon\Carbon::parse($record['time'])->format('h:i A') }}</div>
                                @else
                                    <div>When: {{ \Carbon\Carbon::parse($record['event_date'])->format('M. d, Y') }}</div>
                                    <div>@ {{ \Carbon\Carbon::parse($record['event_time'])->format('h:i A') }}</div>
                                @endif
                            </div>
                            <div>
                                @if(isset($record['activity']))
                                    <span class="badge bg-danger">Pre-natal</span>
                                @elseif(isset($record['vaccine']))
                                    <span class="badge bg-info">Immunization Announcement</span>
                                @else
                                    <span class="badge bg-success">Event Announement</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="event-title">
                            @if(isset($record['activity']))
                                <strong>Activity:</strong> {{ $record['activity'] }}
                            @elseif(isset($record['vaccine']))
                                <strong>Vaccine:</strong> {{ $record['vaccine'] }}
                                <div class="immunization-details">
                                    <strong>Required Age:</strong> {{ $record['age'] }} years old<br>
                                    <strong>Dosage:</strong> {{ $record['dosage'] }}
                                </div>
                            @else
                                <strong>Event:</strong> {{ $record['event_type'] }}
                            @endif
                        </div>
                        <div class="event-location">
                            @if(isset($record['activity']))
                                <strong>Venue:</strong> {{ $record['venue'] }}
                            @elseif(isset($record['vaccine']))
                                <strong>Venue:</strong> {{ $record['venue'] }}
                            @else
                                <strong>Venue:</strong> {{ $record['event_venue'] }}
                            @endif
                        </div>
                        <p class="mt-2">
                            @if(isset($record['activity']))
                                {{ 'No description available.' }}
                            @elseif(isset($record['vaccine']))
                                <strong>Additional Notes:</strong> {{ $record['notes'] ?: 'No additional notes available.' }}
                            @else
                                {{ 'No description available.' }}
                            @endif
                        </p>
                    </div>
                </div>
                @endforeach
           
        </div>
    </main>
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
                                width="1610"
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
