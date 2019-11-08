<script>
            // function displayCart(){
        //   alert(window.userName);
        //   for(var i=0; i< 50 ; i++){
        //      $("#selectQuantity").append("<option value='" + i + "'>"+ i + "</option>"); 
        //      $("#quantity").hide();
        //      $("updateBtn").hide();
        //      $("deleteBtn").hide();
        //      $("checkoutBtn").hide();
        //     }    
        //   var productId = [];      
        //         $.ajax({
        //                 type: "GET",
        //                 url: "../api/cartAPI/getAllFromCart.php",
        //                 dataType: "json",
        //                 data: { "username": "<?=$_GET['username']?>"
        //                 },
        //                 success: function(data,status) {
        //                 data.forEach(function(key){  
        //                   alert(data);    
        //                   productId.push(key.product_id);  
        //                  });
        //                 },
        //                 complete: function(data,status) { //optional, used for debugging purposes
        //                      //alert(status)
        //                 }
                            
        //         });//ajax
                
        //         $.ajax({
        //                 type: "GET",
        //                 url: "../api/productAPI/getProductInfo.php",
        //                 dataType: "json",
        //                 data: { "product_id": productId
        //                 },
        //                 success: function(data,status) {
        //                 data.forEach(function(key){
        //                   $("#productImage").append("<img src='" + key.product_img + "'>");  
        //                   $("#productName").append(key.product_name);
        //                   $("#productDesc").append(key.product_description);
        //                   $("#productPrice").append(key.product_price);
        //                   $("#quantity").show();
        //                   $("updateBtn").show();
        //                   $("deleteBtn").show();
        //                   $("checkoutBtn").show();
                          
        //                  });
        //                 },
        //                 complete: function(data,status) { //optional, used for debugging purposes
        //                      //alert(status)
        //                 }
                            
        //           });//ajax
                
        //     }// display function
        
        // function addToCart(){
        //         $.ajax({
        //         method: "GET",
        //          url: "../api/cartAPI/addToCart.php",
        //         dataType: "json",
        //         data:{ "product_id": <?=$_GET['product_id']?>,
        //             "quantity": <?=$_GET['quantity']?>,
        //             "unit_price": <?=$_GET['unit_price']?>,
        //             "username": "<?=$_GET['username']?>"
        //         },
        //             success: function(data, status) {
                        
        //                 $("#successMessage").html("The product(s) have been added to your cart!"); 
                        
        //             },
        //             complete: function(data,status) { //optional, used for debugging purposes
        //             //alert(status)
        //             }
                
        //       });//ajax
        // } //add to cart
        
        
              //----------Add to cart and Display Cart-----------------                 
            // addToCart();
            // displayCart();     
                
    //   //----------Update Cart-----------------     
    //           $("#updateBtn").on("click", function(){    
    //                 $.ajax({
    //                         type: "GET",
    //                         url: "../api/cartAPI/updateItemQuantity.php",
    //                         dataType: "json",
    //                         data: { 
    //                                 "quantity": <?=$_GET['quantity']?>,
    //                                 "productId": <?=$_GET['productId']?>,
    //                                 "username": "<?=$_GET['username']?>"
    //                         },
    //                         success: function(data,status) {
                                   
    //                           $("#successMessage").html("The products have been added to your cart!");    
    //                         },
    //                         complete: function(data,status) { //optional, used for debugging purposes
    //                              //alert(status)
    //                         }
                                
    //                  });//ajax
            
    //           }); //update cart
               
    // //----------Delete from Cart-----------------   
             
    //           $("#deleteBtn").on("click", function(){
    //              alert("Do you want to delete this product from the cart?");     
    //              $.ajax({
    //                         type: "GET",
    //                         url: "../api/cartAPI/removeFromCart.php",
    //                         dataType: "json",
    //                         data: { "productId": <?=$_GET['productId']?>
    //                         },
    //                         success: function(data,status) {
    //                           $("#successMessage").html("The product(s) have been deleted from your cart!");    
    //                         },
    //                         complete: function(data,status) { //optional, used for debugging purposes
    //                              //alert(status)
    //                         }
                                
    //              });//ajax
    //           }); //delete from cart
               
    // //----------Checkout from Cart-----------------         
    //               $("#checkoutBtn").on("click", function(){    
    //                 $.ajax({
    //                         type: "GET",
    //                         url: "../api/cartAPI/checkoutCart.php",
    //                         dataType: "json",
    //                         data: { "quantity": <?=$_GET['quantity']?>,
    //                                 "productId": <?=$_GET['productId']?>,
    //                                 "username": "<?=$_GET['username']?>"
    //                         },
    //                         success: function(data,status) {
                                   
    //                           $("#successMessage").html("The product(s) have been checked out from your cart!");    
    //                         },
    //                         complete: function(data,status) { //optional, used for debugging purposes
    //                              //alert(status)
    //                         }
                                
    //                  });//ajax
            
    //           }); //update cart
    
    $.ajax({
        type: "GET",
        async: false,
        url: "../api/cartAPI/getAllFromCart.php",
        dataType: "json",
        data: { "username": user },
        success: function(data,status) {
            data.forEach(function(){
                var prod_id = data[i].product_id;
                $("#cart_items").append("<div id='col'>");
                $.ajax({
                    type: "GET",
                    async: false,
                    url: "../api/productAPI/getProductInfo.php",
                    dataType: "json",
                    data: { "product_id": prod_id},
                    success: function(stuff,status) {
                        $("#cart_items").append(stuff.product_name + "&emsp;&emsp;");
                    },
                });//ajax
                $("#cart_items").append("Qty: <input id='inputQty' type='text' style='width:3%' value='" + data[i++].quantity + "'> &emsp; <button id='updateBtn' style='width:9%; height:1%;'>Update</button>&emsp;&emsp;&emsp;&emsp;<button id='delete' style='width:9%; height:1%;'>Delete</button>");
                $("#cart_items").append("</div>");  
            })
                    
        }
    });

    $.ajax({

    type: "GET",
    url: "api/getProducts.php",
    dataType: "json",
    success: function(data,status) {
      //alert(data[0].productName);
      data.forEach(function(product){
      })
    },
    complete: function(data,status) { //optional, used for debugging purposes
    //alert(status);
    }
    
});//ajax

</script>