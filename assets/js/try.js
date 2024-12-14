export async function getData() {
    const url=`hospital_search.php?speciality=${encodeURIComponent(speciality)}`;
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error("Network response was not ok.");
        }

        const json=await response.json();
        console.log(json);
    } catch (error) {
        console.error(error.message);
    }

    
}

getData();