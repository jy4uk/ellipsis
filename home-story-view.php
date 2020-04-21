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
        <?php $author = getStoryAuthor($story['storyID']) ?>
        <article class="style2">
            <span class="image">
                <img src="images/pic02.jpg" alt="" />
            </span>
            <?php
            $storyID = $story['storyID'];
            $title = $story['title'];
            $author_name = $author[0]['display_name'];
            $author_user = $author[0]['username'];
            echo '<a href="storypage.php?storyID=' . $storyID . '&title=' . $title . '&author_display=' . $author_name . '&author_user=' . $author_user . '">
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