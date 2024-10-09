<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link   href="/css/add.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    
  </head>
  <body>

                                                  <!-- Profile Side-->

    <div class="flex">
  
      <div class="bg w-1/5   sm:pb-32 sm:p-16 sm:pl-16 text-3xl font-bold space-y-28 ">

        <div class="flex items-center space-x-2 text-black ">
          <img src="https://placehold.co/50x50" alt="Profile" class="rounded-full">
          <span>Profile</span>
        </div>
     
        <nav class="space-y-10 text-white">
          <a href="/home" class="flex items-center space-x-2 ">
           
            <i class="fa-solid fa-house icon-color  "  alt="Home" aria-hidden="true" tabindex="0" > </i>
            <span class=" hover:underline" >Home</span>
          </a>
       
          <div class="relative group space-y-2 block cursor-pointer">
            <a href="/residence" class="flex items-center space-x-2 hover:underline">
              <i class="fa-solid fa-user-group icon-color active" alt="Residence Management" aria-hidden="true" tabindex="0"></i> 
                <span>Residence Management</span>
            </a>
        
            <!-- Hover Side-->
            <div class="submenu space-y-1 hidden group-hover:block absolute top-full bg-white shadow-lg border">
              <ul class="flex flex-col">
                  <li>
                      <a href="/residence" class="flex items-center space-x-2 cursor-pointer hover:underline">
                          <span class="inline-block w-2 h-2 rounded-full bg-black"></span>
                          <span>Add Resident</span>
                      </a>
                  </li>
                  {{-- <li>
                      <a href="/update" class="flex items-center space-x-2 cursor-pointer hover:underline">
                          <span class="inline-block w-2 h-2 rounded-full bg-black"></span>
                          <span>Update Resident</span>
                      </a>
                  </li> --}}
                  <li>
                      <a href="/blotters" class="flex items-center space-x-2 cursor-pointer hover:underline">
                          <span class="inline-block w-2 h-2 rounded-full bg-black"></span>
                          <span>Blotters Record</span>
                      </a>
                  </li>
                  <li>
                      <a href="#" class="flex items-center space-x-2 cursor-pointer hover:underline">
                          <span class="inline-block w-2 h-2 rounded-full bg-black"></span>
                          <span>Residence List</span>
                      </a>
                  </li>
              </ul>
          </div>
        </div>
        
    
        <div class="relative group space-y-2 block cursor-pointer">
          <a href="#" class="flex items-center space-x-2">
            <i class="fa-solid fa-coins icon-color" alt="Financial Management" aria-hidden="true" tabindex="0"> </i> 
            <span class=" hover:underline">Financial Management</span>
          </a>
          <div class="finance ml-6 space-y-1 hidden group-hover:block absolute right-0 top-full bg-white shadow-lg border">
            <a href="/budget" class="flex items-center space-x-2 cursor-pointer hover:underline">
                <span class="inline-block w-2 h-2 rounded-full bg-black"></span>
                <span>Budget Plan</span>
            </a>
            <a href="/expense" class="flex items-center space-x-2 cursor-pointer hover:underline">
                <span class="inline-block w-2 h-2 rounded-full bg-black"></span>
                <span>Transaction Reporting</span>
            </a>
        </div>
        
        </div>

          <a href="/event" class="flex items-center space-x-2">
            <i class="fa-regular fa-calendar-days icon-color" alt="Event Management" aria-hidden="true" tabindex="0" ></i> 
            <span class=" hover:underline">Event Management</span>
          </a>
          <div class="relative group space-y-2 block cursor-pointer">
            <a href="/immunization" class="flex items-center space-x-2">
              <i class="fa-solid fa-notes-medical icon-color" alt="Residence Management" aria-hidden="true"  tabindex="0"></i> 
                <span class="hover:underline">Health Worker Management</span>
            </a>
        
            <!-- Hover Side-->
            <div class="health submenu ml-6 space-y-1 hidden group-hover:block absolute right-0 top-full bg-white shadow-lg border">
              <a href="/immunization" class="flex items-center space-x-2 cursor-pointer hover:underline">
                  <span class="inline-block w-2 h-2 rounded-full bg-black"></span>
                  <span>Immunization Schedule</span>
              </a>
              <a href="/prenatal" class="flex items-center space-x-2 cursor-pointer hover:underline">
                  <span class="inline-block w-2 h-2 rounded-full bg-black"></span>
                  <span>Pre-Natal Schedule</span>
              </a>
              {{-- <a href="/referral" class="flex items-center space-x-2 cursor-pointer hover:underline">
                  <span class="inline-block w-2 h-2 rounded-full bg-black"></span>
                  <span>Referral</span>
              </a> --}}
          </div>
          
        </div>
   
        </nav>
     
        <form action="/signin" method="post">  <div class="flex justify-center top">
          <button type="submit" class="btn text-white  absolute bottom-0">Log Out</button>
        </div>
      </form>
      
        
      </div>

                              <!-- Heading-->
                              <div class="w-4/5 h-auto bg-cover bg-center" style="background-image: url('{{ asset('storage/bg.png') }}'); background-size: contain; background-position: center; background-repeat: no-repeat;">


                          

                                <h1 class="head text-3xl font-bold ">Barangay Tinago</h1>
                                <img src=" {{URL ('storage/tinago.png')}}" alt="tinago" class="tinago" >
                                
                                <!-- Inserted Code Here -->
                                <div class="p-5">
                                  <body class="font-sans antialiased bg-gray-100">
                                      <div class="container mx-auto px-4 py-8">
                                          <!-- Flexbox to align heading and search bar -->
                                          <div class="flex justify-between items-center mb-5">
                                            <h2 class="text-2xl font-bold mb-5 border-2 border-green-700 text-center bg-green-600 rounded-lg px-5 py-2 w-[50%] mx-auto">Residence List</h2>
                              
                                              <!-- Search bar -->
                                              <input type="text" placeholder="Residents/Purok" class="border border-gray-300 rounded-lg px-4 py-2 w-[8%] text-xs focus:outline-none focus:ring-1 focus:ring-green-500">
                                            </div>
                              
                                          <div class="overflow-x-auto">
                                           <!-- Table Structure -->
