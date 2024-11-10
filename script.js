function toggleMenu() {
  const menu = document.querySelector(".menu-links");
  const icon = document.querySelector(".hamburger-icon");
  menu.classList.toggle("open");
  icon.classList.toggle("open");
}

const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnPopup = document.querySelector('.login-button');
const iconClose = document.querySelector('.icon-close');

registerLink.addEventListener('click', ()=> {
    wrapper.classList.add('active');
})

loginLink.addEventListener('click', ()=> {
    wrapper.classList.remove('active');
})

btnPopup.addEventListener('click', ()=> {
    wrapper.classList.add('active-popup');
})

iconClose.addEventListener('click', ()=> {
    wrapper.classList.remove('active-popup');
})

// Simulate a login status; in a real application, this would be set based on actual login logic
let isLoggedIn = false; // Change this to true to simulate a logged-in user

function updateButton() {
    const loginButton = document.getElementById('loginButton');
    if (isLoggedIn) {
        loginButton.textContent = 'Profile';
        loginButton.onclick = function() {
            // Redirect to the profile page or show profile info
            window.location.href = '/dashboard/movers-dashboard.html'; // Example redirect
        };
    } else {
        loginButton.textContent = 'Login';
        loginButton.onclick = function() {
            // Trigger login logic here
            alert('Login functionality here');
        };
    }
}

// Call the function to update the button on page load
updateButton();