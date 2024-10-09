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
           
            <i class="fa-solid fa-house icon-color "  alt="Home" aria-hidden="true" tabindex="0" > </i>
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
                  <li>
                      {{-- <a href="/update" class="flex items-center space-x-2 cursor-pointer hover:underline">
                          <span class="inline-block w-2 h-2 rounded-full bg-black"></span>
                          <span>Update Resident</span>
                      </a> --}}
                  </li>
                  <li>
                      <a href="/blotters" class="flex items-center space-x-2 cursor-pointer hover:underline">
                          <span class="inline-block w-2 h-2 rounded-full bg-black"></span>
                          <span>Blotters Record</span>
                      </a>
                  </li>
                  <li>
                     <a href="/list" class="flex items-center space-x-2 cursor-pointer hover:underline">
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
          <button type="submit" class="btn text-white   absolute bottom-0">Log Out</button>
        </div>
      </form>
      
        
      </div>

                              <!-- Heading-->
                              <div class="w-4/5 h-auto bg-cover bg-center" style="background-image: url('{{ asset('storage/bg.png') }}'); background-size: contain; background-position: center; background-repeat: no-repeat;">
                                <h1 class="head text-3xl font-bold ">Barangay Tinago</h1>
    <img src=" {{URL ('storage/tinago.png')}}" alt="tinago" class="tinago" >


    <!-- Information-->
<div class="p-5">
    <body class="font-sans antialiased bg-gray-100">
        <div class="container mx-auto px-4 py-8">
          
            <h2 class="text-2xl font-bold mb-4">Barangay Blotter</h2>
    
            <table class="w-full border-collapse border border-gray-200" id="blotterTable">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">Blotter ID</th>
                        <th class="border border-gray-300 px-4 py-2">Blotter Name</th>
                        <th class="border border-gray-300 px-4 py-2">Date</th>
                        <th class="border border-gray-300 px-4 py-2">Time</th>
                        <th class="border border-gray-300 px-4 py-2">Incident Type</th>
                        <th class="border border-gray-300 px-4 py-2">Location</th>
                        <th class="border border-gray-300 px-4 py-2">Reported By</th>
                        <th class="border border-gray-300 px-4 py-2">Responding Officer</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                        <th class="border border-gray-300 px-4 py-2">Description</th>
                        <th class="border border-gray-300 px-4 py-2">Delete</th>
                        <th class="border border-gray-300 px-4 py-2">Save</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($blottersrecords as $blottersrecord)
                  <tr id={{$blottersrecord->id}} class="text-center">
                     <td>{{$blottersrecord->id}}</td>
                     <td>{{$blottersrecord->blotters_name}}</td>
                     <td>{{$blottersrecord->date}}</td>
                     <td>{{$blottersrecord->time}}</td>
                     <td>{{$blottersrecord->incident_type}}</td>
                     <td>{{$blottersrecord->location}}</td>
                     <td>{{$blottersrecord->reported_by}}</td>
                     <td>{{$blottersrecord->responding_officer}}</td>
                     <td>{{$blottersrecord->status}}</td>
                     <td>{{$blottersrecord->description}}</td>
                     <td>
                      <form action="{{ route('admin_delete_blottersrecord', $blottersrecord->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button class="bg-red-500 text-white px-2 py-1 rounded" type="submit">Delete</button>
                      </form>
                  </td>
                      <!-- Add your row data here -->
                  </tr>
                  @endforeach
                </tbody>
            </table>
    
            <button onclick="addEventRow()" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
              Add Blotter
          </button>


