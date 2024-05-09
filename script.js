document.addEventListener("DOMContentLoaded", function() {
  // Your JavaScript code here
  function searchProduct() {
      var searchInput = document.getElementById("searchInput").value.toLowerCase();
      var products = [
          "Japanese Spitz",
          "German Shepherd",
          "Labrador Retriever",
          "Golden Retriever",
          "Poodle",
          "Beagle"
      ];

      var matchingProducts = products.filter(function(product) {
          return product.toLowerCase().includes(searchInput);
      });

      // Redirect to the search results page with the search query as a parameter
      window.location.href = "search-results.html?query=" + encodeURIComponent(searchInput);
  }

  document.getElementById("shelter").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent default link behavior
    
    // Redirect to the login page
    window.location.href = "http://localhost/pet-adoption-system-html-css-js-php/login.php";
});

  document.getElementById("dog").addEventListener("click", function() {
      window.location.href = "buy.html";
  });

  document.getElementById("adoptMe").addEventListener("click", function() {
      window.location.href = "order.html";
  });

  var imageSources = [
      "./public/beautifulpetportraitdog@2x.png",
      "./public/joe-caione-qO-PIF84Vxg-unsplash.jpg",
      "./public/closeup-shot-cute-husky-green-field.jpg"
  ];

  var currentIndex = 0;
  var slideshowInterval;

  // Function to start the slideshow
  function startSlideshow() {
      // Change the image source initially
      document.getElementById("slideshow").src = imageSources[currentIndex];
      currentIndex++;

      // Start the slideshow interval
      slideshowInterval = setInterval(function() {
          // Change image source
          document.getElementById("slideshow").src = imageSources[currentIndex];
          currentIndex++;

          // Reset index if it exceeds the length of image sources
          if (currentIndex === imageSources.length) {
              currentIndex = 0;
          }
      }, 3000); // Change image every 3 seconds (3000 milliseconds)
  }

  // Function to stop the slideshow
  function stopSlideshow() {
      clearInterval(slideshowInterval);
  }

  // Start the slideshow when the page loads
  startSlideshow();
});


// Get a reference to the "Adopt" button in the navbar
const adoptButton = document.querySelector('.home[href="/buy.html"]');

// Add an event listener to the "Adopt" button
adoptButton.addEventListener('click', function(event) {
    // Prevent the default behavior of the link
    event.preventDefault();

    // Get a reference to the category section
    const categorySection = document.getElementById('category');

    // Scroll to the category section
    categorySection.scrollIntoView({ behavior: 'smooth' });
});

const productButton = document.querySelector('.home[href="/buy.html"]');

// Add an event listener to the "Adopt" button
productButton.addEventListener('click', function(event) {
    // Prevent the default behavior of the link
    event.preventDefault();

    // Get a reference to the category section
    const categorySection = document.getElementById('productDisplay');

    // Scroll to the category section
    categorySection.scrollIntoView({ behavior: 'smooth' });
});

document.getElementById('searchIcon').addEventListener('click', function() {
    console.log('Image clicked');

    window.location.href = 'view_products.php';
});


