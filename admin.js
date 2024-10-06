// Mock data for reservations
let reservations = [
  { name: 'John Doe', people: 4, time: '2024-10-01T19:30' },
  { name: 'Jane Smith', people: 2, time: '2024-10-02T18:00' }
];

// Display reservations
document.addEventListener('DOMContentLoaded', function () {
  const reservationList = document.getElementById('reservation-list');

  // Render each reservation
  reservations.forEach(reservation => {
    const reservationItem = document.createElement('div');
    reservationItem.innerHTML = `
      <p><strong>${reservation.name}</strong> - ${reservation.people} people at ${new Date(reservation.time).toLocaleString()}</p>
    `;
    reservationList.appendChild(reservationItem);
  });

  // Handle menu management
  const menuForm = document.getElementById('menu-form');
  const menuList = document.getElementById('menu-list');
  let menuItems = [];

  // Add new menu item
  menuForm.addEventListener('submit', function (event) {
    event.preventDefault();

    const dishName = document.getElementById('menu-name').value;
    const dishPrice = document.getElementById('menu-price').value;

    // Add dish to the menu list
    menuItems.push({ name: dishName, price: dishPrice });

    // Update menu display
    updateMenuList();

    // Clear the form
    menuForm.reset();
  });

  // Function to update menu list display
  function updateMenuList() {
    menuList.innerHTML = ''; // Clear the existing list

    menuItems.forEach(item => {
      const itemDiv = document.createElement('div');
      itemDiv.innerHTML = `<p><strong>${item.name}</strong> - ${item.price}</p>`;
      menuList.appendChild(itemDiv);
    });
  }
});