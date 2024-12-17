<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

include '../settings/configuration.php';

//fetch hospitals by countries
$response = [];
if(isset($_GET['speciality']) && $_GET['speciality']) {
    $speciality=$_GET['speciality'];
    
    //filter by both speciality and country
    $sql = "
        SELECT h.name As hospitalName, s.name AS speciality, l.city,l.country, h.phoneNumber
        FROM hospitals h
        JOIN locations l ON h.locationID = l.locationID
        JOIN hospitalSpecialities hs ON h.hospitalID = hs.hospitalID
        JOIN specialities s ON hs.specialityID = s.specialityID
        WHERE s.name = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt-> bind_param("s", $_GET['speciality']);
    $stmt->execute();
    $result = $stmt->get_result();

    $response = "";
    //$hospitals =[];
    while($row=$result->fetch_assoc()) {
        $response .= "
            <div class='col-md-4'>
                <div class='card mb-4'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$row['hospitalName']}</h5>
                        <p class='card-text'>
                            <strong>Speciality:</strong> {$row['speciality']}<br>
                            <strong>City:</strong> {$row['city']}<br>
                            <strong>Country:</strong> {$row['country']}<br>
                            <strong>Phone:</strong> {$row['phoneNumber']}
                        </p>
                        <button class='btn btn-primary' onclick='openBookingModal(\"{$row['hospitalName']}\")'>Book Appointment</button>
                    </div>
                </div>
            </div>
        ";
    }
    
    // If no results are found
    if (empty($response)) {
        $response = "<p class='text-center'>No hospitals found for the selected speciality.</p>";
    }

    echo $response;  // Output the HTML content directly
    exit;
}

if (isset($_GET['country']) && $_GET['country']) {
    // Search by country
    $country = $_GET['country'];
    $sql = "
        SELECT h.name AS hospitalName, s.name AS speciality, l.city, l.country, h.phoneNumber
        FROM hospitals h
        JOIN locations l ON h.locationID = l.locationID
        JOIN hospitalSpecialities hs ON h.hospitalID = hs.hospitalID
        JOIN specialities s ON hs.specialityID = s.specialityID
        WHERE l.country = ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $country);
    $stmt->execute();
    $result = $stmt->get_result();

    // Start HTML output
    $response = "";
    while ($row = $result->fetch_assoc()) {
        $response .= "
            <div class='col-md-4'>
                <div class='card mb-4'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$row['hospitalName']}</h5>
                        <p class='card-text'>
                            <strong>Speciality:</strong> {$row['speciality']}<br>
                            <strong>City:</strong> {$row['city']}<br>
                            <strong>Country:</strong> {$row['country']}<br>
                            <strong>Phone:</strong> {$row['phoneNumber']}
                        </p>
                        <button class='btn btn-primary' onclick='openBookingModal(\"{$row['hospitalName']}\")'>Book Appointment</button>
                    </div>
                </div>
            </div>
        ";
    }

    // If no results are found
    if (empty($response)) {
        $response = "<p class='text-center'>No hospitals found for the selected country.</p>";
    }

    echo $response;  // Output the HTML content directly
    exit;
}
//fetch specialites for dropdown 
$specialities = $conn->query("SELECT * FROM specialities");
$countries = $conn->query("SELECT DISTINCT country FROM locations");


//fetch hospitals by countries for crd display
$hospitals=$conn->query("SELECT 
    h.name AS hospitalName,
    s.name AS speciality,
    l.city,
    l.country,
    h.phoneNumber
FROM 
    hospitals h
JOIN 
    hospitalspecialities hs ON h.hospitalID = hs.hospitalID
JOIN 
    specialities s ON hs.specialityID = s.specialityID
JOIN 
    locations l ON h.locationID = l.locationID
ORDER BY 
    h.name;
");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the hospitalName is included in the POST data
    if (isset($_POST['hospitalName']) && !empty($_POST['hospitalName'])) {
        $hospitalName = trim($_POST['hospitalName']); // Sanitize input
        //error_log("Received hospital name: $hospitalName"); // Debugging log

        // Validate the hospital name against the database
        $query = "SELECT * FROM hospitals WHERE name = ?";
        $stmt = $conn->prepare($query); 
        $stmt->bind_param("s", $hospitalName); // Bind the hospitalName to the query
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Hospital exists; proceed with booking logic
            $hospital = $result->fetch_assoc();
            //error_log("Hospital found: " . print_r($hospital, true)); // Debug

            // Extract the hospitalID
            $hospitalID = $hospital['hospitalID'];

            // Collect booking data from POST
            $patientName = $_POST['patientName'] ?? '';
            $patientContact = $_POST['patientContact'] ?? '';
            $appointmentDate = $_POST['appointmentDate'] ?? '';
            $appointmentTime = $_POST['appointmentTime'] ?? '';
            $reasonForVisit = $_POST['reasonForVisit'] ?? '';

            // Validate required fields
            if (empty($patientName) || empty($patientContact) || empty($appointmentDate) || empty($appointmentTime)) {
                echo "Please fill in all required fields.";
                exit;
            }

            // Insert booking into the database
            $insertQuery = "INSERT INTO bookings (hospitalID, patientName, patientContact, appointmentDate, appointmentTime, reasonForVisit) 
                            VALUES (?, ?, ?, ?, ?, ?)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->bind_param(
                "isssss",
                $hospitalID,
                $patientName,
                $patientContact,
                $appointmentDate,
                $appointmentTime,
                $reasonForVisit
            );

            if ($insertStmt->execute()) {
                //error_log("Booking successful for: $patientName");
                echo "Booking successful for hospital: " . htmlspecialchars($hospitalName);
                exit;
            } else {
                //error_log("Error inserting booking: " . $conn->error);
                echo "Error booking appointment. Please try again.";
                exit;
            }
        } else {
            // Hospital not found
            //error_log("No matching hospital found for: $hospitalName");
            echo "Invalid hospital";
            exit;
        }
    } else {
        // Missing or empty hospitalName field
        //error_log("No hospital name received or it is empty.");
        echo "Invalid hospital";
        exit;
    }
} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/c1df782baf.js"></script>
    <link rel="icon" type="image/x-icon" href="assets/images/favicon (3).ico">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-thin-rounded/css/uicons-thin-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <title>HospitalSearch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/hospital_search.css">
