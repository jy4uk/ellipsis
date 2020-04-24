<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="main.css">
    <meta charset="UTF-8">
    <title>
        Stories
    </title>
</head>
<body>
    <?php foreach ($stories as $story): ?>
        <?php $details = getStoryDetails($story['storyID']);
        $storyID = $story['storyID'];
        if(isArchived($storyID)) {
            continue;
        }
        $title = $story['title'];
        $author_name = $details[0]['display_name'];
        $author_user = $details[0]['username'];
        if(isPublished($storyID)) {
            $style = "style2";
            $img = "images/pic02.jpg";
        }
        else {
            $style = "style3";
            $img = "images/pic03.jpg";
        } ?>
        <article class=<?php echo $style ?>>
            <span class="image">
                <img src=<?php echo $img ?> alt="" />
            </span>
            <?php
            
            echo '<a href="storypage.php?storyID=' . $storyID . '">
                <h2>' . $story['title'] . '</h2>
                <div class="content">
                    <p>By: ' . $author_name . ' (' . $author_user . ')</p>
                </div>
            </a>';
            ?>
        </article>
    <?php endforeach; ?>
</body>
</html>