<table class="w-full border-collapse border border-gray-200" id="SchedTable">
  <thead>
      <tr class="bg-gray-200">
          <th class="border border-gray-300 px-4 py-2">Full Name</th>
          <th class="border border-gray-300 px-4 py-2">Contact Number</th>
          <th class="border border-gray-300 px-4 py-2">Purok</th>
          <th class="border border-gray-300 px-4 py-2"></th>
      </tr>
  </thead>
  <tbody>
      @foreach($residents as $resident)
          <tr class="bg-gray-100 text-center">
              <td class="border border-gray-300 px-4 py-2">{{ $resident->full_name }}</td>
              <td class="border border-gray-300 px-4 py-2">{{ $resident->contact_number }}</td>
              <td class="border border-gray-300 px-6 py-2 w-32">{{ $resident->purok }}</td>
              <td class="border border-gray-300 px-6 py-2 w-32">
                  <button class="more-details-toggle bg-blue-500 text-white px-4 py-1 rounded" data-resident="{{ json_encode($resident) }}">More Details</button>
              </td>
          </tr>
      @endforeach
  </tbody>
</table>

<!-- Modal Structure -->
<div id="detailsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center">
  <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
      <h2 class="text-xl font-bold mb-4">Resident Details</h2>
      <div id="modalContent"></div>
      <div class="flex justify-between mt-4">
          <button id="closeModal" class="bg-red-500 text-white px-4 py-2 rounded">Close</button>
          <button id="updateModal" class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
          <button id="deleteModal" class="bg-red-700 text-white px-4 py-2 rounded">Delete</button>
      </div>
  </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function () {
      const buttons = document.querySelectorAll('.more-details-toggle');
      const modal = document.getElementById('detailsModal');
      const modalContent = document.getElementById('modalContent');
      const closeModalButton = document.getElementById('closeModal');
      const updateModalButton = document.getElementById('updateModal');
      const deleteModalButton = document.getElementById('deleteModal');
      let currentResidentId = null; // To store the current resident's ID for update and delete actions

      buttons.forEach(button => {
          button.addEventListener('click', function () {
              const resident = JSON.parse(this.getAttribute('data-resident'));
              currentResidentId = resident.id; // Store the resident's ID

              modalContent.innerHTML = `
                  <p><strong>Full Name:</strong> ${resident.full_name}</p>
                  <p><strong>Sex:</strong> ${resident.sex}</p>
                  <p><strong>Date of Birth:</strong> ${resident.date_of_birth}</p>
                  <p><strong>Age:</strong> ${resident.age}</p>
                  <p><strong>Civil Status:</strong> ${resident.civil_status}</p>
                  <p><strong>Purok:</strong> ${resident.purok}</p>
                  <p><strong>Address:</strong> ${resident.address}</p>
                  <p><strong>Educational Level:</strong> ${resident.educational_level}</p>
                  <p><strong>Occupation:</strong> ${resident.occupation}</p>
                  <p><strong>Employment Status:</strong> ${resident.employment_status}</p>
                  <p><strong>Contact Number:</strong> ${resident.contact_number}</p>
                  <p><strong>Family Members:</strong> ${resident.family_members ? resident.family_members.join(', ') : 'N/A'}</p>
              `;

              modal.classList.remove('hidden');
          });
      });

      closeModalButton.addEventListener('click', function () {
          modal.classList.add('hidden');
      });

      updateModalButton.addEventListener('click', function () {
    // Redirect to the update route (adjust the route as necessary)
    window.location.href = `/admin/residence/${currentResidentId}/edit`; // Ensure this route is correct
});


      deleteModalButton.addEventListener('click', function () {
          if (confirm('Are you sure you want to delete this resident? This action cannot be undone.')) {
              // Send a DELETE request to your delete route (adjust the route as necessary)
              fetch(`/residents/${currentResidentId}`, {
                  method: 'DELETE',
                  headers: {
                      'X-CSRF-TOKEN': '{{ csrf_token() }}', // Ensure you include the CSRF token
                      'Content-Type': 'application/json',
                  },
              })
              .then(response => {
                  if (response.ok) {
                      // Find the row in the table and remove it
                      const row = buttons[Array.from(buttons).indexOf(deleteModalButton)].closest('tr');
                      row.remove(); // Remove the row from the table
                      modal.classList.add('hidden'); // Close the modal after deletion
                  } else {
                      alert('Error deleting the resident. Please try again.');
                  }
              })
              .catch(error => {
                  console.error('Error:', error);
                  alert('An error occurred while deleting the resident.');
              });
          }
      });
  });
