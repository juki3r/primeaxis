<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PONG-MTA Technology Solutions</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <meta name="description" content="PONG-MTA is an Internet Service Provider and IT solutions company offering ISP services, CCTV installation, web & mobile development, automation, and system integration.">
    <meta name="keywords" content="ISP Philippines, CCTV Installer, System Integrator, Laravel Developer, Network Solutions, PONG-MTA">
    <meta name="author" content="PONG-MTA Technology Solutions">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-section {
            background: linear-gradient(to right, #1e3a8a, #4f46e5);
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .hero-section h1 { text-shadow: 1px 1px 4px rgba(0,0,0,0.3); padding-top: 80px; }
        .service-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.15); transition: all 0.3s ease; }
        .technology-logo { max-height: 50px; opacity: 0.8; transition: opacity 0.3s ease; }
        .technology-logo:hover { opacity: 1; }
        .why-us-card { border-left: 5px solid #4f46e5; transition: transform 0.3s ease; }
        .why-us-card:hover { transform: translateY(-5px); }
        .footer a { color: #0d6efd; text-decoration: none; }
        .footer a:hover { text-decoration: underline; }


   

    /* Transparent navbar */
    .navbar {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 10;
      background: rgba(0, 0, 0, 0.4);
      backdrop-filter: blur(6px);
    }

    .navbar-brand,
    .nav-link {
      color: #fff !important;
    }

    .navbar-brand:hover,
    .nav-link:hover {
      color: #e50914 !important;
    }

    /* Hamburger custom */
    .navbar-toggler {
      border: none;
      outline: none !important;
      box-shadow: none !important;
      position: relative;
      width: 30px;
      height: 22px;
      transition: transform 0.3s ease;
    }

    .navbar-toggler-icon {
      display: none;
    }

    .navbar-toggler::before,
    .navbar-toggler::after,
    .navbar-toggler span {
      position: absolute;
      left: 0;
      width: 100%;
      height: 3px;
      background: #fff;
      border-radius: 2px;
      transition: all 0.3s ease;
      content: "";
    }

    .navbar-toggler span {
      top: 9px;
    }

    .navbar-toggler::before {
      top: 0;
    }

    .navbar-toggler::after {
      bottom: 0;
    }

    .navbar-toggler:not(.collapsed)::before {
      transform: rotate(45deg);
      top: 9px;
      background: #e50914;
    }

    .navbar-toggler:not(.collapsed)::after {
      transform: rotate(-45deg);
      bottom: 9px;
      background: #e50914;
    }

    .navbar-toggler:not(.collapsed) span {
      opacity: 0;
    }
    .navbar-brand img {
        width: 80px;
        height: 80px;
        transition: all 0.3s ease;
    }

    /* Chat Button */
    #chatbot-btn {
    position: fixed;
    bottom: 25px;
    right: 25px;
    width: 60px;
    height: 60px;
    background: #4f46e5;
    border-radius: 50%;
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 28px;
    cursor: pointer;
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    z-index: 9999;
    transition: transform 0.3s ease, background 0.3s ease;
    }
    #chatbot-btn:hover {
    transform: scale(1.1);
    background: #3730a3;
    }

    /* Chat Window */
    #chatbot-window {
    position: fixed;
    bottom: 90px;
    right: 25px;
    width: 320px;
    max-height: 400px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    display: none;
    flex-direction: column;
    overflow: hidden;
    font-family: 'Inter', sans-serif;
    z-index: 9998;
    }

    /* Header */
    #chatbot-header {
    background: purple;
    color: #fff;
    padding: 12px 15px;
    font-weight: bold;
    cursor: default;
    display: flex;
    justify-content: space-between;
    align-items: center;
    }
    #chatbot-close {
    cursor: pointer;
    font-size: 20px;
    }

    /* Body */
    #chatbot-body {
    flex: 1;
    padding: 10px;
    overflow-y: auto;
    font-size: 14px;
    background: #ffffff;
    }

    /* Input */
    #chatbot-input {
    border: none;
    border-top: 1px solid #ccc;
    padding: 12px 10px;
    font-size: 14px;
    outline: none;
    }

    /* Messages */
    .message {
    margin-bottom: 10px;
    padding: 8px 10px;
    border-radius: 12px;
    word-wrap: break-word;
    }

    .user-message {
        background: white;
        color: black;
        text-align: right;
        align-self: flex-end;
    }

    .bot-message {
    background: #f1f1f1;
    color: #333;
    text-align: left;
    align-self: flex-start;
    }

    #chatbot-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.8); /* dim background */
        display: none; /* hidden by default */
        z-index: 9997; /* behind chatbot but above page */
    }

    .hero-typing {
        min-height: 28px;
        }

        #type-text {
        font-weight: 600;
        background: linear-gradient(90deg, #ffffff, #facc15, #ffffff);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradientMove 3s linear infinite;
        position: relative;
        }

        /* Cursor */
        #type-text::after {
        content: "▍";
        margin-left: 4px;
        animation: cursorBlink 1s infinite;
        color: #fff;
        }

        @keyframes cursorBlink {
        0%, 50%, 100% { opacity: 1; }
        25%, 75% { opacity: 0; }
        }

        @keyframes gradientMove {
        to {
            background-position: 200% center;
        }
        }



        .explore-btn {
            position: relative;
            overflow: hidden;
            padding: 0.9rem 1.6rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            }

            /* Icon animation */
            .explore-btn i {
            transition: transform 0.3s ease;
            }

            /* Hover effect */
            .explore-btn:hover i {
            transform: translateX(6px) rotate(5deg);
            }

            /* Glow sweep effect */
            .explore-btn::after {
            content: "";
            position: absolute;
            top: 0;
            left: -120%;
            width: 120%;
            height: 100%;
            background: linear-gradient(
                120deg,
                transparent,
                rgba(255,255,255,0.4),
                transparent
            );
            transition: all 0.6s ease;
            }

            .explore-btn:hover::after {
            left: 120%;
            }




    /* Mobile responsiveness */
    @media (max-width: 576px){
    #chatbot-window { width: 90%; right: 5%; bottom: 80px; }
    #chatbot-btn { bottom: 20px; right: 20px; width: 55px; height: 55px; font-size: 24px; }
    }

    /* === MOBILE FIXES === */
    @media (max-width: 768px) {
      .navbar {
        padding-left: 1rem !important;
        padding-right: 1rem !important;
      }

      .navbar-brand img {
            width: 40px;
            height: 40px;
        }
      
    }


        
