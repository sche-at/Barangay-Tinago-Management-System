<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/signup.css">
    <title>Document</title>
</head>
<body>
    <div class="image-container">
        <img src="https://i.ibb.co/NnT6JS7/tinago.png" alt="tinago" id="logo">
        <img src="https://i.ibb.co/ZSfQphQ/dauis.png" alt="dauis" id="logo1">
    </div>
   
    <article>
        <h1 class="vission">Vision</h1>
        <p class="text">Bohol is a prime eco-cultural tourism destination agro- <br>industrial province, with a well-educated, God-loving and <br>law-abiding citizenry, proud of their cultural heritage, <br> enjoying a state of well-being and committed to sound <br> environment management.</p>
        <h1 class="mission">Mission</h1>
        <p class="text">To enrich Bohol’s social, economic, cultural, political <br> and environmental resources through good governance <br> and effective partnerships with stakeholders for increased <br>global competitiveness.</p>
        <h1 class="goals">Goals</h1>
        <ul class="text">
            <li>Environmental Protection and Management</li>
            <li>Social Equity</li>
            <li>Delivering quality services</li>
            <li>Local/Regional Economic Development and Strategic Wealth Generations</li>
            <li>Responsive, Transparent and Accountable Governance</li>
        </ul>
    </article>
    
    <form action="/signin" method="post" class="styled-form">
        @csrf
        <h1 class="in">SIGN IN</h1>
            <input type="text" id="username" name="Full_Name" placeholder="Full Name"><br><br>
            <input type="text" id="password" name="Phone_Number" placeholder="Phone Number"><br><br>
            <input type="text" id="password" name="Email" placeholder="Email"><br><br>
            <input type="text" id="password" name="Username" placeholder="Username"><br><br>
            <input type="password" id="password" name="Password" placeholder="Password"><br><br>

            <input type="submit" value="Create Account" id="sign">
        </form>




</body>
</html>