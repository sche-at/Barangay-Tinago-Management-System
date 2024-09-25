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
  <div class="bg w-1/5 sm:pb-48 sm:p-40 sm:pl-16 text-3xl font-bold space-y-20">
                                                        
<div class="flex items-center space-x-2 text-black -mt-10 ">
<img src="https://placehold.co/50x50" alt="Profile" class="rounded-full">
<span>Profile</span>
</div>
                                                  
<nav class="space-y-24 text-white"> <!-- Adjust the space-y value as needed -->
<a href="/base" class="flex items-center space-x-2">
<i class="fa-solid fa-house icon-color active" alt="Home" aria-hidden="true" tabindex="0"></i>
<span class="hover:underline">Home</span>
</a>
                                                  
<div class="relative group space-y-2 block cursor-pointer">
<a href="/eventannounce" class="flex items-center space-x-2 hover:underline">
<i class="fa-solid fa-user-group icon-color" alt="Residence Management" aria-hidden="true" tabindex="0"></i>
<span>Announcements</span>
</a>
                                                  
<div class="announce submenu ml-6 space-y-1 hidden group-hover:block absolute right-0 top-full bg-white shadow-lg border">
<a href="/eventannounce" class="flex items-center space-x-2 cursor-pointer hover:underline">
<span class="inline-block w-2 h-2 rounded-full bg-black"></span>
<span>Event Announcements</span>
</a>
<a href="/healthannounce" class="flex items-center space-x-2 cursor-pointer hover:underline">
<span class="inline-block w-2 h-2 rounded-full bg-black"></span>
<span>Health Announcements</span>
</a>
</div>
</div>
                                                  
<a href="/history" class="flex items-center space-x-2">
<i class="fa-solid fa-coins icon-color" alt="Financial Management" aria-hidden="true" tabindex="0"></i>
<span class="hover:underline">History</span>
</a>
                                                  
<a href="/complaints" class="flex items-center space-x-2">
<i class="fa-regular fa-calendar-days icon-color" alt="Event Management" aria-hidden="true" tabindex="0"></i>
<span class="hover:underline">Complaints</span>
</a>
                                                      </nav>
                                                    
                                                  
     
        <form action="/signin" method="post">  <div class="flex justify-center top">
          <button type="submit" class="btn text-white  absolute bottom-0">Log Out</button>
        </div>
      </form>
      
        
      </div>

                              <!-- Heading-->
  <div class="w-4/5">
    <h1 class="head text-3xl font-bold ">Barangay Tinago</h1>
    <img src=" {{URL ('storage/tinago.png')}}" alt="tinago" class="tinago" >
  </div>
    </div>
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
          right: -100%;           /* Aligns the submenu to the right edge of the parent */
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
        .announce{
    position: absolute; /* Allows precise positioning relative to the nearest relative parent */
          right: -150%;           /* Aligns the submenu to the right edge of the parent */
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
      