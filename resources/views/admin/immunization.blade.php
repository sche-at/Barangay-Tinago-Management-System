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
            <span  class=" hover:underline">Home</span>
          </a>

          <div class="relative group space-y-2 block cursor-pointer">
            <a href="/residence" class="flex items-center space-x-2 hover:underline">
              <i class="fa-solid fa-user-group icon-color " alt="Residence Management" aria-hidden="true"></i> 
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
              <i class="fa-solid fa-coins icon-color " alt="Financial Management" aria-hidden="true" tabindex="0"> </i> 
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
          <i class="fa-regular fa-calendar-days icon-color  " alt="Event Management" aria-hidden="true" ></i> 
          <span class=" hover:underline">Event Management</span>
        </a>

        <div class="relative group space-y-2 block cursor-pointer">
          <a href="/immunization" class="flex items-center space-x-2 ">
            <i class="fa-solid fa-notes-medical icon-color active" alt="Residence Management" aria-hidden="true"  ></i> 
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
                              <div class="w-4/5 ">
                                <h1 class="head text-3xl font-bold mb-6 ">Barangay Tinago</h1>
                                <img src=" {{URL ('storage/tinago.png')}}" alt="tinago" class="tinago" >
                              

                            <!-- Information-->
                            <div class="p-5">
                                <div class="flex justify-center items-start min-h-screen">
                                    <div class="container mx-auto">
                                        <!-- Table Title -->
                                        <h2 class="text-2xl font-bold mb-4 text-center">Immunization Schedule</h2>
                                        
                                        <!-- Table -->
                                        <table id="immunizationTable" class="min-w-full bg-white border border-gray-200 rounded-lg shadow-lg">
                                            <thead class="bg-gray-200">
                                                <tr>
                                                    <th class="py-3 px-4 border-b border-gray-300">Vaccine</th>
                                                    <th class="py-3 px-4 border-b border-gray-300">Recommended Age</th>
                                                    <th class="py-3 px-4 border-b border-gray-300">Dosage</th>
                                                    <th class="py-3 px-4 border-b border-gray-300">Date&Venue</th>
                                                    <th class="py-3 px-4 border-b border-gray-300">Time</th>
                                                    <th class="py-3 px-4 border-b border-gray-300">Notes</th>
                                                    <th class="py-3 px-4 border-b border-gray-300">Delete</th>
                                                    <th class="py-3 px-4 border-b border-gray-300">Save</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Example Row -->
                                                <tr class="text-center">
                                                    <td class="border border-gray-300 px-4 py-2">Hepatitis B</td>
                                                    <td class="border border-gray-300 px-4 py-2">Birth</td>
                                                    <td class="border border-gray-300 px-4 py-2">0.5 ml</td>
                                                    <td class="border border-gray-300 px-4 py-2">Aug. 25, 2024 @ Barangay Hall</td>
                                                    <td class="border border-gray-300 px-4 py-2">8:00am</td>
                                                    <td class="border border-gray-300 px-4 py-2">labyu</td>
                                                </tr>
                                                <!-- Add more rows as needed -->
                                            </tbody>
                                        </table>
                                        <button onclick="addImmunizationRow()" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                          Add Vaccine
                                        </button>
                                    </div>

    </div>

  </div>
</div>
</div>

<script>
  function addImmunizationRow() {
      // Get the table body where new rows will be added
      const tableBody = document.querySelector('#immunizationTable tbody');

      // Create a new table row
      const newRow = document.createElement('tr');
      newRow.className = 'text-center bg-gray-100'; // Apply styles to new rows if needed

      // Create 6 editable cells for Vaccine, Recommended Age, Dosage, Date & Venue, Time, and Notes
      for (let i = 0; i < 6; i++) {
          const newCell = document.createElement('td');
          newCell.className = 'border border-gray-300 px-4 py-2'; // Add styling
          newCell.setAttribute('contenteditable', 'true'); // Make cell editable
          newRow.appendChild(newCell);
      }

      // Add a Delete button in the 7th cell
      const deleteCell = document.createElement('td');
      deleteCell.className = 'border border-gray-300 px-4 py-1';
      const deleteButton = document.createElement('button');
      deleteButton.textContent = 'Delete';
      deleteButton.className = 'bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded';
      deleteButton.onclick = function() {
          deleteRow(deleteButton);
      };
      deleteCell.appendChild(deleteButton);
      newRow.appendChild(deleteCell);

      // Add a Save button in the 8th cell
      const saveCell = document.createElement('td');
      saveCell.className = 'border border-gray-300 px-4 py-1';
      const saveButton = document.createElement('button');
      saveButton.textContent = 'Save';
      saveButton.className = 'bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded';
      saveButton.onclick = function() {
          saveRow(saveButton);
      };
      saveCell.appendChild(saveButton);
      newRow.appendChild(saveCell);

      // Append the new row to the table body
      tableBody.appendChild(newRow);
  }

  // Function to delete a row
  function deleteRow(button) {
      const row = button.closest('tr');
      row.remove();
  }

  // Function to save a row (for demonstration purposes, you can customize this function)
  function saveRow(button) {
      const row = button.closest('tr');
      const cells = row.querySelectorAll('td[contenteditable="true"]');
      cells.forEach(cell => {
          cell.setAttribute('contenteditable', 'false'); // Disable editing after saving
      });
      alert('Row saved!');
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
