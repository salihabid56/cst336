<!DOCTYPE html>
<html>
    <head>
        <title> Login Screen </title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link href="../css/styles.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            function checkSession(){
                $.ajax(
                {
                    method: "GET",
                    url: "../api/checkSession.php",
                    dataType: "json",
                    success: function(data, status) 
                    {
                        if(data == "user"){
                            $("#cart").attr("href",'cart.php');
                            $("#account").attr("href",'account.php');
                        }
                        if(data == "login"){
                            $("#cart").attr("href",'login.php');
                            $("#account").attr("href",'login.php');
                        }
                    }
                }); //ajax 
            }
            $("#navSearch").on("click", function(){
                  alert($("#searchInput").val());
            });
             $(document).ready(function(){  
                checkSession();
                let URL = window.location.href.split("=")[1]
                if(URL === 'True'){
                    $("#errorMsg").html("Wrong Login Credentials");
                }
             });
        </script>
        <style>
            #errorLogin{
                color:red;
            }
        </style>
    </head>

    <body>
          <!--NavBar top-->
         <nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center align-items-center top">
            <!-- Navbar brand -->
            <div class="top_Nav"style="width=100%">
              <!-- Collapse button -->
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
              <!-- Collapsible content -->
              <div class="collapse navbar-collapse" id="navbarSupportedContent" style='margin-right: 10px !important;'>
                  <!-- Links -->
                  <ul class="navbar-nav mr-auto">
                    <li> <a class="navbar-brand" href="index.php"><img src="../img/nav_bar/Logo.png" alt="Logo"></a></li>
                  </ul>
                  <!-- Links -->
                  <!-- Search form -->
                  <form class="form-inline top_Nav search_bar">
                    <input id="searchInput" class="form-control" style="margin-top: 22px !important;" type="text" placeholder="Search" aria-label="Search">
                    <button id="navSearch" style="width: 140px !important;" saria-label="Search">Search</button>
                  </form>
                  <ul class="navbar-nav nav_right">
                     <li class="nav-item top_right">
                        <a id="cart" class="nav-link" href="cart.php"><img src="../img/nav_bar/cart.png" alt="Cart"><br>cart</a>
                     </li>
                     <li class="nav-item">
                        <a id="account" class="nav-link" href="login.php"><img src="../img/nav_bar/account.png" alt="Account"><br>Account</a>
                     </li>
                  </ul>
                </div>
                    <div class="navbar-collapse collapse w-100 ml-auto d-flex align-items-center bottom"style='padding: 15px;' id="collapsingNavbar3">
                      <ul class="navbar-nav w-100 justify-content-center">
                        <li class="nav-item active">
                            <a class="nav-link" href=""></a>
                        </li>
                        <li class="nav-item">
                            <!--<a class="nav-link" href="products.php">Products</a>-->
                        </li>
                        <li class="nav-item">
                            <!--<a class="nav-link" href="about.php">About Us</a>-->
                        </li>
                    </ul>
                  </div>
              </div>
              <!-- Collapsible content -->
          </nav>
        <!--/.Navbar--> 

        <div>
        <form method="POST" action="../api/loginProcess.php">
            
            Username: <input type="text" name="username" id="username"style="width:20%;!important"/> <br/>
            
            Password: <input type="password" name="password"style="width:20%;!important"/> <br/>
            
            <input type="submit" value="Login!" ><br>
            <a href="createAccount.php">Create Account</a>
        </form>
        </div>
        <div id="errorLogin"><h3 id="errorMsg"></h3></div>

    </body>
</html>