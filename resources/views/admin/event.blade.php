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
          <a href="/home" class="flex items-center space-x-2">
           
            <i class="fa-solid fa-house icon-color "  alt="Home" aria-hidden="true" > </i>
            <span class=" hover:underline" >Home</span>
          </a>

          <div class="relative group space-y-2 block cursor-pointer">
            <a href="/residence" class="flex items-center space-x-2 ">
              <i class="fa-solid fa-user-group icon-color " alt="Residence Management" aria-hidden="true"></i> 
                <span class=" hover:underline">Residence Management</span>
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
                        <a href="/update" class="flex items-center space-x-2 cursor-pointer hover:underline">
                            <span class="inline-block w-2 h-2 rounded-full bg-black"></span>
                            <span>Update Resident</span>
                        </a>
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
            <a href="/finance" class="flex items-center space-x-2">
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
                  <span>Expenses</span>
              </a>
          </div>
          
          </div>
  

        <a href="/event" class="flex items-center space-x-2">
          <i class="fa-regular fa-calendar-days icon-color active  " alt="Event Management" aria-hidden="true" ></i> 
          <span class=" hover:underline">Event Management</span>
        </a>

        <div class="relative group space-y-2 block cursor-pointer">
          <a href="/immunization" class="flex items-center space-x-2 ">
            <i class="fa-solid fa-notes-medical icon-color" alt="Residence Management" aria-hidden="true"  ></i> 
              <span class=" hover:underline">Health Worker Management</span>
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
                <a href="/referral" class="flex items-center space-x-2 cursor-pointer hover:underline">
                    <span class="inline-block w-2 h-2 rounded-full bg-black"></span>
                    <span>Referral</span>
                </a>
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
                                <h1 class="head text-3xl font-bold mb-6 ">Barangay Tinago</h1>
                                <img src=" {{URL ('storage/tinago.png')}}" alt="tinago" class="tinago" >
                              

                            <!-- Information-->
                            <div class="p-5">
                                  <!-- Centering the Table Container at the Top -->
            <div class="flex justify-center items-start min-h-screen">
                <div class="container mx-auto">
                    <!-- Table Title -->
                    <h2 class="text-2xl font-bold mb-4 text-center">Event Schedule</h2>
                    
                    <!-- Table -->
                    {{-- <form action=" " method="POST" class="space-y-4">
                      @csrf --}}
                      <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg" id="eventTable">
                          <thead class="bg-gray-200">
                              <tr>
                                  <th class="py-3 px-4 border-b border-gray-300">Types of Event</th>
                                  <th class="py-3 px-4 border-b border-gray-300">Date and Venue</th>
                                  <th class="py-3 px-4 border-b border-gray-300">Tasks Assigned</th>
                                  <th class="py-3 px-4 border-b border-gray-300">Delete</th>
                                  <th class="py-3 px-4 border-b border-gray-300">Add</th>
                              </tr>
                          </thead>
                          <tbody>
                              <!-- Example Row -->
                              @foreach ($events as $event)
                              <tr id={{$event->id}} class="text-center">
                                 <td>{{$event->type_of_event}}</td>
                                 <td>{{$event->date_and_venue}}</td>
                                 <td>{{$event->tasks_assigned}}</td>
                                 <td>
                                  <form action="{{ route('admin_delete_event', $event->id) }}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button class="bg-red-500 text-white px-2 py-1 rounded" type="submit">Delete</button>
                                  </form>
                              </td>
                                  <!-- Add your row data here -->
                              </tr>
                              @endforeach
                              <!-- Add more rows as needed -->
                          </tbody>
                      </table>
                     
                  {{-- </form> --}}
                  
                  <button onclick="addEventRow()" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                      Add Event
                  </button>
                  

    </div>

  </div>
</div>
</div>

<script>
  // Function to handle the save button click
  function saveEvent(newRow) {
    const typeOfEvent = newRow.children[0].innerText; // Get text from the first cell
    const dateAndVenue = newRow.children[1].innerText; // Get text from the second cell
    const tasksAssigned = newRow.children[2].innerText; // Get text from the third cell
 
    console.log(typeOfEvent);
    console.log(dateAndVenue);
    console.log(tasksAssigned);
   

   // Create a FormData object to send the data
   var formData = new FormData();
    formData.append('type_of_event', typeOfEvent);
    formData.append('date_and_venue', dateAndVenue);
    formData.append('tasks_assigned', tasksAssigned);

     

    const url = `{{ route('save-event', [':type_of_event', ':date_and_venue', ':tasks_assigned']) }}`
    .replace(':type_of_event', typeOfEvent)
    .replace(':date_and_venue', dateAndVenue)
    .replace(':tasks_assigned', tasksAssigned);

   
    // Make an AJAX request to save the event
    fetch(url, {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token
  },
   body: formData

})
.then(response => {
  if (!response.ok) {
    throw new Error(`Error: ${response.status} ${response.statusText}`);
  }
  return response.json();
})
.then(data => {
  if(data.status === '200'){
    alert("Event Added");
  }
  // Optionally add another row or handle success
})
.catch((error) => {
  console.error('Error:', error);
});
  }


  function addEventRow() {
    // Get the table body where new rows will be added
    const tableBody = document.querySelector('#eventTable tbody');

    // Create a new table row
    const newRow = document.createElement('tr');
    newRow.className = 'bg-gray-100'; // Apply styles to new rows if needed

    // Create 3 editable cells
    for (let i = 0; i < 3; i++) {
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
      validateTable();

      if(validateTable() == true){
        saveEvent(newRow);
      }
      // saveEvent(newRow); // Call the saveEvent function to save the current row
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

  if (!cell_1 || !cell_2 || !cell_3) {
    alert('All fields are required!');
    return false;
  }else {
    return true;
   // saveEvent(newRow);
  }
  

  // Proceed with form submission or further processing
 // alert('Form is valid!');
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
.icon-color:hover, .icon-color:active, .icon-color:focus, .active{
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
