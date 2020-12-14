 $(document).ready(function () {

     // Chart
     $.ajax({
         url: "../getdata.php",
         method: "GET",
         success: function (data) {
             data = JSON.parse(data);
             var Client = [];
             var commande = [];

             for (var i in data) {
                 Client.push(data[i].nom);
                 commande.push(data[i].total_commande);
             }

             var chartdata = {
                 labels: Client,
                 datasets: [{
                     label: 'Commande',
                     backgroundColor: 'rgba(200, 200, 200, 0.75)',
                     borderColor: 'rgba(200, 200, 200, 0.75)',
                     hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                     hoverBorderColor: 'rgba(200, 200, 200, 1)',
                     data: commande
                 }]
             };

             var ctx = $("#mycanvas");

             var barGraph = new Chart(ctx, {
                 type: 'bar',
                 data: chartdata
             });
         },
         error: function (data) {
             console.log(data);
         }
     });
 });