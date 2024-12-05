async function fetchRoutes() {
    try {
        const response = await fetch('fetch_tb_routes.php');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const result = await response.json();
       
        if (result.success) {
            const tableBody = document.querySelector('#routes-table tbody');
            tableBody.innerHTML = ''; // Clear existing rows
            result.data.forEach(route => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${route.rid}</td>
                    <td>${route.name}</td>
                    <td>${route.departure}</td>
                    <td>${route.destination}</td>
                    <td>${route.dtime}</td>
                    <td>${route.atime}</td>
                    <td>${route.price}</td>
                    <td>
                        <button class="edit-btn" data-id="${route.rid}"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="delete-btn" data-id="${route.rid}"><i class="fa-solid fa-trash"></i></button>
                    </td>
                `;
                tableBody.appendChild(row);
            });

            document.querySelector('#routes-table').addEventListener('click', event => {
                // Identify if the clicked element or its parent is the 'edit-btn'
                const button = event.target.closest('.edit-btn');
                if (button) {
                    const id = button.getAttribute('data-id');
                    if (id) {
                        editRoute(id);
                    } else {
                        console.error('Error: Edit button clicked, but no data-id attribute found.');
                    }
                }
            });

            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', event => {
                    const id = event.target.getAttribute('data-id');
                    deleteRoute(id);
                });
            });
        } else {
            alert(`Error fetching routes: ${result.message}`);
        }
    } catch (error) {
        console.error('Error fetching routes:', error);
    }
}
async function fetchTickets() {
    try {
        const response = await fetch('fetch_tickets.php');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const result = await response.json();
       
        if (result.success) {
            const tableBody = document.querySelector('#tickets-table tbody');
            tableBody.innerHTML = ''; 
            result.data.forEach(ticket => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${ticket.tid}</td>
                    <td>${ticket.route}</td>
                    <td>${ticket.name}</td>
                    <td>${ticket.date}</td>
                    
                `;
                tableBody.appendChild(row);
            });

            // document.querySelector('#routes-table').addEventListener('click', event => {
            //     // Identify if the clicked element or its parent is the 'edit-btn'
            //     const button = event.target.closest('.edit-btn');
            //     if (button) {
            //         const id = button.getAttribute('data-id');
            //         if (id) {
            //             editRoute(id);
            //         } else {
            //             console.error('Error: Edit button clicked, but no data-id attribute found.');
            //         }
            //     }
            // });

            // document.querySelectorAll('.delete-btn').forEach(button => {
            //     button.addEventListener('click', event => {
            //         const id = event.target.getAttribute('data-id');
            //         deleteRoute(id);
            //     });
            // });
        } else {
            alert(`Error fetching tickets: ${result.message}`);
        }
    } catch (error) {
        console.error('Error fetching tickets:', error);
    }
}

async function fetchPayments() {
    try {
        const response = await fetch('fetch_payments.php');
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const result = await response.json();
       
        if (result.success) {
            const tableBody = document.querySelector('#payments-table tbody');
            tableBody.innerHTML = ''; 
            result.data.forEach(payment => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${payment.payid}</td>
                    <td>${payment.route}</td>
                    <td>${payment.name}</td>
                    <td>${payment.amount}</td>
                    <td>${payment.method}</td>
                    <td>${payment.time}</td>
                `;
                tableBody.appendChild(row);
            });

        } else {
            alert(`Error fetching payments: ${result.message}`);
        }
    } catch (error) {
        console.error('Error fetching payments:', error);
    }
}


fetchRoutes();
fetchTickets();
fetchPayments();

function openModal() {
    document.getElementById('addRouteModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('addRouteModal').style.display = 'none';
}

document.getElementById('addRouteForm').addEventListener('submit', async function (e) {
    e.preventDefault();
    const formData = new FormData(this);

    try {
        const response = await fetch('add_route.php', {
            method: 'POST',
            body: formData,
        });

        const text = await response.text();
        console.log('Raw server response:', text);

        try {
            const result = JSON.parse(text);
            if (result.success) {
                alert(result.message);
                closeModal();
                
            } else {
                alert(`Error: ${result.message}`);
                console.error('Debug info:', result.debug);
            }
        } catch (parseError) {
            alert('Failed to parse server response as JSON.');
            console.error('Parse error:', parseError, 'Response text:', text);
        }
    } catch (error) {
        alert('An error occurred while adding the route.');
        console.error('Network error:', error);
    }
});






// Editing 
function openEditModal(route) {
    document.getElementById('edit-id').value = route.rid;
    document.getElementById('edit-name').value = route.name;
    document.getElementById('edit-departure').value = route.departure;
    document.getElementById('edit-destination').value = route.destination;
    document.getElementById('edit-dtime').value = route.dtime;
    document.getElementById('edit-atime').value = route.atime;
    document.getElementById('edit-price').value = route.price;

    document.getElementById('editRouteModal').style.display = 'flex';
}

function closeEditModal() {
    document.getElementById('editRouteModal').style.display = 'none';
}

document.getElementById('editRouteForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    try {
        const response = await fetch('update_route.php', {
            method: 'POST',
            body: formData,
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const result = await response.json();
        if (result.success) {
            alert('route updated successfully');
            closeEditModal();
            fetchRoutes();
        } else {
            alert(`Error: ${result.message}`);
        }
    } catch (error) {
        console.error('Error updating route:', error);
        alert('An error occurred. Please check the console for details.');
    }
});

// Edit button click handler
async function editRoute(id) {
    try {
        const response = await fetch(`fetch_single_route.php?id=${id}`);
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const result = await response.json();
        if (result.success) {
            openEditModal(result.data);
        } else {
            alert(`Error fetching route details: ${result.message}`);
        }
    } catch (error) {
        console.error('Error fetching route details:', error);
    }
}

// Delete Route
async function deleteRoute(id) {
    if (!confirm('Are you sure you want to delete this route?')) return;

    try {
        const response = await fetch('delete_route.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `rid=${id}`,
        });
        const result = await response.json();
        if (result.success) {
            alert('Route deleted successfully');
            fetchRoutes();
        } else {
            alert(`Error deleting route: ${result.message}`);
        }
    } catch (error) {
        console.error('Error deleting route:', error);
    }
}
