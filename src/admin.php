<!DOCTYPE html>
<html>
    <head>
        <title> Spice Basket - Admin Section </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

        <script>
        
            function confirmDelete(){
                
                return confirm("Are you sure you want to delete this product?");
                
            }
            
            function openModal(){
                $('#productModal').modal("show"); //opens the modal
            }
            
            $(document).ready(function(){
                
                 $.ajax({
                 method: "GET",
                    url: "../api/productAPI/getProducts.php",
                dataType: "json",
                success: function(data, status) {

              data.forEach(function(product){
                  $("#products").append("<div class='row'>" + 
                                        "<div class='col1'>" + 
                                        "<a class=\"btn btn-primary\"  href='update.php?product_id="+product.product_id+"'> Update </a>" +
                                        //"[<a href='delete.php?productId="+product.productId+"'> Delete </a>]" +
                                        "<form action='../api/productAPI/deleteProduct.php' method='post' onsubmit='return confirmDelete()'>"+
                                        "<input type='hidden' name='product_id' value='"+ product.product_id + "'>" +
                                        "<button class=\"btn btn-outline-danger\">Delete</button></form>" +
                                        "<a target='productIframe' onclick='openModal()' href='productInfo.php?product_id="+product.product_id+"'> " + product.product_name + "</a></div>"+
                                        "<div class='col2'>"+"$" + product.product_price + "</div>"+
                                        "</div><br>");
              })

                }
                }); //ajax 
                
                
                $("#numProduct").on("click", function(){
                    $.ajax({
                        method: "GET",
                        url: "../api/adminAPI/getReportsAPI.php",
                        dataType: "json",
                        data: {'report_type': $("#numProduct").val()},
                        success: function(data, status) {
                            alert(data['count(*)']);
                        }
                    });//ajax
                });
                
                $("#avgPrice").on("click", function(){
                    $.ajax({
                        method: "GET",
                        url: "../api/adminAPI/getReportsAPI.php",
                        dataType: "json",
                        data: {'report_type': $("#avgPrice").val()},
                        success: function(data, status) {
                            alert(data['avg(product_price)']);
                        }
                    });//ajax
                });
                $("#totalStock").on("click", function(){
                    $.ajax({
                        method: "GET",
                        url: "../api/adminAPI/getReportsAPI.php",
                        dataType: "json",
                        data: {'report_type': $("#totalStock").val()},
                        success: function(data, status) {
                            alert(data['sum(product_stock)'])
                        }
                    });//ajax                
                });
                
            });//documentReady

        </script>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <style>
        
            .row  { display:flex; }
        
            .col1 { width:400px; }
            
            form { display: inline-block; }
            
            #products {
                 margin: 35px;
            }

        </style>   
        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
    </head>
    <body>

        <h1> Spice Basket - Admin Section </h1>

        Welcome <?=$_SESSION['adminName']?>
        
    <br><hr><br>
    
    <form action="addProducts.php">
        <button>Add New Product</button>
    </form>
    
    <form action="../api/logout.php">
        <button>Logout</button>
    </form>
    <button id="numProduct" value='1'>Number of products</button>
    <button id="avgPrice" value='2'>Average Product price</button>
    <button id="totalStock"value='3'>Total stock</button>
    
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