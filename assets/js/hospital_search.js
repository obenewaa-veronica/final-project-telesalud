function searchHospitals() {
    const speciality = document.getElementById("specialityDropdown").value.trim();
    const country = document.getElementById("hospitalDropdown").value.trim();

    // Check if either speciality or country is selected
    if (!speciality && !country) {
        alert("Please select either a speciality or a country.");
        return;
    }

    let url = "";

    // Determine which parameter to send in the request
    if (speciality) {
        url = `../action/hospital_search.php?speciality=${encodeURIComponent(speciality)}`;
    } else if (country) {
        url = `../action/hospital_search.php?country=${encodeURIComponent(country)}`;
    }

    async function getData() {
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error("Network response was not ok.");
            }

            const data = await response.text(); // Get the HTML response
            const hospitalCards = document.getElementById("hospitalCards");
            hospitalCards.innerHTML = data; // Insert the returned HTML

        } catch (error) {
            console.error("Error fetching hospitals:", error);
        }
    }

    getData();
}
// Open booking modal
function openBookingModal(hospitalName) {
    //console.log("opening modal for", hospitalName);
    const modal = new bootstrap.Modal(document.getElementById("bookingModal"));
    document.getElementById("bookingHospitalName").value = hospitalName;
    modal.show();
}

// Handle booking form submission
document.getElementById("bookingForm").addEventListener("submit", (event) => {
    event.preventDefault();
    const formData = new FormData(event.target);

    // for (let [key, value] of formData.entries()) {
    //     console.log(`${key}: ${value}`);
    // }

    //submit booking form
    fetch("../action/hospital_search.php", {
        method: "POST",
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error("Failed to book appointment.");
            }
            return response.text();
        })
        .then(message => {
            //console.log("server response: ", message);
            alert(message);
            const modalInstance = bootstrap.Modal.getInstance(document.getElementById("bookingModal"));
            if (modalInstance) {
                modalInstance.hide();
            }
            event.target.reset(); // Clear the form after submission
        })
        .catch(error => {
            console.error("Error booking appointment:", error);
            alert("An error occurred while booking the appointment. Please try again.");
        });

});