const axios = require("axios");
const cheerio = require("cheerio");
const fs = require("fs");
const path = require("path");

// URL of the gallery page to scrape images from
const url = "https://citymotorbike.com/gallery/";

// Directory to save images
const imageDir = path.resolve(__dirname, "gallery");

// Function to download an image
const downloadImage = async (imageUrl, index) => {
  try {
    // Get the image data
    const response = await axios.get(imageUrl, { responseType: "arraybuffer" });

    // Extract file extension
    const extension = imageUrl.split(".").pop().split("?")[0];
    const fileName = `image_${index + 1}.${extension}`;
    const filePath = path.join(imageDir, fileName);

    // Save the image to the specified folder
    fs.writeFileSync(filePath, response.data);
    console.log(`Downloaded: ${fileName}`);
  } catch (error) {
    console.error("Error downloading image:", error.message);
  }
};

// Function to scrape all image URLs and download them
const scrapeImages = async () => {
  try {
    // Create the folder if it doesn't exist
    if (!fs.existsSync(imageDir)) {
      fs.mkdirSync(imageDir);
      console.log("Created folder: gallery");
    }

    // Fetch the page content
    const { data } = await axios.get(url);

    // Load the HTML into cheerio
    const $ = cheerio.load(data);

    // Array to store image URLs
    const imageUrls = [];

    // Find all images on the page and retrieve src, data-src, and data-srcset attributes
    $("img").each((index, img) => {
      const src = $(img).attr("src");
      const dataSrc = $(img).attr("data-src");
      const dataSrcset = $(img).attr("data-srcset");

      // Add images based on their availability and make sure URLs are absolute
      if (src && src.startsWith("http")) {
        imageUrls.push(src);
      } else if (dataSrc && dataSrc.startsWith("http")) {
        imageUrls.push(dataSrc);
      } else if (dataSrcset) {
        const largestImageUrl = dataSrcset.split(",")[0].split(" ")[0];
        if (largestImageUrl.startsWith("http")) {
          imageUrls.push(largestImageUrl);
        }
      }
    });

    // Download each image
    for (const [index, imageUrl] of imageUrls.entries()) {
      await downloadImage(imageUrl, index);
    }

    console.log("All images downloaded.");
  } catch (error) {
    console.error("Error scraping images:", error.message);
  }
};

// Start the scraping and downloading process
scrapeImages();
