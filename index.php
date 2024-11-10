<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Movers</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="mediaqueries.css" />
  </head>
  <body>
    <nav id="desktop-nav">
      <div class="logo">Movers</div>
      <div>
        <ul class="nav-links">
          <li><a href="#profile">HOME</a></li>
          <li><a href="#about">ABOUT</a></li>
          <li><a href="#services">SERVICES</a></li>
          <li><a href="#contact">CONTACT</a></li>
        </ul>
      </div>

      <div>
      <?php
        
        session_start();

        // Check if the login was successful and show the alert
        if (isset($_SESSION['login_success']) && $_SESSION['login_success'] == true) {
          echo "<script>alert('Successfully logged in!');</script>";
          unset($_SESSION['login_success']); // Unset the session variable after showing the alert
        }

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        $button_text = "Profile"; 
        $target_page = "/dashboard/movers-dashboard.php"; // Change to your profile page
        } 
        else {
        $button_text = "Login";
        $target_page = "/sign-up-page/login-page.php"; // Change to your login page
        }

      ?>
        <button class="login-button" id="loginButton" onclick="window.location.href='<?php echo $target_page; ?>'">
        <?php echo $button_text; ?>
        </button>
      </div>
    </nav>
    <nav id="hamburger-nav">
      <div class="logo">Movers</div>

      <div class="hamburger-menu">
        <div class="hamburger-icon" onclick="toggleMenu()">
          <span></span>
          <span></span>
          <span></span>
        </div>
        <div class="menu-links">
          <li><a href="#profile" onclick="toggleMenu()">HOME</a></li>
          <li><a href="#about" onclick="toggleMenu()">ABOUT</a></li>
          <li><a href="#services" onclick="toggleMenu()">SERVICES</a></li>
          <li><a href="#contact" onclick="toggleMenu()">CONTACT</a></li>
          <li>
            <div>
            </div>
          </li>
        </div>
      </div>
    </nav>

    <section>
      <div class="centre">
        <img class="pic-1" src="./p&m/picture-1.jpg" alt="main pic" />
      </div>
    </section>

    <section id="profile">
      <div class="section__pic-container">
        <img src="./p&m/picture-2.jpg" alt="Movers profile picture" />
      </div>
      <div class="section__text">
        <p class="section__text__p1">Hello, We're</p>
        <h1 class="title">MOVERS</h1>
        <p class="section__text__p2">Professional Carriers</p>
        <div class="btn-container">
          <a href="/sign-up-page/privacy-policy.html">
            <button class="btn btn-color-2">Privacy Policy</button>
          </a>

          <button class="btn btn-color-1" onclick="location.href='./#contact'">
            Contact Info
          </button>
        </div>
      </div>
    </section>

    <section id="about">
      <p class="section__text__p1">Get To Know More</p>
      <h1 class="title">About Us</h1>
      <div class="section-container">
        <div class="section__pic-container">
          <img
            src="./p&m/picture-3.jpg"
            alt="Profile picture"
            class="about-pic"
          />
        </div>
        <div class="about-details-container">
          <div class="about-containers">
            <div class="details-container">
              <img
                src="./assets/experience.png"
                alt="Experience icon"
                class="icon"
              />
              <h3>Experience</h3>
              <p>3+ years of<br />Carrier Experience</p>
            </div>
            <div class="details-container">
              <img
                src="./assets/education.png"
                alt="Community icon"
                class="icon"
              />
              <h3>Community</h3>
              <p>20+ Organisation<br />4000+ Happy Customer</p>
            </div>
          </div>
          <div class="text-container">
            <p>
              Discover the top-tier packing and moving solutions with our
              dedicated team. We offer comprehensive services, from careful
              packing and secure loading to efficient transportation and
              unpacking. Our experienced professionals ensure a hassle-free
              move, treating your belongings with the utmost care. Whether local
              or long-distance, trust us to handle every detail with precision.
              Get in touch for a smooth, stress-free relocation!
            </p>
          </div>
        </div>
      </div>
      <img
        src="./assets/arrow.png"
        alt="Arrow icon"
        class="icon arrow"
        onclick="location.href='./#services'"
      />
    </section>

    <section id="services">
      <p class="section__text__p1">Explore Our</p>
      <h1 class="title">Services</h1>
      <div class="service-details-container">
        <div class="about-containers">
          <div class="details-container">
            <h2 class="service-sub-title">Residential Moving</h2>
            <div class="article-container">
              <article>
                <img
                  src="./assets/checkmark.png"
                  alt="service icon"
                  class="icon"
                />
                <div>
                  <h3>Local</h3>
                  <p>
                    Moves within the city or nearby areas for local relocations.
                  </p>
                </div>
              </article>
              <article>
                <img
                  src="./assets/checkmark.png"
                  alt="service icon"
                  class="icon"
                />
                <div>
                  <h3>Specialty</h3>
                  <p>
                    Handling specialty items like pianos, artwork, and other
                    valuables.
                  </p>
                </div>
              </article>
              <article>
                <img
                  src="./assets/checkmark.png"
                  alt="service icon"
                  class="icon"
                />
                <div>
                  <h3>Packing and Unpacking</h3>
                  <p>Professional packing of household items.</p>
                </div>
              </article>
              <article>
                <img
                  src="./assets/checkmark.png"
                  alt="service icon"
                  class="icon"
                />
                <div>
                  <h3>Long-Distance</h3>
                  <p>
                    Relocations across longer distances, including interstate.
                  </p>
                </div>
              </article>
            </div>
          </div>

          <div class="details-container">
            <h2 class="service-sub-title">Commercial Moving</h2>
            <div class="article-container">
              <article>
                <img
                  src="./assets/checkmark.png"
                  alt="service icon"
                  class="icon"
                />
                <div>
                  <h3>Office Relocation</h3>
                  <p>Moving office furniture, equipment, supplies etc.</p>
                </div>
              </article>
              <article>
                <img
                  src="./assets/checkmark.png"
                  alt="service icon"
                  class="icon"
                />
                <div>
                  <h3>Equipment Moving</h3>
                  <p>
                    Handling and transporting heavy or specialized equipment.
                  </p>
                </div>
              </article>
              <article>
                <img
                  src="./assets/checkmark.png"
                  alt="service icon"
                  class="icon"
                />
                <div>
                  <h3>Furniture Disassembly and Reassembly</h3>
                  <p>Taking apart and reassembling office furniture.</p>
                </div>
              </article>
              <article>
                <img
                  src="./assets/checkmark.png"
                  alt="service icon"
                  class="icon"
                />
                <div>
                  <h3>IT and Technology Moving</h3>
                  <p>
                    Relocating computer systems, servers, and other IT
                    infrastructure.
                  </p>
                </div>
              </article>
            </div>
          </div>
        </div>
      </div>
      <img
        src="./assets/arrow.png"
        alt="Arrow icon"
        class="icon arrow"
        onclick="location.href='./#testimonials'"
      />
    </section>

    <section id="price">
      <div class="section__pic-container">
        <img src="./p&m/why.jpg" alt="Movers profile picture" />
      </div>
      <div class="section__text">
        <p class="section__text__p1">Why choose</p>
        <h1 class="title">MOVERS ?</h1>
        <p class="text-container">
          We offer transparent pricing with no hidden fees, allowing for
          effective budgeting. Our customer-centric approach guarantees open
          communication and support throughout the process. Whether moving
          locally or long-distance, we provide comprehensive services that let
          you focus on settling into your new home.
        </p>

        <a href="/dashboard/movers-pricing.php" class="explore-prices-button"
          >Explore Prices >></a
        >
      </div>
    </section>

    <section id="testimonials">
      <p class="section__text__p1">Read the People's</p>
      <h1 class="title">Testimonials</h1>
      <div class="experience-details-container">
        <div class="about-containers">
          <div class="details-container color-container">
            <div class="article-container">
              <img
                src="./p&m/testimonial1.jpg"
                alt="testimonial 1"
                class="testimonial-img"
              />
            </div>

            <div class="testimonial-para">
              <p>
                “As a couple, we were thrilled with the service! The team was
                punctual, professional, and careful. Our move was smooth and
                stress-free. Highly recommended!” -
                <span class="span-name">Joe & Anna</span>
              </p>
            </div>
          </div>
          <div class="details-container color-container">
            <div class="article-container">
              <img
                src="./p&m/testimonial2.png"
                alt="testimonial 2"
                class="testimonial-img"
              />
            </div>

            <div class="testimonial-para">
              <p>
                "Great experience! The movers were on time, and careful with my
                belongings. They made the entire process smooth and stress-free.
                Highly recommended!" - <span class="span-name">Rohan</span>
              </p>
            </div>
          </div>
          <div class="details-container color-container">
            <div class="article-container">
              <img
                src="./p&m/testimonial3.jpg"
                alt="testimonial 3"
                class="testimonial-img"
              />
            </div>

            <div class="testimonial-para">
              <p>
                "Exceptional service! The team was punctual, professional, and
                handled my belongings with care. They made my move easy and
                stress-free. Highly recommend!" -
                <span class="span-name">Lisa</span>
              </p>
            </div>
          </div>
        </div>
      </div>
      <img
        src="./assets/arrow.png"
        alt="Arrow icon"
        class="icon arrow"
        onclick="location.href='./#contact'"
      />
    </section>

    <section id="contact">
      <p class="section__text__p1">Get in Touch</p>
      <h1 class="title">Contact Us</h1>
      <div class="contact-info-upper-container">
        <div class="contact-info-container">
          <img
            src="./assets/email.png"
            alt="Email icon"
            class="icon contact-icon email-icon"
          />
          <p><a href="mailto:Contact@movers.com">Contact@movers.com</a></p>
        </div>
        <div class="contact-info-container">
          <img
            src="./assets/linkedin.png"
            alt="LinkedIn icon"
            class="icon contact-icon"
          />
          <p><a href="https://www.linkedin.com/login?">LinkedIn</a></p>
        </div>
      </div>
    </section>

    <footer>
      <nav>
        <div class="nav-links-container">
          <ul class="nav-links">
            <li><a href="#home">HOME</a></li>
            <li><a href="#about">ABOUT</a></li>
            <li><a href="#services">SERVICES</a></li>
            <li><a href="#contact">CONTACT</a></li>
          </ul>
        </div>
      </nav>
      <p>Copyright &#169; 2024 Movers. All Rights Reserved.</p>
    </footer>
    <script src="script.js"></script>
    <!-- <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script> -->
  </body>
</html>
