document.addEventListener("DOMContentLoaded", function() {
    var queryString = window.location.search;
    var urlParams = new URLSearchParams(queryString);
    var searchQuery = urlParams.get('query');
    
    if (searchQuery) {
      // You can perform search or fetch similar products based on the search query here
      displaySearchResults(searchQuery);
    } else {
      // Handle case when no query is provided
      console.log("No search query provided.");
    }
  });
  
  function displaySearchResults(query) {
    // Here you can fetch the search results or similar products based on the query
    // and then dynamically populate the HTML with the results
  }
  