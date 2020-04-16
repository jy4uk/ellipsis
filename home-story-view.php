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
        <article class="style2">
            <span class="image">
                <img src="images/pic02.jpg" alt="" />
            </span>
            <a href="generic.html">
                <h2><?php echo $story['title']; ?></h2>
                <div class="content">
                    <p>Description</p>
                </div>
            </a>
        </article>
    <?php endforeach; ?>
</body>
</html>