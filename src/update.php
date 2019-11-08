<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

         <script>
            $.ajax({
                type: "GET",
                url: "../api/adminAPI/getCategories.php",
                dataType: "json",
                success: function(data, status) {
                    data.forEach(function(key) {
                        $("#catId").append("<option value=" + key["cat_id"] + ">" + key["cat_name"] + "</option>");
                    });
                    getProductInfo();
                }
            }); 
                
                 
            function getProductInfo() {    
                $.ajax({
                    type: "GET",
                    url: "../api/productAPI/getProductInfo.php",
                    dataType: "json",
                    data:{"product_id": <?=$_GET['product_id']?>},
                    success: function(data, status) {
                         $("#productName").val(data["product_name"]);
                         $("#productDescription").val(data["product_description"]);
                         $("#productPrice").val(data["product_price"]);
                         $("#productStock").val(data["product_stock"]);
                         $("#productImage").val(data["product_img"]);
                         $("#catId").val(data["cat_id"]).change();
                    }
                });
            }    
                
                $(document).ready(function(){  
                    
                    $("#submitButton").on("click",function(){
                        
                        $.ajax({
                            type: "GET",
                            url: "../api/adminAPI/updateProductAPI.php",
                            dataType: "json",
                            data:{"product_id": <?=$_GET['product_id']?>,
                                "product_description": $("#productDescription").val(),
                                "product_price": $("#productPrice").val(),
                                "product_name": $("#productName").val(),
                                "product_stock":$("#productStock").val(),
                                "cat_id": $("#catId").val(),
                                "product_img": $("#productImage").val()
                            },
                            success: function(data, status) {
                                //$("#updated").html("Product Updated");
                            }
                            
                        });//end
                        $("#updated").html("Product Updated");
                    });
                    
                });//documentReady
                
                </script>
        
        
    </head>
    <body>
    <h1> Update Product</h1>
    Enter Product Name:<input type="text" id = "productName" size="50">
    <br>
    Enter Product Description: <textarea id="productDescription" cols="40" rows="3"></textarea>
    <br>
    Product Image:<input type = "text" id = "productImage">
    <br/>
    Product Price: <input type="text" id="productPrice">
    <br/>
    Product Stock: <input type="text" id="productStock">
    <br/>
    Categories Name: <Select id = "catId">
    <Option> Select One </Option>
    </Select><br>
    
    <button id="submitButton">Update Product</button>
    
    <span id="updated"></span>
    
    
    
    
    
    
    
    </body>
</html>