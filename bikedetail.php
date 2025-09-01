<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="bikedetail.css" />
  </head>
  <body>
    <script>
      window.onload = function () {
        let getDataFromLocalStorage = localStorage.getItem("bikedetail");
        let parseData = JSON.parse(getDataFromLocalStorage);
        console.log(getDataFromLocalStorage);
        let show = document.getElementById("show");
        let content = `<div>
                <div class="container">
                    <div class="col1">
                        <img src="${parseData.modelLink}" alt="Bike">
                    </div>
                    <div class="col2">
                        <h2>${parseData.model.toUpperCase()}</h2>
                        <h1>${parseData.ratePerDay}</h1>
                        <h3>${parseData.model.toUpperCase()} RENT IN NEPAL</h3>
                        <p>${parseData.desc}</p>
                        <p>${parseData.model} Specifications:</p>
                        <table>
                            <tr><th>Engine Capacity</th><td>${
                              parseData.engineCapacity
                            }</td></tr>
                            <tr><th>Mileage</th><td>${
                              parseData.mileage
                            }</td></tr>
                            <tr><th>Fuel Tank Capacity</th><td>${
                              parseData.fuleTank
                            }</td></tr>
                            <tr><th>Top Speed</th><td>${
                              parseData.topspeed
                            }</td></tr>
                            <tr><th>Weight</th><td>${parseData.weight}</td></tr>
                            <tr><th>Engine Start</th><td>${
                              parseData.engineStart
                            }</td></tr>
                        </table>
                        <button  class="btn">Hire Now</button>
                    </div>
                </div>
            </div>`;
        show.innerHTML = content;
        document.querySelectorAll(".btn").forEach((button) => {
          button.addEventListener("click", function () {
            localStorage.setItem("hireData", JSON.stringify(parseData));
            window.location.href = "Hire.php";
          });
        });
      };

      let getData = async () => {
        try {
          let response = await fetch("bikes.json");
          let data = await response.json();
          console.log(data);

          // Shuffle array and get 4 random items
          let randomBikes = data.sort(() => 0.5 - Math.random()).slice(0, 4);
          console.log(randomBikes);

          let content = "";
          let suggestionDiv = document.getElementById("suggestion");

          randomBikes.forEach((element) => {
            content += `
                        <div class="suggestion-card">
                            <img src="${element.modelLink}" alt="${element.model}" height="100px" class="suggestion-image">
                            <p><strong>${element.model}</strong></p>
                            <p>Rate per day: ${element.ratePerDay}</p>
                        </div>
                    `;
          });

          suggestionDiv.innerHTML = content;
        } catch (error) {
          console.log(error);
        }
      };
      getData();
    </script>
    <div class="main-container">
      <p id="show"></p>
    </div>
    <div class="middle-container flex gap-[420px] mt-9 items-center">
      <h1 class="font-bold text-2xl">YOU MAY ALSO LIKE</h1>
      <a href = "index.php"><button class="border p-3 bg-red-500 text-white">GO TO SHOP</button></a>
    </div>
    <div class="sugg">
      <div id="suggestion"></div>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
  </body>
</html>
