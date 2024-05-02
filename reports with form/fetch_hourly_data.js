document.getElementById("hourlyForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    const formData = new FormData(this);
    const stationName = formData.get("stationName");
    const date = formData.get("date");
    const startHour = formData.get("startHour");
    const endHour = formData.get("endHour");

    fetch(`hourly_data.php?stationName=${stationName}&date=${date}&startHour=${startHour}&endHour=${endHour}`)
        .then(response => response.json())
        .then(data => {
            // Chart.js code to create the chart using fetched data
            // ...
        })
        .catch(error => console.error('Error fetching data:', error));
});
