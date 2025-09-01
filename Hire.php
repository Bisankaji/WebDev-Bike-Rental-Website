
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bike"; 

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";





if(isset($_POST["submit"])){
  $date = $_POST["date"];
  $dateof = $_POST["dateof"];
  $name = $_POST["name"];
  $number = $_POST["number"];
  $age = $_POST["age"];
  $address = $_POST["address"];
  $country = $_POST["country"];
  $info = $_POST["info"];

  $sql = "insert into `biketable`(`date`,`dateof`,`name`,`number`,`age`,`address`,`country`,`info`) values('$date','$dateof','$name','$number','$age','$address','$country','$info')";

  $result = mysqli_query($conn,$sql);

  if($result== true){
      echo"Data insertion succesfull";
  }

  else{
      echo"Failed to insert data";
  }
  $conn->close();
}


?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rental Inquiry Form with CAPTCHA</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-100 p-8">
    <div id="display"></div>

    <script>
      // Function to generate the CAPTCHA
      function generateCaptcha() {
        const num1 = Math.floor(Math.random() * 10) + 1;
        const num2 = Math.floor(Math.random() * 10) + 1;
        const question = `${num1} + ${num2}`;
        document.getElementById("captchaQuestion").textContent = question;
        return num1 + num2; // Return the correct answer
      }

      // Function to validate form inputs
      function validateForm() {
        const hireDate = document.getElementById("hireDate").value;
        const dropOffDate = document.getElementById("dropOffDate").value;
        const captchaInput = parseInt(
          document.getElementById("captchaInput").value,
          10
        );
        const captchaError = document.getElementById("captchaError");
        const today = new Date();
        const hireDateObj = new Date(hireDate);
        const dropOffDateObj = new Date(dropOffDate);

        // Validate that hire date is not in the past
        if (hireDateObj < today) {
          alert("Hire date cannot be in the past.");
          return false;
        }

        // Validate that drop off date is within 2 months of the hire date
        const twoMonthsLater = new Date(hireDateObj);
        twoMonthsLater.setMonth(twoMonthsLater.getMonth() + 2);
        if (dropOffDateObj > twoMonthsLater) {
          alert("Drop off date must be within 2 months of the hire date.");
          return false;
        }

        // Check if CAPTCHA is correct
        if (captchaInput !== window.captchaAnswer) {
          captchaError.classList.remove("hidden");
          window.captchaAnswer = generateCaptcha(); // Generate a new CAPTCHA
          return false;
        } else {
          captchaError.classList.add("hidden");
        }

        alert("Form submitted successfully!");
        return true;
      }

      // On page load
      window.onload = function () {
        const parseData = JSON.parse(localStorage.getItem("hireData") || "{}");

        // Build the form
        const formHtml = `
                <div class="container mx-auto bg-white shadow-lg rounded-lg p-8">
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Form Section -->
                        <div class="md:w-1/2 space-y-6">
                            <h2 class="text-xl font-semibold text-gray-700 mb-4">Please fill out the form in detail for the Rental Inquiry:</h2>
                            <h2 class="text-2xl font-bold text-blue-600">${
                              parseData.model
                                ? parseData.model.toUpperCase()
                                : ""
                            }</h2>
<form action="" method="POST">
                            <label class="font-semibold text-gray-600">Hire Date</label>
                            <input type="date" name="date" id="hireDate" class="border border-gray-300 rounded w-full p-2" required>

                            <label class="font-semibold text-gray-600">Drop Off</label>
                            <input type="date" name="dateof" id="dropOffDate" class="border border-gray-300 rounded w-full p-2" required>

                            <h1 class="text-xl font-semibold text-gray-700 mt-6">Personal Information</h1>

                            <label class="font-semibold text-gray-600">Name</label>
                            <input type="text" name="name" placeholder="Enter your name" class="border border-gray-300 rounded w-full p-2" required>

                            <label class="font-semibold text-gray-600">Phone Number</label>
                            <input type="text" name="number" placeholder="Enter your Number" class="border border-gray-300 rounded w-full p-2" required>

                            <label class="font-semibold text-gray-600">Age</label>
                            <input type="number" min="16" name="age" max="49" placeholder="Enter your Age" class="border border-gray-300 rounded w-full p-2" required>

                            <label class="font-semibold text-gray-600">Address</label>
                            <input type="text" placeholder="Enter your Address" name="address" class="border border-gray-300 rounded w-full p-2" required>

                            <label class="font-semibold text-gray-600">Country</label>
                            <select name="country" class="border border-gray-300 rounded w-full p-2" required>
                                <option>Country</option>
                                <option>Nepal</option>
                                <option>India</option>
                            </select>

                            <label class="font-semibold text-gray-600">Additional Notes</label>
                            <textarea name="info" placeholder="Enter any additional information" class="border border-gray-300 rounded w-full p-2 h-24"></textarea>
                            
                            <!-- CAPTCHA Section -->
                            <div class="mt-4">
                                <label class="font-semibold text-gray-600">CAPTCHA: What is <span id="captchaQuestion" class="font-bold"></span>?</label>
                                <input type="number" id="captchaInput" placeholder="Enter answer" class="border border-gray-300 rounded w-full p-2 mt-2" required>
                                <p id="captchaError" class="text-red-500 mt-2 hidden">Incorrect answer, please try again.</p>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" name="submit" onclick="if(validateForm()) { validateCaptcha(); }" class="w-full bg-blue-500 text-white py-2 mt-4 rounded hover:bg-blue-600">Submit</button>
                        </div>
</form>
                        <!-- Bike Image and Specifications -->
                        <div class="md:w-1/2 space-y-6">
                            <img src="${
                              parseData.modelLink || ""
                            }" alt="Bike" class="rounded-lg shadow-lg max-w-full h-auto">

                            <table class="w-full text-left border border-gray-200 rounded-lg overflow-hidden mt-6">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="p-3 text-gray-800 font-semibold border border-gray-200">Feature</th>
                                        <th class="p-3 text-gray-800 font-semibold border border-gray-200">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <tr>
                                        <td class="p-3 border border-gray-200">Name</td>
                                        <td class="p-3 border border-gray-200">${
                                          parseData.model || ""
                                        }</td>
                                    </tr>
                                    <tr>
                                        <td class="p-3 border border-gray-200">Engine Capacity</td>
                                        <td class="p-3 border border-gray-200">${
                                          parseData.engineCapacity || ""
                                        }</td>
                                    </tr>
                                    <tr>
                                        <td class="p-3 border border-gray-200">Price</td>
                                        <td class="p-3 border border-gray-200">${
                                          parseData.ratePerDay || ""
                                        }</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>`;

        // Insert the form into the display div
        document.getElementById("display").innerHTML = formHtml;

        // Generate the CAPTCHA after the form is rendered
        window.captchaAnswer = generateCaptcha();
      };
    </script>

    <script src="https://www.google.com/recaptcha/api.js"></script>
  </body>
</html>