</style>
</head>
<body class="bg-light text-dark">
 <nav class="navbar navbar-expand-lg px-4">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="#home">
        <img
          src="{{ asset('images/logo.png') }}"
          alt="Logo"
          width="60"
          height="60"
          class="me-2 rounded-circle bg-light"
        />
        PONG-MTA
      </a>
      <button
        class="navbar-toggler collapsed"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
      >
        <span></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link fw-medium" href="#home">Home</a></li>
            <li class="nav-item"><a class="nav-link fw-medium" href="#services">Services</a></li>
            <li class="nav-item"><a class="nav-link fw-medium" href="#why-us">Why Us</a></li>
            <li class="nav-item"><a href="#" class="nav-link fw-medium" data-bs-toggle="modal" data-bs-target="#appointmentModal">
                Book Appointment
            </a></li>
            

        </ul>
      </div>
    </div>
  </nav>

<!-- HERO -->
<section class="hero-section text-center text-md-start" id="home">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-7">
                <h1 class="display-4 fw-bold mb-0">PONG-MTA</h1>
                <h4 class="mt-0 mb-5 text-warning">
                    Technology Solutions
                </h4>
                <p class="lead mb-4 fs-5">Internet • CCTV • Web & Mobile Development • Smart IoT & Automation • System Integration</p>
                 <p class="lead  fs-6 hero-typing">
                        <span id="type-text"></span>
                    </p>
                <a href="#services" class="btn btn-primary btn-lg shadow-sm mb-4 mt-4 explore-btn">
                    <i class="bi bi-cpu-fill me-2"></i>
                    Explore Our Services
                </a>
                <a href="#" class="btn btn-warning btn-lg ms-2 mb-4 mt-4" data-bs-toggle="modal" data-bs-target="#appointmentModal">
                    <i class="bi bi-calendar-check me-2"></i>
                    Book Appointment
                </a>


            </div>
            <div class="col-md-5 text-center">
                <img src="{{ asset('images/feature.png') }}" class="img-fluid rounded shadow" alt="Tech Illustration">
            </div>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section class="py-5">
    <div class="container text-center">
        <h2 class="h2 fw-bold mb-4">About PONG-MTA</h2>
        <p class="text-secondary fs-6">
            <strong>PONG-MTA</strong> is a professional technology solutions provider delivering
            reliable and scalable IT services. We specialize in Internet service deployment,
            CCTV and security systems, custom software development, automation, and full system
            integration.
        </p>
    </div>
</section>

