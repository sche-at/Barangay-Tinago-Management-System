<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link   href="/css/signin.css" rel="stylesheet">
    <title>Welcome to Barangay Tinago Management System</title>
</head>
<body>
    @auth
        
   
    @else
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
    
    <aside>
        <div class=" heading">
            <h1>Web-Based Barangay <br> Management System of Tinago</h1>
        </div>
       
        <div class="form-container">
        <div class="format">SIGN IN</div>
        <form action="/home" method="post" class="styled-form">
            @csrf
            <p class="in">SIGN IN</p>
            <input type="text" id="username" name="username" placeholder="username"><br><br>
            <input type="password" id="password" name="password" placeholder="password"><br><br>
            <input type="submit" value="Log In" id="sign">
            <p class="u">forgot password</p>
            <p class="or">or</p>
        </form>
        <form action="/signup">
            @csrf
            <button type="submit" style="text-align: center; margin-left: 60px; background-color: #0A5C36; padding: 10px; border-radius: 10px; position: absolute; top:75%; right:19%;">
              SIGN UP
            </button>
          </form>

        </div>
    </aside>
    <img src="https://i.ibb.co/bQh0Xk8/logo.png" alt="logo" class="web">
    @endauth
</body>
</html>
