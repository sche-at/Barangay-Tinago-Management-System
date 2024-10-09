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
           
            <i class="fa-solid fa-house icon-color"  alt="Home" aria-hidden="true" > </i>
            <span class="hover:underline" >Home</span>
          </a>

          <div class="relative group space-y-2 block cursor-pointer">
            <a href="/residence" class="flex items-center space-x-2 hover:underline">
                <i class="fa-solid fa-user-group icon-color active" alt="Residence Management" aria-hidden="true"></i>
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
          <a href="/finance" class="flex items-center space-x-2">
            <i class="fa-solid fa-coins icon-color" alt="Financial Management" aria-hidden="true" tabindex="0"> </i> 
            <span class="hover:underline">Financial Management</span>
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
          <i class="fa-regular fa-calendar-days icon-color  " alt="Event Management" aria-hidden="true" ></i> 
          <span class="hover:underline">Event Management</span>
        </a>

        <div class="relative group space-y-2 block cursor-pointer">
          <a href="/immunization" class="flex items-center space-x-2">
            <i class="fa-solid fa-notes-medical icon-color" alt="Residence Management" aria-hidden="true"  ></i> 
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
                              <div class="w-4/5 ">
                                <h1 class="head text-3xl font-bold mb-6 ">Barangay Tinago</h1>
                                <img src=" {{URL ('storage/tinago.png')}}" alt="tinago" class="tinago" >
                              

                            <!-- Information-->
                     @csrf
                            <div class="p-6">
                                <div class="bg-green-200 p-6 rounded-lg shadow-lg">
                                    <h2 class="text-xl font-bold mb-4">Residence Information</h2>
                                    <form action="{{ route('residence.store') }}" method="POST" class="space-y-4">
                        
                                       @csrf
                                        <div class="flex space-x-4">
                                            <div class="flex-1">
                                                <label class="block mb-1" for="full_name">Full Name:</label>
                                                <input type="text" name="full_name" id="full_name" class="w-full p-2 border rounded">
                                            </div>
                                            <div class="w-1/4">
                                                <label class="block mb-1" for="sex">Sex:</label>
                                                <select name="sex" id="sex" class="w-full p-2 border rounded">
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="flex space-x-4">
                                            <div class="w-1/4">
                                                <label class="block mb-1" for="date_of_birth">Date of Birth:</label>
                                                <input type="date" name="date_of_birth" id="date_of_birth" class="w-full p-2 border rounded">
                                            </div>
                                            <div class="w-1/4">
                                                <label class="block mb-1" for="age">Age:</label>
                                                <input type="number" name="age" id="age" class="w-full p-2 border rounded">
                                            </div>
                                            <div class="w-1/4">
                                                <label class="block mb-1" for="civil_status">Civil Status:</label>
                                                <select name="civil_status" id="civil_status" class="w-full p-2 border rounded">
                                                    <option value="Single">Single</option>
                                                    <option value="Widow">Widow</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Separated">Separated</option>
                                                    <option value="Divorced">Divorced</option>
                                                </select>
                                            </div>
                                            <div class="w-1/4">
                                                <label class="block mb-1" for="purok">Purok:</label>
                                                <input type="number" name="purok" id="purok" class="w-full p-2 border rounded">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block mb-1" for="address">Address:</label>
                                            <input type="text" name="address" id="address" class="w-full p-2 border rounded">
                                        </div>
                                        <div class="flex space-x-4">
                                            <div class="w-1/2">
                                                <label class="block mb-1" for="educational_level">Educational Level:</label>
                                                <select name="educational_level" id="educational_level" class="w-full p-2 border rounded">
                                                    <option value="Elementary Level">Elementary Level</option>
                                                    <option value="Elementary Graduate">Elementary Graduate</option>
                                                    <option value="Highschool Level">Highschool Level</option>
                                                    <option value="Highschool Graduate">Highschool Graduate</option>
                                                    <option value="College Level">College Level</option>
                                                    <option value="College Graduate">College Graduate</option>
                                                </select>
                                            </div>
                                            <div class="w-1/2">
                                                <label class="block mb-1" for="occupation">Occupation:</label>
                                                <input type="text" name="occupation" id="occupation" class="w-full p-2 border rounded">
                                            </div>
                                        </div>
                                        <div class="flex space-x-4">
                                            <div class="w-1/2">
                                                <label class="block mb-1" for="employment_status">Employment Status:</label>
                                                <select name="employment_status" id="employment_status" class="w-full p-2 border rounded">
                                                    <option value="Unemployed">Unemployed</option>
                                                    <option value="Self Employed">Self Employed</option>
                                                    <option value="Full Time">Full Time</option>
                                                    <option value="Part Time">Part Time</option>
                                                </select>
                                            </div>
                                            <div class="w-1/2">
                                                <label class="block mb-1" for="contact_number">Contact Number:</label>
                                                <input type="text" name="contact_number" id="contact_number" class="w-full p-2 border rounded">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block mb-1" for="family_members">Family Members:</label>
                                            <div id="family-members-container" class="flex flex-col space-y-2">
                                                <div class="flex space-x-2 items-center">
                                                    <input type="text" id='family_members' name="family_members[]" class="w-full p-2 border rounded" placeholder="Enter family member name">
                                                    <button type="button" id="add-family-member" class="bg-blue-500 text-white p-2 rounded">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="bg-green-700 text-white p-2 rounded mt-4">Add Resident</button>
                                    </form>
                                </div>
                            </div>
</div>
</div>

 <script>
    document.addEventListener('DOMContentLoaded', function () {
      const addButton = document.getElementById('add-family-member');
      const container = document.getElementById('family-members-container');
      
  
      addButton.addEventListener('click', function () {
          const newField = document.createElement('div');
          newField.classList.add('flex', 'space-x-2', 'items-center');
  
          newField.innerHTML = `
              <input type="text" name="family_members[]" class="w-full p-2 border rounded" placeholder="Enter family member name">
              <button type="button" class="bg-red-500 text-white p-2 rounded remove-family-member">-</button>
          `;
  
          container.appendChild(newField);
  
          // Add event listener to the remove button
          newField.querySelector('.remove-family-member').addEventListener('click', function () {
              newField.remove();
          });
      });

    // Function to gather all input values
    function getFamilyMembers() {
        const inputs = document.querySelectorAll('input[name="family_members[]"]');
        const values = [];
        inputs.forEach(input => {
            values.push(input.value);
        });
        return values;
    }
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
</style>