<!-- SERVICES -->
<section id="services" class="py-5 bg-light">
    <div class="container">
        <h2 class="h2 fw-bold text-center mb-5">Our Services</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm service-card text-center p-3">
                    <i class="bi bi-wifi display-4 text-primary mb-3"></i>
                    <h3 class="h5 fw-semibold mb-2">Internet Service Provider</h3>
                    <p class="text-secondary">Residential & business internet, fiber & wireless networks.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm service-card text-center p-3">
                    <i class="bi bi-camera-video display-4 text-primary mb-3"></i>
                    <h3 class="h5 fw-semibold mb-2">CCTV & Security Systems</h3>
                    <p class="text-secondary">IP cameras, monitoring, access control systems.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm service-card text-center p-3">
                    <i class="bi bi-code-slash display-4 text-primary mb-3"></i>
                    <h3 class="h5 fw-semibold mb-2">Web Development</h3>
                    <p class="text-secondary">Laravel systems, dashboards, APIs.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm service-card text-center p-3">
                    <i class="bi bi-phone display-4 text-primary mb-3"></i>
                    <h3 class="h5 fw-semibold mb-2">Mobile App Development</h3>
                    <p class="text-secondary">Android & offline-first applications.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm service-card text-center p-3">
                    <i class="bi bi-lightning display-4 text-primary mb-3"></i>
                    <h3 class="h5 fw-semibold mb-2">Automation & IoT</h3>
                    <p class="text-secondary">ESP32, Arduino, RFID & smart systems.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm service-card text-center p-3">
                    <i class="bi bi-chat-dots display-4 text-primary mb-3"></i>
                    <h3 class="h5 fw-semibold mb-2">SMS Blasting</h3>
                    <p class="text-secondary">
                        Bulk SMS solutions for promotions, alerts, OTPs, and customer notifications.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm service-card text-center p-3">
                    <i class="bi bi-diagram-2 display-4 text-primary mb-3"></i>
                    <h3 class="h5 fw-semibold mb-2">Network Design & Optimization</h3>
                    <p class="text-secondary">
                        Scalable network planning, bandwidth management, and performance optimization.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm service-card text-center p-3">
                    <i class="bi bi-telephone display-4 text-primary mb-3"></i>
                    <h3 class="h5 fw-semibold mb-2">VoIP & IP Telephony</h3>
                    <p class="text-secondary">
                        SIP servers, IP phones, GSM gateways, call routing, and PBX solutions.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm service-card text-center p-3">
                    <i class="bi bi-hdd-network display-4 text-primary mb-3"></i>
                    <h3 class="h5 fw-semibold mb-2">Server Hosting & Deployment</h3>
                    <p class="text-secondary">
                        On-premise & cloud servers, Linux administration, backups, and monitoring.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm service-card text-center p-3">
                    <i class="bi bi-activity display-4 text-primary mb-3"></i>
                    <h3 class="h5 fw-semibold mb-2">Network Monitoring (NOC)</h3>
                    <p class="text-secondary">
                        Real-time monitoring, alerts, uptime tracking, and performance analytics.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm service-card text-center p-3">
                    <i class="bi bi-briefcase display-4 text-primary mb-3"></i>
                    <h3 class="h5 fw-semibold mb-2">IT Consulting</h3>
                    <p class="text-secondary">
                        Technology planning, system audits, and digital transformation strategies.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm service-card text-center p-3">
                    <i class="bi bi-diagram-3 display-4 text-primary mb-3"></i>
                    <h3 class="h5 fw-semibold mb-2">System Integration</h3>
                    <p class="text-secondary">Network, server, VoIP & cloud integration.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- WHY US -->
<section id="why-us" class="py-5 bg-light">
    <div class="container">
        <h2 class="h2 fw-bold text-center mb-5">Why Choose PONG-MTA?</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-5">
                <div class="p-4 bg-white shadow-sm why-us-card h-100">
                    <h5 class="fw-bold">Multi-discipline IT expertise</h5>
                    <p class="text-secondary mb-0">Expertise across networking, security, development, and automation.</p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="p-4 bg-white shadow-sm why-us-card h-100">
                    <h5 class="fw-bold">ISP & system integrator experience</h5>
                    <p class="text-secondary mb-0">Proven experience providing internet and system solutions to businesses and residences.</p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="p-4 bg-white shadow-sm why-us-card h-100">
                    <h5 class="fw-bold">Custom-built, secure solutions</h5>
                    <p class="text-secondary mb-0">Tailored software and network solutions designed for your business security.</p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="p-4 bg-white shadow-sm why-us-card h-100">
                    <h5 class="fw-bold">Scalable & future-ready systems</h5>
                    <p class="text-secondary mb-0">Solutions designed to grow with your business.</p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="p-4 bg-white shadow-sm why-us-card h-100">
                    <h5 class="fw-bold">Innovation-Driven Solutions</h5>
                    <p class="text-secondary mb-0">We design forward-thinking systems using automation, modern frameworks,
                        and emerging technologies to keep your system ahead.</p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="p-4 bg-white shadow-sm why-us-card h-100">
                    <h5 class="fw-bold">Professional local support</h5>
                    <p class="text-secondary mb-0">Reliable support and maintenance when you need it most.</p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- FOOTER / CONTACT -->