</div>
  </div>
  

  <script>
    // Function to handle the save button click
    function saveBlottersRecord(newRow) {
      const blotters_ID = newRow.children[0].innerText; // Get text from the first cell
      const blotters_name = newRow.children[1].innerText; // Get text from the second cell
      const date = newRow.children[2].innerText; // Get text from the third cell
      const time = newRow.children[3].innerText;
      const incident_type = newRow.children[4].innerText;
      const location = newRow.children[5].innerText;
      const reported_by = newRow.children[6].innerText;
      const responding_officer = newRow.children[7].innerText;
      const status = newRow.children[8].innerText;
      const description = newRow.children[9].innerText;
      
  
      console.log(blotters_ID);
      console.log(blotters_name);
      console.log(date);
      console.log(time);
      console.log(incident_type);
      console.log(location);
      console.log(reported_by);
      console.log(responding_officer);
      console.log(status);
      console.log(description);

      
  
     // Create a FormData object to send the data
     var formData = new FormData();
      formData.append('blotters_ID', blotters_ID);
      formData.append('blotters_name', blotters_name);
      formData.append('date', date);
      formData.append('time', time);
      formData.append('incident_type', incident_type);
      formData.append('location', location);
      formData.append('reported_by', reported_by);
      formData.append('responding_officer', responding_officer);
      formData.append('status', status);
      formData.append('description', description);
  
      const url = `{{ route('save-blottersrecord', ['blotters_ID', 'blotters_name', 'date', 'time', 'incident_type', 'location', 'reported_by','responding_officer', 'status', 'description']) }}`
      .replace('blotters_ID', blotters_ID)
      .replace('blotters_name', blotters_name)
      .replace('date', date)
      .replace('time', time)
      .replace('incident_type', incident_type)
      .replace('location', location)
      .replace('reported_by', reported_by)
      .replace('responding_officer', responding_officer)
      .replace('status', status)
      .replace('description', description);
  console.log(url);
  
     
      // Make an AJAX request to save the event
      fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token
    },
    // body: formData
  
  })
  .then(response => {
    if (!response.ok) {
    
      throw new Error(`Error: ${response.status} ${response.statusText}`);
    }
    return response.json();
  })
  .then(data => {
    if(data.status === '200'){
      alert("Blotters Added");
    }
    console.log(data);
    // Optionally add another row or handle success
  })
  .catch((error) => {
    console.error('Error:', error);
  });
    }
  
  
    function addEventRow() {
      // Get the table body where new rows will be added
      const tableBody = document.querySelector('#blotterTable tbody');
  
      // Create a new table row
      const newRow = document.createElement('tr');
      newRow.className = 'bg-gray-100'; // Apply styles to new rows if needed
  
      // Create 3 editable cells
      for (let i = 0; i < 10; i++) {
        const newCell = document.createElement('td');
        newCell.className = 'border border-gray-300 px-4 py-2'; // Add styling
        newCell.setAttribute('contenteditable', 'true'); // Make cell editable
        newCell.setAttribute('id' , 'cell_'+i);
        newRow.appendChild(newCell);
      }
  
      // Create a cell for the delete button
      const deleteCell = document.createElement('td');
      deleteCell.className = 'border border-gray-300 px-4 py-2'; // Add styling
  
      // Create the delete button
      const deleteButton = document.createElement('button');
      deleteButton.textContent = 'Delete';
      deleteButton.className = 'bg-red-500 text-white px-2 py-1 rounded'; // Add styling
      deleteButton.onclick = function() {
        deleteRow(newRow); // Call the delete function with the current row
      };
  
      // Append the delete button to the cell
      deleteCell.appendChild(deleteButton);
      newRow.appendChild(deleteCell);
  
      // Create a cell for the save changes button
      const saveCell = document.createElement('td');
      saveCell.className = 'border border-gray-300 px-4 py-2'; // Add styling
  
      // Create the save changes button
      const saveButton = document.createElement('button');
      saveButton.textContent = 'Save';
      saveButton.className = 'bg-blue-500 text-white px-2 py-1 rounded'; // Add styling
      saveButton.onclick = function() {
        if(validateTable() == true){
        saveBlottersRecord(newRow);
      } // Call the saveEvent function to save the current row
      };
  
      // Append the save button to the cell
      saveCell.appendChild(saveButton);
      newRow.appendChild(saveCell);
  
      // Add the new row to the table body
      tableBody.appendChild(newRow);
    }
  
    // Function to delete a specific row
    function deleteRow(row) {
      row.remove(); // Remove the row from the table
    }
    function validateTable(newROw) {
  const cell_1 = document.getElementById('cell_0').innerText.trim();
  const cell_2 = document.getElementById('cell_1').innerText.trim();
  const cell_3 = document.getElementById('cell_2').innerText.trim();
  const cell_4 = document.getElementById('cell_3').innerText.trim();
  const cell_5 = document.getElementById('cell_4').innerText.trim();
  const cell_6 = document.getElementById('cell_5').innerText.trim();
  const cell_7 = document.getElementById('cell_6').innerText.trim();
  const cell_8 = document.getElementById('cell_7').innerText.trim();
  const cell_9 = document.getElementById('cell_8').innerText.trim();
  const cell_10 = document.getElementById('cell_9').innerText.trim();

  if (!cell_1 || !cell_2 || !cell_3 ||!cell_4 || !cell_5 || !cell_6 || !cell_7 || !cell_8 || !cell_9 ||!cell_10) {
    alert('All fields are required!');
    return false;
  }else {
    return true;
   // saveEvent(newRow);
  }
    }
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
      