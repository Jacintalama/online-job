<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           WELCOME! 
        </h2>
    </x-slot><br>
<style>
        .container {
    display: flex;
    justify-content: space-between; /* This will push content to the edges */
    align-items: start; /* To align items at the top */
}

.time-container {
    margin-left: auto; /* This will push the time-container to the right */
}

        /* For the professional font */
.professional-font {
    font-family: 'Roboto', sans-serif;
}

/* For the massive font */
.massive-font {
    font-family: 'Playfair Display', serif;
    font-size: 3rem; /* Adjust the size as needed */
    font-weight: 700; /* Making it bold */
    text-transform: uppercase; /* Making letters uppercase */
    letter-spacing: 2px; /* Spacing out the letters slightly */
    text-align: center; /* Centering the text */
}

</style>




<div class="container">
    <div class="time-container">
        Philippine Standard Time:<br> 
        <span id="current-date"></span>, 
        <span id="current-time"></span>
    </div>
</div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 massive-font">
                    HUMAN RESOURCE MANAGEMENT AND DEVELOPMENT OFFICE
                </div>
            </div>
        </div>
    </div>
    
<script>
    document.addEventListener("DOMContentLoaded", function() {
    function updateDateTime() {
        // Get the current date and time in Philippine Standard Time (PST is UTC+8)
        let currentDateTime = new Date(new Date().toLocaleString("en-US", {timeZone: "Asia/Manila"}));

        // Format the date
        let currentDate = currentDateTime.toLocaleDateString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        // Format the time
        let currentTime = currentDateTime.toLocaleTimeString();

        // Update the HTML elements
        document.getElementById("current-date").textContent = currentDate;
        document.getElementById("current-time").textContent = currentTime;
    }

    // Call the function immediately to display the current time right away
    updateDateTime();

    // Update the time every second
    setInterval(updateDateTime, 1000);
});

</script>    
</x-app-layout>