<footer id="contact" class="bg-dark text-white py-5">
    <div class="container text-center footer">
        <h2 class="h2 fw-bold mb-3">Let’s Work Together</h2>
        <p class="mb-3 fs-6">Internet services, CCTV systems, software development, automation, and full IT integration.</p>
        <p class="fw-semibold">© {{ date('Y') }} PONG-MTA Technology Solutions</p>
        <div class="mt-3">
            <a href="#home">Home</a> | 
            <a href="#services">Services</a> | 
            <a href="#why-us">Why Us</a>
        </div>
    </div>
</footer>

<!-- MODERN CHATBOT -->
<!-- Chat Button -->
<div id="chatbot-btn">
  <i class="bi bi-chat-dots-fill"></i>
</div>

<!-- Overlay -->
<div id="chatbot-overlay"></div>

<!-- Chat Window -->
<div id="chatbot-window">
  <div id="chatbot-header">Chat with us! <span id="chatbot-close">&times;</span></div>
  <div id="chatbot-body"></div>
  <div id="chatbot-options" class="p-2 d-flex flex-column gap-2">
    <button class="chat-option btn btn-sm btn-primary">Services</button>
    <button class="chat-option btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#appointmentModal">
        Book Appointment
    </button>

  </div>

  <div id="chatbot-form" class="p-3 border" style="display:none;">
        <h4 class="fw-bold">Enter your details</h4>
        <input type="text" id="user-fullname" class="form-control mb-2" placeholder="Full Name" required>
        <input type="email" id="user-email" class="form-control mb-2" placeholder="Email or Phone number" required>
        <button id="chatbot-submit" class="btn btn-success btn-sm w-100">Submit</button>
    </div>

</div>


<!-- APPOINTMENT MODAL -->
<div class="modal fade" id="appointmentModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-calendar-check me-2"></i> Book an Appointment
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form id="appointmentForm">
            @csrf

            <input type="text" class="form-control mb-2" name="full_name" placeholder="Full Name" required>
            <textarea class="form-control mb-2" name="address" placeholder="Address" required></textarea>
            <input type="text" class="form-control mb-3" name="contact" placeholder="Email or Phone" required>

            <button type="submit" class="btn btn-success w-100" id="appointmentSubmit">
                <span class="btn-text">Submit Appointment</span>
                <span class="spinner-border spinner-border-sm ms-2 d-none" role="status"></span>
            </button>

        </form>

      </div>
    </div>
  </div>
</div>





