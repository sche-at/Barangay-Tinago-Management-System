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
           
            <i class="fa-solid fa-house icon-color   "  alt="Home" aria-hidden="true" tabindex="0" > </i>
            <span class=" hover:underline" >Home</span>
          </a>
       
          <div class="relative group space-y-2 block cursor-pointer">
            <a href="/residence" class="flex items-center space-x-2 hover:underline">
              <i class="fa-solid fa-user-group icon-color" alt="Residence Management" aria-hidden="true" tabindex="0"></i> 
                <span>Residence Management</span>
            </a>
        
            <!-- Hover Side-->
            <div class="submenu space-y-1 hidden group-hover:block absolute top-full bg-white shadow-lg border">
              <ul class="flex flex-col">
                  <li>
                      <a href="#" class="flex items-center space-x-2 cursor-pointer hover:underline">
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
                <span>Expenses</span>
            </a>
        </div>
        
        </div>

          <a href="/event" class="flex items-center space-x-2">
            <i class="fa-regular fa-calendar-days icon-color" alt="Event Management" aria-hidden="true" tabindex="0" ></i> 
            <span class=" hover:underline">Event Management</span>
          </a>
          <div class="relative group space-y-2 block cursor-pointer">
            <a href="/immunization" class="flex items-center space-x-2">
              <i class="fa-solid fa-notes-medical icon-color active" alt="Residence Management" aria-hidden="true"  tabindex="0"></i> 
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
  <div class="w-4/5">
    <h1 class="head text-3xl font-bold ">Barangay Tinago</h1>
    <img src=" {{URL ('storage/tinago.png')}}" alt="tinago" class="tinago" >


    <!-- Information-->
<div class="p-5">
    <body class="font-sans antialiased bg-gray-100">
        <div class="container mx-auto px-4 py-8">
    
            <h2 class="text-2xl font-bold mb-4">Pre-Natal Data Schedule</h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-200" id="SchedTable">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2">Date</th>
                            <th class="border border-gray-300 px-4 py-2">Time</th>
                            <th class="border border-gray-300 px-4 py-2">Activity</th>
                            <th class="border border-gray-300 px-4 py-2">Location</th>
                            <th class="border border-gray-300 px-4 py-2">Delete</th>
                            <th class="border border-gray-300 px-4 py-2">Save</th>
                          
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class="bg-white hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2">2024-07-17</td>
                            <td class="border border-gray-300 px-4 py-2">10:00 AM</td>
                            <td class="border border-gray-300 px-4 py-2">Meeting</td>
                            <td class="border border-gray-300 px-4 py-2">Health Center</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
    
            <!-- Add Schedule Button -->
            <div class="mt-4">
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded" onclick="addSchedRow()">Add Schedule</button>
            </div>
        </div>


</div>
  </div>
  

  <script>
function addSchedRow() {
    // Get the table body where new rows will be added
    const tableBody = document.querySelector('#SchedTable tbody');

    // Create a new table row
    const newRow = document.createElement('tr');
    newRow.className = 'bg-gray-100'; // Apply styles to new rows if needed

    // Create 4 editable cells (Date, Time, Activity, Location)
    for (let i = 0; i < 4; i++) {
        const newCell = document.createElement('td');
        newCell.className = 'border border-gray-300 px-4 py-2'; // Add styling
        newCell.setAttribute('contenteditable', 'true'); // Make cell editable
        newRow.appendChild(newCell);
    }

    // Create the delete button cell
    const deleteCell = document.createElement('td');
    deleteCell.className = 'border border-gray-300 px-4 py-2';

    // Create the delete button
    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.className = 'bg-red-500 text-white px-4 py-1 rounded'; // Add styling
    deleteButton.onclick = function() {
        deleteRow(newRow); // Call the delete function with the current row
    };

    deleteCell.appendChild(deleteButton);
    newRow.appendChild(deleteCell);

    // Create the save button cell
    const saveCell = document.createElement('td');
    saveCell.className = 'border border-gray-300 px-4 py-2';

    // Create the save button
    const saveButton = document.createElement('button');
    saveButton.textContent = 'Save';
    saveButton.className = 'bg-green-500 text-white px-4 py-1 rounded'; // Add styling
    saveButton.onclick = function() {
        saveRow(newRow); // Call the save function with the current row
    };

    saveCell.appendChild(saveButton);
    newRow.appendChild(saveCell);

    // Add the new row to the table body
    tableBody.appendChild(newRow);
}

// Function to delete a specific row
function deleteRow(row) {
    row.remove();
}

// Function to save a specific row (you can implement actual saving logic here)
function saveRow(row) {
    const cells = row.querySelectorAll('td[contenteditable="true"]');
    cells.forEach(cell => {
        // You can save cell.textContent to a server or database here
        console.log('Saved:', cell.textContent);
    });
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
      