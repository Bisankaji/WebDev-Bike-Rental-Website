let allData;
let dropdownitem;



// Populate the dropdown with bike data
const dropDownBike = async () => {
  try {
    const response = await fetch("bikes.json");
    const data = await response.json();
    dropdownitem = data;

    // Populate the dropdown but keep it hidden initially
    let content = '';
    data.forEach((element) => {
      content += `
        <h3 class="dropdown-item font-semibold">
          ${element.model}
        </h3>
      `;
    });

    // Insert content into dropdown menu
    const dropdown = document.getElementById('getdrop');
    dropdown.innerHTML = content;
    dropdown.style.display = "none"; // Ensure it starts hidden
  } catch (error) {
    console.log(error);
  }
};

// Load bikes for display
const getBikeData = async () => {
  const display = document.getElementById('display');

  try {
    const response = await fetch("bikes.json");
    const data = await response.json();
    allData = data;

    let content = '';
    data.forEach((element, index) => {
      content += `
        <div class="group block bg-white rounded-lg shadow-md overflow-hidden transform transition duration-200 hover:scale-105">
          <img src="${element.modelLink}" alt="${element.model}" class="h-60 w-full object-cover group-hover:opacity-90" />
          <div class="flex justify-between items-center p-4">
            <div class="text-sm">
              <h3 class="text-gray-900 font-semibold group-hover:text-blue-500">
                ${element.model}
              </h3>
              <p class="text-gray-600 mt-1">${element.engineCapacity}</p>
            </div>
            <button onclick="invdata(${index})" 
                    id="btn-${index}" 
                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded shadow-md transition duration-200 ease-in-out transform hover:scale-105">
              Rent
            </button>
          </div>
        </div>
      `;
    });

    display.innerHTML = content;
  } catch (error) {
    console.log(error);
    display.innerHTML = "Error loading bike data.";
  }
};

// Handle button clicks for renting bikes
function invdata(index) {
  console.log(allData[index]);
  localStorage.setItem('bikedetail', JSON.stringify(allData[index]));
  window.open("bikedetail.php");
}

// Initialize dropdown and bikes display
dropDownBike();
getBikeData();

// Toggle dropdown menu visibility
const dropdownToggle = document.getElementById("navbarDropdown");
const dropdownMenu = document.getElementById("getdrop");

dropdownToggle.addEventListener("click", (event) => {
  event.preventDefault(); // Prevent default link behavior

  // Toggle the display property of the dropdown menu
  if (dropdownMenu.style.display === "none" || dropdownMenu.style.display === "") {
    dropdownMenu.style.display = "flex";
  } else {
    dropdownMenu.style.display = "none";
  }
});

// Close dropdown when clicking outside
document.addEventListener("click", (event) => {
  if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
    dropdownMenu.style.display = "none";
  }
});


