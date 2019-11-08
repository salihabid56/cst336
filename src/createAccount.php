<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link href="../css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
  
    <script>
    /*global $*/
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
     $(document).ready(function(){ 
       var check = true;
       checkSession();
        $("#username").on("change", function() {//check if the username already exist in the Database
          
          $.ajax({
                  type: "GET",
                  url: "../api/createAccountAPI/checkUsername.php",
                  dataType: "text", //is it json if i don't json encode ? 
                  data: { "username": $('#username').val()
                          
                  },
                  success: function(data,status) {
                  //alert(data);
                  //console.log(data);
                  if(data == "false"){
                    $("#usernameError").html("Username available"); 
                    $("#usernameError").css("color", "blue");
                    check = true;
                  }
                  else{
                        alert("username is not available")
                        $("#usernameError").html("Username already exist"); 
                        $("#usernameError").css("color", "red");
                        check = false;
                      // window.location.href = "/cst336finalProject/src/createAccount.php"
                  }
                  
                  },//success function
                  complete: function(data,status) { //optional, used for debugging purposes
                  //alert(status);
                  }
              });//ajax Call 
            
            }); // Username onchange event 
    
    
        $("#email").on("change", function() {// check if email already exist in the Database
        
          $.ajax({
                  type: "GET",
                  url: "../api/createAccountAPI/checkEmail.php",
                  dataType: "text", //is it json if i don't json encode ? 
                  data: { "email": $('#email').val()
                          
                  },
                  success: function(data,status) {
                  //alert(data);
                  console.log(data);
                  if(data == "false"){
                  check = true;
                  }
                  else{
                      alert("This email is associated with another account")
                       $("#emailError").html("Email already exist"); 
                       $("#emailError").css("color", "red");
                       check = false;
                  }
                  
                  },
                  complete: function(data,status) { //optional, used for debugging purposes
                  //alert(status);
                  }
              });//ajax
              
          }); // end event 
    
        $("#signupbtn").on("click", function(event){
          
            var fullname =  $("#fullname").val();
            var email =  $("#email").val();
            var username = $("#username").val();
            var password = $("#password").val();
            var cpassword = $("#cpassword").val();
            event.preventDefault();
              
              if(fullname == '' || email == '' || username == ''|| password == ''){
                alert("All fields need to be filled");
                } 
                else if ((password.length)<8){
                 alert("Password should be 8 or more characters");
                }
                else if (password != cpassword) {
                  alert("Your password doesn't match");
                }
                else if (!(check)){
                  alert("Please fix the errors!");
                }
                else{
                  
                     $.ajax({
                            type: "GET",
                            url: "../api/createAccountAPI/registerAccount.php",
                            dataType: "text", //is it json if i don't json encode ? 
                            data: { "fullname": $("#fullname").val(),
                                    "email": $("#email").val(),
                                    "username": $("#username").val(),
                                    "password": $("#password").val()
                            },
                           
                            success: function(data,status) {
                              //console.log(data);
                              if(data == "Invalid"){
                                $("#emailError").html("Invalid email");
                                $("#emailError").css("color", "#f90202");
                              }
                              else {
                                alert("Your account created successfully");
                                window.location.href = "/../src/login.php"
                              }
                             // window.location.href = "/cst336finalProject/src/login.php"
                            //alert(data);
                            },
                            complete: function(data,status) { //optional, used for debugging purposes
                            //alert(status);
                            }
                        });//ajax
                              }
                });//onclick signup button
        $("#navSearch").on("click", function(){
          alert($("#searchInput").val());
        });
     });//document ready
  
  </script>

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
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About Us</a>
                </li>
            </ul>
          </div>
      </div>
      <!-- Collapsible content -->
  </nav>
<!--/.Navbar--> 
 
  <div class="container">
    <h1>Sign Up</h1>
    
    <p>Please fill in this form to create an account.</p>
    
    <label for="name"><b>Full Name</b></label>
    <input type="text" placeholder="Full Name" name="fullname" id = "fullname" required>
    
    <label for="userName"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" id = "username" required>
    <div id="usernameError"></div> <br />
          

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id = "email" required>
    <span id="emailError"></span> <br />

    <label for="psw"><b>Password (8 or more characters)</b></label>
    <input type="password" placeholder="Enter Password" name="password" id = "password"  required>

    <label for="psw-confirm"><b>Confirm Password</b></label>
    <input type="password" placeholder="Confirm Password" name="cpassword" id = "cpassword" required>

    <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>

    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <form action="login.php">
         <button type="submit" class="cancelbtn">Cancel</button>
         <button type="submit" class="signupbtn" id = "signupbtn">Sign Up</button>
         
      </form>
       
          
          
     
      <!--<button type="button" class="cancelbtn"></button>-->
   
    </div>
  </div>
</form>
   <hr>
  </br></br>
  <div class = "footer" id = "footer">
          <footer>
            <p>We care about you. Do not hesitate to contact us.</p>
            <p><h3>Contact us: </h3> @ 831-000-11111 or by email:    spicy@basket.com</p>
        </footer>
  </div>
</body>
</html>

