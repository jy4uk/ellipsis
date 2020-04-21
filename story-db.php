<?php

function getStoryPieces(int $storyID) {
    global $db;
    $query = "SELECT story_text, piece_key FROM contributes_to WHERE storyID = $storyID ORDER BY piece_key";
    $statement = $db->prepare($query);
    $statement->execute();

    $results = $statement->fetchAll();

    $statement->closecursor();

    return $results;
}

?>