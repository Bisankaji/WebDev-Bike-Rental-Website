<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>
</head>
<body>
    <nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
          <a href="index.php" class="flex items-center rtl:space-x-reverse">
            <img src="./gallery/logo1.png" width="60px"  alt="Flowbite Logo" />
              <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">HamroRental</span>
          </a>
          <button data-collapse-toggle="navbar-multi-level" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-multi-level" aria-expanded="false">
              <span class="sr-only">Open main menu</span>
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
              </svg>
          </button>
          <div class="hidden w-full md:block md:w-auto" id="navbar-multi-level">
            <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
              <li>
                <a href="index.php" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Home</a>
              </li>
              
              <li>
                <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Services</a>
              </li>
              <li>
                <a href="gallery.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Gallery</a>
              </li>
              <li>
                <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Contact</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      
    <h1 class="text-4xl font-bold text-gray-800 text-center py-6">
        Explore Highlights from Our Recent Motorbike Adventure in Nepal
    </h1>
    <form action="" id="uploadPhoto">
   <input type="file" name="photo" id="photo" allow="image/*">
   <button type="submit">Upload</button>
    </form>
<section class="py-6 dark:bg-gray-100 dark:text-gray-900">
    <div class="container grid grid-cols-2 gap-4 p-4 mx-auto md:grid-cols-4">
        <!-- Highlighted larger images -->
        
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

        $sql = "SELECT * FROM photos;";
        $result = mysqli_query($conn,$sql);
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<img src='$row[path]' alt=' class='w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-rectangle'>";
      }
        ?>
        <!-- <img src="./gallery/image_5.png" alt="" class="w-full h-full col-span-2 row-span-2 rounded shadow-sm min-h-96 md:col-start-3 md:row-start-1 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_40.jpg" alt="" class="w-full h-full col-span-2 row-span-2 rounded shadow-sm min-h-96 md:col-start-1 md:row-start-3 dark:bg-gray-500 aspect-square"> -->
        <!-- Standard images from image_6.png to image_39.png -->
        <!-- <img src="./gallery/abhi.jpg" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-rectangle">
        <img src="./gallery/image_6.png" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_7.png" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_8.png" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_9.png" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_10.png" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_11.png" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_12.png" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_13.png" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_14.png" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_15.png" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_16.png" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_17.png" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_18.png" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_19.png" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_20.png" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_21.png" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_22.png" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_23.jpg" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_24.jpg" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_25.jpg" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_26.jpg" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_27.jpeg" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_28.jpeg" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_29.jpg" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_30.jpg" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_31.jpg" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_32.jpg" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_33.jpg" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_34.jpg" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_35.jpg" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_36.jpg" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_37.jpg" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square">
        <img src="./gallery/image_41.jpg" alt="" class="w-full h-full rounded shadow-sm min-h-48 dark:bg-gray-500 aspect-square"> -->
       
    </div>
</section>

<script src="https://cdn.tailwindcss.com"></script>
<script src="uploadPhoto.js"></script>

</body>
</html>