</script>




    </body>
    </html>

    <style>


@import url('https://fonts.googleapis.com/css2?family=Maname&family=Nunito:ital,wght@1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

      
     .btn {
    background-color: white;
    font-size: 50%;
    color: black; 
    border-radius: 6px;
    padding-left: 70px;
    padding-right: 70px;
    bottom: 2%;
}

  .bg{
    background-color: 729762;
  }
        .relative {
          position: relative; /* Establishes the context for absolute positioning */
        }
        .finance{
          
          position: absolute; /* Allows precise positioning relative to the nearest relative parent */
          right: -60%;           /* Aligns the submenu to the right edge of the parent */
          top: 0;          /* Positions the submenu below the parent */
          display: none;      /* Initially hidden */
          background-color: 80AF81; /* Ensures the submenu has a distinct background */
          border: 1px solid #ddd;  /* Adds a border to the submenu */
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow */
          padding: 10px;      /* Adds padding inside the submenu */
          z-index: 1000;      /* Ensures the submenu appears above other elements */
          border-radius: 10px;
          font-size: 80%;
          transition-delay: 1s;
        
        }
      
        .submenu {
          position: absolute; /* Allows precise positioning relative to the nearest relative parent */
          right: -80%;           /* Aligns the submenu to the right edge of the parent */
          top: 0;          /* Positions the submenu below the parent */
          display: none;      /* Initially hidden */
          background-color: 80AF81; /* Ensures the submenu has a distinct background */
          border: 1px solid #ddd;  /* Adds a border to the submenu */
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow */
          padding: 10px;      /* Adds padding inside the submenu */
          z-index: 1000;      /* Ensures the submenu appears above other elements */
          border-radius: 10px;
          font-size: 80%;
          transition-delay: 1s;
        }
      
        .group:hover .submenu {
          display: block;     /* Shows the submenu when the parent is hovered */
        }
        .health{
    position: absolute; /* Allows precise positioning relative to the nearest relative parent */
          right: -110%;           /* Aligns the submenu to the right edge of the parent */
          top: 0;          /* Positions the submenu below the parent */
          display: none;      /* Initially hidden */
          background-color: 80AF81; /* Ensures the submenu has a distinct background */
          border: 1px solid #ddd;  /* Adds a border to the submenu */
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow */
          padding: 10px;      /* Adds padding inside the submenu */
          z-index: 1000;      /* Ensures the submenu appears above other elements */
          border-radius: 10px;
          font-size: 80%;
          transition-delay: 1s;
        }
        .icon-color {
    color: 000000; /* Replace with your desired color */
}
.icon-color:hover, .icon-color:active, .icon-color:focus, .active {
    border-left: 5px solid white;
    border-radius: 5px;
    padding: 2px;
}


.head{
  background-color: 508D4E;
  padding: 40px;
font-family: 'Poppins';
}
.tinago {
            position: absolute;
            top: -30;
            right: 30;
            width: 8%;
            height: 18%;
        }

      </style>
      