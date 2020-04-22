<!DOCTYPE html>
<html>
        <head>
            <link rel="stylesheet" href="main.css">
            <meta charset="UTF-8">
            <title>
                User Profile
            </title>
        </head>
<body>
  
  <div class="container" style="padding: 2em;">
    <div style="color: black;">
        <?php foreach($user as $u):
            echo '<h1>' . $u['display_name'] . "'s Account Info:" . '</h1>';
            echo '<strong> Username: </strong> ' . $u['username'] . '</br>';
            echo '<strong> Bio: </strong>' . $u['bio'] . '</br>';
            echo '<strong> Email: </strong>' . $u['email_address'] . '</br>';
        
        ?>
    </div>
    <br/>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="submit" value="Change Display Name" name="action" class="btn btn-primary" />   
        <input type="hidden" name="username" value="<?php echo $u['username']; ?>" />          
    </form> 
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="submit" value="Change Bio" name="action" class="btn btn-primary" />             
        <input type="hidden" name="username" value="<?php echo $u['username'] ?>" />          
    </form> 
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="submit" value="Update Email" name="action" class="btn btn-primary" />             
        <input type="hidden" name="username" value="<?php echo $u['username'] ?>" />          
    </form> 
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="submit" value="Delete Account" name="action" class="btn btn-danger" />      
        <input type="hidden" name="username" value="<?php echo $u['username'] ?>" />          
    </form>
    
    <?php endforeach; ?>
  </div>
  
  
</body>
</html>