</head>

<body>

    <header>

        <div class="logo"><img src="../assets/images/tele.png" alt=""></div>

        <nav class="navbar">
            <a href="index.html">Home</a>
            <a href="#Home">About</a>
            <a href="../view/search.html">Search</a>
            <a href="../view/virtualpharmacy.php">Pharmacy</a>
            <a href="#Home">Contact</a>
        </nav>

        <div class="search-bar-box flex">
            <span class="search-icon flex">
                <i class="fa-solid fa-magnifying-glass fa-beat"></i>
            </span>
            <input type="search" class="search-control" placeholder="search here">
        </div>

    </header>


    <!--main content-->

<!--dropdown speciality search-->
    <div class="container mt-5">
        <h1 class="text-center">Hospital Search</h1>
        <form id="searchForm" class="d-flex justify-center mt-4">
            <select id="specialityDropdown" class="form-select w-auto me-2">
                <option value="">Select Speciality</option>
                <?php while ($row = $specialities->fetch_assoc()): ?>
                    <option value="<?= htmlspecialchars($row['name']) ?>"><?= htmlspecialchars($row['name']) ?></option>
                <?php endwhile; ?>
            </select>

            <button type="button" class="btn btn-outline-success" id="searchButton" onclick="searchHospitals()">Search</button>
        </form>

                <!--country search-->
        <form id="hospitalsearchForm" class="d-flex justify-center mt-4">
            <select id="hospitalDropdown" class="form-select w-auto me-2">
                <option value="">Select Country</option>
                <?php while ($row = $countries->fetch_assoc()): ?>
                    <option value="<?= htmlspecialchars($row['country']) ?>"><?= htmlspecialchars($row['country']) ?></option>
                <?php endwhile; ?>
            </select>

            <button type="button" class="btn btn-outline-success" id="hospitalsearchButton" onclick="searchHospitals()">Search</button>
        </form>

                <!--Hospital list-->
        <h2 class="text-center mt-5">Hospitals</h2>
        <div id="hospitalCards" class="row mt-4">
            <?php while ($row = $hospitals->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['hospitalName']) ?></h5>
                            <p class="card-text">
                                <strong>Speciality:</strong> <?= htmlspecialchars($row['speciality']) ?><br>
                                <strong>City:</strong> <?= htmlspecialchars($row['city']) ?><br>
                                <strong>Country:</strong> <?= htmlspecialchars($row['country']) ?><br>
                                <strong>Phone:</strong> <?= htmlspecialchars($row['phoneNumber']) ?><br>
                            </p>
                            <button class="btn btn-outline-success" onclick="openBookingModal('<?= htmlspecialchars($row['hospitalName']) ?>')">Book Appointment</button>

                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <!--booking modal-->
        <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="bookingForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bookingModalLabel">Book Appointment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" id="bookingHospitalName" name="hospitalName">
                            <div class="mb-3">
                                <label for="patientName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="patientName" name="patientName" required>
                            </div>

                            <div class="mb-3">
                                <label for="patientContact" class="form-label">Contact</label>
                                <input type="text" class="form-control" id="patientContact" name="patientContact" required>
                            </div>

                            <div class="mb-3">
                                <label for="appointmentDate" class="form-label">Appointment Date</label>
                                <input type="date" class="form-control" id="appointmentDate" name="appointmentDate" required>
                            </div>

                            <div class="mb-3">
                                <label for="appointmentTime" class="form-label">Appointment Time</label>
                                <input type="time" class="form-control" id="appointmentTime" name="appointmentTime" required>
                            </div>

                            <div class="mb-3">
                                <label for="reasonForVisit" class="form-label">Reason for Visit</label>
                                <textarea class="form-control" id="reasonForVisit" name="reasonForVisit" rows="3" required></textarea>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script  type="text/javascript" src="../assets/js/hospital_search.js"></script>




</body>

</html>