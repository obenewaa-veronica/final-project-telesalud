const googleApiKey = "AIzaSyDnjnaOZERUtgJbF4SzoibGN3VyZPoCwps";

// Display general-purpose places on page load
document.addEventListener("DOMContentLoaded", () => {
  fetchGeneralPlaces();
});

// Handle form submission
document.getElementById("searchForm").addEventListener("submit", async (event) => {
  event.preventDefault();

  const searchInput = document.getElementById("searchInput").value.trim();
  const searchType = document.getElementById("searchType").value;

  if (!searchInput) {
    alert("Please enter a search query.");
    return;
  }

  let query;
  if (searchType === "speciality") {
    query = `${searchInput} hospital`;
  } else if (searchType === "country") {
    query = `hospitals in ${searchInput}`;
  } else {
    query = "hospitals";
  }

  const url = `https://maps.googleapis.com/maps/api/place/textsearch/json?query=${encodeURIComponent(query)}&key=${googleApiKey}`;

  try {
    const response = await fetch(url,{
        mode: 'cors',
        headers: {'Access-Control-Allow-Origin':'*'}
  });

    if (!response.ok) {
      throw new Error(`HTTP error ${response.status}`);
    }

    const data = await response.json();

    if (!data.results || data.results.length === 0) {
      alert("No places found.");
      return;
    }

    displayResults(data.results, "results");
  } catch (error) {
    console.error("Error fetching data:", error);
    alert(`An error occurred: ${error.message}`);
  }
});

// Fetch general-purpose places
async function fetchGeneralPlaces() {
  const url = `https://maps.googleapis.com/maps/api/place/textsearch/json?query=general%20hospitals&key=${googleApiKey}`;

  try {
    const response = await fetch(url);

    if (!response.ok) {
      throw new Error(`HTTP error ${response.status}`);
    }

    const data = await response.json();

    if (!data.results || data.results.length === 0) {
      console.log("No general places found.");
      return;
    }

    displayResults(data.results, "generalPlaces");
  } catch (error) {
    console.error("Error fetching general places:", error);
    alert(`An error occurred: ${error.message}`);
  }
}

// Display results in cards
function displayResults(results, containerId) {
  const resultsContainer = document.getElementById(containerId);
  resultsContainer.innerHTML = ""; // Clear previous results

  results.forEach((place) => {
    const name = place.name || "Unnamed Place";
    const address = place.formatted_address || "Address not available";
    const placeId = place.place_id;
    const detailsUrl = `https://www.google.com/maps/place/?q=place_id:${placeId}`;

    const cardHTML = `
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">${name}</h5>
            <p class="card-text">${address}</p>
            <a href="${detailsUrl}" target="_blank" class="btn btn-primary">View on Google Maps</a>
          </div>
        </div>
      </div>
    `;

    resultsContainer.insertAdjacentHTML("beforeend", cardHTML);
  });
}

