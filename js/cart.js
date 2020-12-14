 $(document).ready(function () {

     //Function to add items to Cart and send it to database

     $(".additembtn").click(function (e) {
         e.preventDefault();
         var $form = $(this).closest(".form-submit");
         var product_id = $form.find(".product_id").val();
         var product_price = $form.find(".product_price").val();

         $.ajax({
             url: 'action.php',
             type: 'POST',
             data: {
                 product_id: product_id,
                 product_price: product_price,
             },
             success: function (response) {
                 load_item_counter();
                 $('#message').html(response);
                 $('.message').html(response);
             }
         });


     });
     load_item_counter();

     //Function to update the number of items in the cart

     function load_item_counter() {
         $.ajax({
             url: 'action.php',
             type: 'GET',
             data: {
                 cartitem: "item_num"
             },
             success: function (response) {
                 $('.item_counter').html(response);

             }
         })
     }

     // Function to update the Totale price of the cart if the quantity changed

     $(".item_quantity").on('change', function () {
         var $el = $(this).closest('tr');

         var cart_id = $el.find(".cart_id").val();
         var product_price = $el.find(".product_price").val();
         var product_quantity = $el.find(".item_quantity").val();
         //  console.log(product_quantity);
         location.reload(true);
         $.ajax({
             url: 'action.php',
             type: 'POST',
             catch: false,
             data: {
                 product_quantity: product_quantity,
                 product_price: product_price,
                 cart_id: cart_id
             },
             success: function (response) {
                 console.log(response);
             }
         });
     });

     //Function

 });