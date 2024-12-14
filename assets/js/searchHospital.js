// Handle form submission
document.getElementById("searchForm").addEventListener("submit", (event) => {
    event.preventDefault();
  
    const searchInput = document.getElementById("searchInput").value.trim();
  
    if (!searchInput) {
      alert("Please enter a hospital name.");
      return;
    }
  
    // Construct the Google Maps search URL
    const searchQuery = encodeURIComponent(searchInput);
    const googleMapsUrl = `https://www.google.com/maps/search/?api=1&query=${searchQuery}`;
  
    // Redirect the user to Google Maps
    window.location.href = googleMapsUrl;
  });
  