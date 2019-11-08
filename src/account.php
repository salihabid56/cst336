<!DOCTYPE html>
<html>
    <head>
        <title> Spice Basket - User Section </title>
    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link href="../css/styles.css" rel="stylesheet" type="text/css" />
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    </head>
     <script>
     <?php session_start();?>
//      $(document).ready(function(){
//           $("#past").on("click", function(){
//               alert("hi");
//                   $.ajax({
//                     type: "GET",
//                     url: "../api/userAPI/userInfo.php",
//                     dataType: "json",
//                     data : { username:'username'
//                     },
//                     success: function(data, status) {
//                         alert("succes");
                        
//                     }
//                 }); 
//         });
// });
    </script>
    
    <body>

        <h1> Spice Basket - User Section </h1>

        Welcome <?=$_SESSION['userName']?>
        
    <br><hr><br>
    
       <!--<button id="past">Past Purchases<br></button>-->
       
     <form action="../src/cart.php">
        <button>Cart</button>
     </form>
       
    <form action="../api/logout.php">
        <button>Logout</button>
    </form>
    
    <br><br>
    
     <div id="products"></div>
     
     

<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Product Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe name="productIframe"  width="400" height="400"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


    </body>
</html>