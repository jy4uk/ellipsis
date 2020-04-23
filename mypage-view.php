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
    <br/>
    <h2 style="color:black">Stories You Created</h2>
    <?php foreach($stories as $s): ?>
            <li>
            <?php echo '<a href="storypage.php?storyID=' . $s['storyID'] . '&title=' . $s['title'] . '&author_display=' . $s['display_name'] . '&author_user=' . $s['username'] . '">';
            echo $s['title'];
            ?></li>
        <?php endforeach; ?>
        <h2 style="color:black">Stories You Like</h2>
        <?php foreach($likes as $l): ?>
            <li>
            <?php echo '<a href="storypage.php?storyID=' . $l['storyID'] . '&title=' . $l['title'] . '&author_display=' . $l['display_name'] . '&author_user=' . $l['username'] . '">' ;
            echo $l['title'];
            echo " by " . getCreator($l['storyID']);
            ?>
            </li>
        <?php endforeach; ?>
    <br/>
    <h2 style="color:black">Stories You Dislike</h2>
        <?php foreach($dislikes as $dl): ?>
            <li>
            <?php echo '<a href="storypage.php?storyID=' . $dl['storyID'] . '&title=' . $dl['title'] . '&author_display=' . $dl['display_name'] . '&author_user=' . $dl['username'] . '">' ;
            echo $dl['title'];
            echo " by " . getCreator($dl['storyID']);
            ?>
            </li>
        <?php endforeach; ?>
    <br/>    
    <h2 style="color:black">Stories You've commented on</h2>
        <?php foreach($comments as $c): ?>
            <li>
            <?php echo '<a href="storypage.php?storyID=' . $c['storyID'] . '&title=' . $c['title'] . '&author_display=' . $c['display_name'] . '&author_user=' . $c['username'] . '">' ;
            echo $c['title'];
            echo " by " . getCreator($c['storyID']);
            echo "  |  " . $c['comment_text'];
            ?>
            </li>
    <?php endforeach; ?>
    <br/>
    <h2 style="color:black">Stories You're Following</h2>
        <?php foreach($follows as $f): ?>
            <li>
            <?php echo '<a href="storypage.php?storyID=' . $f['storyID'] . '&title=' . $f['title'] . '&author_display=' . $f['display_name'] . '&author_user=' . $f['username'] . '">' ;
            echo $f['title'];
            echo " by " . getCreator($f['storyID']);
            ?>
            </li>
    <?php endforeach; ?>
  </div>
  
  
</body>
</html>