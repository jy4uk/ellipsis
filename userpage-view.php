<!DOCTYPE html>
<html>
        <head>
            <link rel="stylesheet" href="main.css">
            <meta charset="UTF-8">
            <title>
                User Profile
            </title>
        </head>
  
    <div class="row" style="text-align: center; padding: 0 0 0 4em;">
        <div class="column" style="width=50%; text-align: center;">
            <div style="color: black;">
                <?php foreach($user as $u):
                    echo '<h1>' . $u['display_name'] . "'s Account Info:" . '</h1>';
                    echo '<strong> Username: </strong> ' . $u['username'] . '</br>';
                    echo '<strong> Bio: </strong>' . $u['bio'] . '</br>';
                    echo '<strong> Email: </strong>' . $u['email_address'] . '</br>';
                ?>
            </div>
        </div>
        <br/>
            
            <?php endforeach; ?>
        </div>
    </div>
    <br/>
    <div class="inner" style="padding: 0 0 0 4em">  
    <br/>
    <h2 style="color:black"><?php echo $displayname ?>'s's Active Stories</h2>
    <?php foreach($stories as $s): ?>
            <li>
            <?php echo '<a href="storypage.php?storyID=' . $s['storyID'] . '&title=' . $s['title'] . '&author_display=' . $s['display_name'] . '&author_user=' . $s['username'] . '">';
            echo $s['title'];
            ?></li>
        <?php endforeach; ?>
        <h2 style="color:black">Stories <?php echo $displayname ?>'s Likes</h2>
        <?php foreach($likes as $l): ?>
            <li>
            <?php echo '<a href="storypage.php?storyID=' . $l['storyID'] . '&title=' . $l['title'] . '&author_display=' . $l['display_name'] . '&author_user=' . $l['username'] . '">' ;
            echo $l['title'];
            echo " by " . getCreator($l['storyID']);
            ?>
            </li>
        <?php endforeach; ?>
        <br/>
        <h2 style="color:black">Stories <?php echo $displayname ?> is Following</h2>
            <?php foreach($follows as $f): ?>
                <li>
                <?php echo '<a href="storypage.php?storyID=' . $f['storyID'] . '&title=' . $f['title'] . '&author_display=' . $f['display_name'] . '&author_user=' . $f['username'] . '">' ;
                echo $f['title'];
                echo " by " . getCreator($f['storyID']);
                ?>
                </li>
        <?php endforeach; ?>
    <br/>    
    <h2 style="color:black">Stories <?php echo $displayname ?> commented on</h2>
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
    <h2 style="color:black">Stories <?php echo $displayname ?> is Following</h2>
        <?php foreach($follows as $f): ?>
            <li>
            <?php echo '<a href="storypage.php?storyID=' . $f['storyID'] . '&title=' . $f['title'] . '&author_display=' . $f['display_name'] . '&author_user=' . $f['username'] . '">' ;
            echo $f['title'];
            echo " by " . getCreator($f['storyID']);
            ?>
            </li>
    <?php endforeach; ?>
    <h2 style="color:black"><?php echo $displayname ?>'s Published Stories</h2>
        <?php foreach($published as $f): ?>
            <li>
            <?php echo '<a href="storypage.php?storyID=' . $f['storyID'] . '&title=' . $f['title'] . '&author_display=' . $f['display_name'] . '&author_user=' . $f['username'] . '">' ;
            echo $f['title'];
            echo " by " . getCreator($f['storyID']);
            ?>
            </li>
    <?php endforeach; ?>
  </div>
  
</html>