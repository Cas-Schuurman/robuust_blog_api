//Fetch blog data from localstorage
let blogData = JSON.parse(localStorage.getItem('blogs'));
//Assing ctx to blogchart
const ctx = document.getElementById('blogchart');
//transfer it from json to array
var result = Object.keys(blogData).map((key) => [key, blogData[key]]);
//fetch only the blogspermonth
var blogsPerMonthData = result.map((element) => element[1]['blogspermonth']);
var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];


//Create new bar chart using chart.js
new Chart(ctx, {
  type: 'bar',
  data: {
      labels: months,
      datasets: [{
          label: 'Blogs',
          data: blogsPerMonthData,
          borderWidth: 1
      }]
      
  },
  options: {
    //make sure the graphic is responsive
      responsive: true,
      scales: {
          y: {
          beginAtZero: true
          }
      }
  }

});

// create datatable with the sorting options and put the how many entires on disabled and the paging on disabled because,
//  these are already loaded using bootstrap

new DataTable('#blogtable', {
      columnDefs: [
          {
            //Make the columns 0, 1, 3, 5 unsortable
              targets: [0, 1, 3, 5],
              orderable: false,
          }
      ],
  info: false,
  lengthChange: false,
  paging: false,
});