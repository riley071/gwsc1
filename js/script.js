let searchForm = document.querySelector('.header .search-form');

document.querySelector('#search-btn').onclick = () =>{
    searchForm.classList.toggle('active');
    navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    searchForm.classList.remove('active');
}

window.onscroll = () =>{
    searchForm.classList.remove('active');
    navbar.classList.remove('active');
}

let slides = document.querySelectorAll('.home .slide');
let index = 0;

function next(){
    slides[index].classList.remove('active');
    index = (index + 1) % slides.length;
    slides[index].classList.add('active');
}

function prev(){
    slides[index].classList.remove('active');
    index = (index - 1 + slides.length) % slides.length;
    slides[index].classList.add('active');
}

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("availability-form");
    const resultsList = document.getElementById("results-list");

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        // Get user input
        const pitchType = document.getElementById("pitch-type").value;
        const checkInDate = document.getElementById("check-in-date").value;
        const checkOutDate = document.getElementById("check-out-date").value;

        // Simulate fetching availability data (replace with actual API or database call)
        const availabilityData = getAvailabilityData(pitchType, checkInDate, checkOutDate);

        // Clear previous results
        resultsList.innerHTML = "";

        // Display availability results
        if (availabilityData.length === 0) {
            resultsList.innerHTML = "<li>No availability found for the selected dates.</li>";
        } else {
            availabilityData.forEach((availability) => {
                const listItem = document.createElement("li");
                listItem.textContent = `Date: ${availability.date}, Available: ${availability.available}`;
                resultsList.appendChild(listItem);
            });
        }
    });

    // Simulated availability data (replace with actual data retrieval logic)
    function getAvailabilityData(pitchType, checkInDate, checkOutDate) {
        // Simulated data for demonstration purposes
        const data = [
            { date: "2023-10-01", available: true },
            { date: "2023-10-02", available: false },
            { date: "2023-10-03", available: true },
            { date: "2023-10-04", available: true },
            { date: "2023-10-05", available: false },
        ];

        // Filter data based on pitch type and date range
        return data.filter((availability) => {
            return (
                availability.date >= checkInDate &&
                availability.date <= checkOutDate &&
                availability.available === (pitchType === "tent" ? true : false)
            );
        });
    }
});


// script.js

// Get the view count element
const viewCountElement = document.getElementById("view-count");

// Load the current view count from storage (you can replace this with your own logic)
let currentViewCount = parseInt(localStorage.getItem("viewCount")) || 0;

// Update the view count on the page
viewCountElement.textContent = currentViewCount;

// Increment the view count when the page loads
currentViewCount++;
viewCountElement.textContent = currentViewCount;

// Save the updated view count to storage
localStorage.setItem("viewCount", currentViewCount.toString());



   // Function to manually trigger reCAPTCHA verification
   function verifyRecaptcha() {
    grecaptcha.ready(function() {
        grecaptcha.execute('6LcHIEooAAAAAIq_0HJDDJDEUdFX5fty8EZsuMUo', { action: 'submit' }).then(function(token) {
            // Send the 'token' to your server for verification
            // You can make an AJAX request to your server with this token
            console.log('reCAPTCHA Token:', token);

            // Example: You can proceed with an action after successful verification
            // Replace this with your desired action
            alert('reCAPTCHA Verification Successful');
        });
    });
}

