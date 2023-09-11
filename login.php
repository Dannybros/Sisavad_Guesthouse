<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link 
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
            rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" 
            crossorigin="anonymous"
        />
        <link 
            rel="stylesheet" 
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        />
        <link href="assets/css/login.css" rel="stylesheet">
        <title>Log In</title>
    </head>
    <body>
        <div class="login__page">
            <?php
                if(isset($_GET['error'])){
                    echo'
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <div>
                                Username or Password is incorrect!
                            </div>
                            <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    ';
                }
            ?>

            <form method="POST" action="controllers/auth.php" class="login_Form p-4">                
                <div class="login_box container">
                    <h3 class="mb-3 text-white">Sisavad Hotel Managment</h3>
                    <div class="input-group my-3 d-flex align-items-center">
                        <span class="input-group-text p-2 px-3" style="height: 42px;" id="basic-addon1">
                            <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control p-2" name="username" placeholder="Username...">
                    </div>

                    <div class="input-group mb-3 d-flex align-items-center">
                        <span class="input-group-text p-2 px-3" style="height: 42px;" id="basic-addon1">
                            <i class="fa fa-lock"></i>
                        </span>
                        <input type="password" class="form-control p-2" name="password" placeholder="Password...">
                    </div>

                    <button type="submit" class="btn btn-primary" name="submit">Login</button>

                </div>
            </form>
        </div>
    </body>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(this).alert('close');
            window.history.pushState('', '', 'login.php');
        });
    </script>
</html>