<script>
   document.addEventListener('DOMContentLoaded', () => {
        const chatbotBtn = document.getElementById('chatbot-btn');
        const chatbotWindow = document.getElementById('chatbot-window');
        const chatbotClose = document.getElementById('chatbot-close');
        const chatbotBody = document.getElementById('chatbot-body');
        const optionButtons = document.querySelectorAll('.chat-option');
        const chatbotOverlay = document.getElementById('chatbot-overlay'); // new

        const responses = {
            "services": "We offer Internet, CCTV, Web & Mobile Development, Automation, and System Integration.",
            "Book Appointment": "We will contact you soon if you submit info."
        };

        // Open chatbot with auto greeting and overlay
        chatbotBtn.addEventListener('click', () => {
            chatbotWindow.style.display = 'flex';
            chatbotBtn.style.display = 'none';
            chatbotOverlay.style.display = 'block'; // show overlay
            setTimeout(() => addMessage("Hello! Welcome to PONG-MTA. How can we assist you today?", 'bot-message'), 300);
        });

        // Close chatbot and overlay
        function closeChatbot() {
            chatbotWindow.style.display = 'none';
            chatbotBtn.style.display = 'flex';
            chatbotOverlay.style.display = 'none'; // hide overlay
            chatbotBody.innerHTML = ""; // clear chat
        }

        chatbotClose.addEventListener('click', closeChatbot);

        // Optional: click on overlay closes chatbot
        chatbotOverlay.addEventListener('click', closeChatbot);

        optionButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                const userMsg = btn.innerText;
                addMessage(userMsg, 'user-message');

                const key = userMsg.toLowerCase();
                const reply = responses[key] || "Sorry, I didn't understand that.";
                setTimeout(() => addMessage(reply, 'bot-message'), 500);

                // Show form if user clicks "Contact"
                if(key === 'contact'){
                    document.getElementById('chatbot-form').style.display = 'block';
                }
            });
        });

        document.getElementById('chatbot-submit').addEventListener('click', () => {
            const name = document.getElementById('user-fullname').value.trim();
            const email = document.getElementById('user-email').value.trim();
            if(!name || !email){
                alert("Please fill in all fields!");
                return;
            }

            addMessage(`Name: ${name}\nEmail/Phone: ${email}`, 'user-message');
            addMessage("Thank you! We will contact you soon.", 'bot-message');

            // Optional: hide form after submission
            document.getElementById('chatbot-form').style.display = 'none';

            // Clear inputs
            document.getElementById('user-fullname').value = '';
            document.getElementById('user-email').value = '';
        });



        function addMessage(text, className) {
            const div = document.createElement('div');
            div.className = 'message ' + className;
            div.innerText = text;
            chatbotBody.appendChild(div);
            chatbotBody.scrollTop = chatbotBody.scrollHeight;
        }

        chatbotBody.innerHTML = "";
    });

    document.addEventListener('DOMContentLoaded', () => {
        const navbarCollapse = document.getElementById('navbarNav');
        const navLinks = navbarCollapse.querySelectorAll('.nav-link');

        navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (navbarCollapse.classList.contains('show')) {
            const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse) || new bootstrap.Collapse(navbarCollapse);
            bsCollapse.hide();
            }
        });
        });
    });



    const texts = [
        "Internet Infrastructure",
        "CCTV & Security Automation",
        "Web & Mobile Development",
        "Smart IoT & Automation",
        "Enterprise System Integration"
        ];

        let index = 0;
        let charIndex = 0;
        let isDeleting = false;
        const typeElement = document.getElementById("type-text");

        function typeEffect() {
        const currentText = texts[index];

        if (!isDeleting && charIndex < currentText.length) {
            typeElement.textContent = currentText.substring(0, charIndex + 1);
            charIndex++;
            setTimeout(typeEffect, 60);
        } 
        else if (isDeleting && charIndex > 0) {
            typeElement.textContent = currentText.substring(0, charIndex - 1);
            charIndex--;
            setTimeout(typeEffect, 35);
        } 
        else {
            isDeleting = !isDeleting;
            if (!isDeleting) {
            index = (index + 1) % texts.length;
            }
            setTimeout(typeEffect, 1200);
        }
        }

        document.addEventListener("DOMContentLoaded", typeEffect);

        //Appointment Form
        document.getElementById('appointmentForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = this;
            const submitBtn = document.getElementById('appointmentSubmit');
            const spinner = submitBtn.querySelector('.spinner-border');
            const btnText = submitBtn.querySelector('.btn-text');

            // 🔒 Prevent double submit
            submitBtn.disabled = true;
            spinner.classList.remove('d-none');
            btnText.textContent = 'Submitting...';

            const formData = new FormData(form);

            fetch('/appointments', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    form.reset();
                    resetAppointmentButton();

                    const modal = bootstrap.Modal.getInstance(
                        document.getElementById('appointmentModal')
                    );
                    modal.hide();
                } else {
                    throw new Error('Submission failed');
                }
            })
            .catch(() => {
                alert('Something went wrong. Please try again.');

                // 🔓 Re-enable on error
                submitBtn.disabled = false;
                spinner.classList.add('d-none');
                btnText.textContent = 'Submit Appointment';
            });
        });

        function resetAppointmentButton() {
            const submitBtn = document.getElementById('appointmentSubmit');
            const spinner = submitBtn.querySelector('.spinner-border');
            const btnText = submitBtn.querySelector('.btn-text');

            submitBtn.disabled = false;
            spinner.classList.add('d-none');
            btnText.textContent = 'Submit Appointment';
        }

        //Hide chatbot
        document.querySelectorAll('[data-bs-target="#appointmentModal"]').forEach(btn => {
            btn.addEventListener('click', () => {
                const chatbotWindow = document.getElementById('chatbot-window');
                const chatbotBtn = document.getElementById('chatbot-btn');
                const chatbotOverlay = document.getElementById('chatbot-overlay');

                // Hide chatbot window and overlay
                chatbotWindow.style.display = 'none';
                chatbotBtn.style.display = 'flex';
                chatbotOverlay.style.display = 'none';
            });
        });

</script>
</body>
</html>
