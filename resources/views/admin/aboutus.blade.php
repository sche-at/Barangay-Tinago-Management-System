@include('templates.header')

<style>
    body {
        font-family: 'Arial', sans-serif;
    }

    .container-fluid {
        margin-top: 30px;
        text-align: center;
    }

    h1 {
        font-size: 2.5rem;
        color: #2c3e50;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    p {
        font-size: 1.3rem;
        color: #34495e;
        margin-bottom: 20px;
        font-weight: 500;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    p strong {
        color: #16a085;
    }

    .info {
        margin-top: 20px;
    }

    .container-fluid p i {
        margin-right: 10px;
        color: #3498db;
        font-size: 1.7rem;
    }

    /* Image styling */
    .aboutus-image img {
        width: 80%;
        margin-bottom: 30px;
    }

    /* Hover effect for text */
    p:hover {
        color: #16a085;
        transition: color 0.3s ease;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        h1 {
            font-size: 2rem;
        }

        p {
            font-size: 1.1rem;
        }

        .aboutus-image img {
            width: 90%;
        }
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <!-- Image Section Above Info -->
            <div class="aboutus-image">
                <img src="{{ asset('assets/img/Org.png') }}" alt="Barangay Org">
            </div>
            
            <!-- About Us Info Section -->
            <h1>Barangay Tinago Dauis</h1>
            <div class="info">
                <p><i class="fas fa-facebook-square"></i><strong>&nbsp;Facebook Page: </strong> Lgu Tinago Dauis - FB PAGE</p>
                <p><i class="fas fa-envelope"></i><strong>&nbsp;Email:</strong> TINAGODAUIS123@gmail.com</p>
                <p><i class="fas fa-phone"></i><strong>&nbsp;Landline:</strong> 0384122127</p>
            </div>
        </div>
    </main>

@include('templates.footer')
