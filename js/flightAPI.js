function searchFlights(userId) {
    console.log("User ID:", userId);
    const departure = document.getElementById("departure").value;
    const destination = document.getElementById("destination").value;
    const departure_date = document.getElementById("departure_date").value;
    const spinner = document.getElementById("spinner");
    const resultsBody = document.getElementById("resultsBody");

    // Show spinner while loading
    spinner.style.display = "flex";

    fetch("https://run.mocky.io/v3/3d7a33f9-7307-4f3c-81b5-177600fcc046")
        .then(response => response.json())
        .then(data => {
            console.log("API Response:", data); // Debugging

            if (!data.flights) {
                console.error("No 'flights' key found in response");
                return;
            }

            const allFlights = data.flights;
            let filteredFlights = [];

            allFlights.forEach(day => {
                if (day.date === departure_date) {
                    day.routes.forEach(flight => {
                        if (flight.departure === departure && flight.destination === destination) {
                            filteredFlights.push(flight);
                        }
                    });
                }
            });

            // Hide spinner after data is loaded
            spinner.style.display = "none";

            // Clear previous results
            resultsBody.innerHTML = "";

            if (filteredFlights.length === 0) {
                console.warn("No matching flights found");
                resultsBody.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center text-danger">No flights found</td>
                    </tr>
                `;
            } else {
                
                document.getElementById('results-container').style.display = 'block';
                filteredFlights.forEach((flight, index) => {
                    let row = `
                        <tr><td>${departure_date}</td>
                            <td>${flight.airline}</td>
                            <td>${flight.time}</td>
                            <td>${flight.departure}</td>
                            <td>${flight.destination}</td>
                            <td id="price-${index}">$${flight.price}</td>
                            <td>
                                <input type="number" id="quantity-${index}" min="1" value="1" class="form-control"
                                    oninput="updateTotal(${index}, ${flight.price})">
                            </td>
                            <td id="total-${index}">$${flight.price}</td>
                        </tr>
                    `;
                    resultsBody.innerHTML += row;
                });

            }
        })
        .catch(error => {
            console.error("Error fetching flight data:", error);
            spinner.style.display = "none";
            resultsBody.innerHTML = `
                <tr>
                    <td colspan="7" class="text-center text-danger">Error fetching flight data</td>
                </tr>
            `;
        });
}

// Function to update total price dynamically
function updateTotal(index, price) {
    let quantity = document.getElementById(`quantity-${index}`).value;
    let totalPrice = price * quantity;
    document.getElementById(`total-${index}`).innerText = `$${totalPrice}`;
}



