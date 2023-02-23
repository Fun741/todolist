<?php
    require('database.php');
    include('index.php');

    $itemNum = filter_input(INPUT_POST, "itemNum", FILTER_VALIDATE_INT);

    if($itemNum)
    {
        $query = 'DELETE FROM todoitems WHERE itemNum = :itemNum';
        $statment = db->prepare($quary);
        $statment->bindValue(':itemNum', $itemNum);
        $statement->execute();
        $statement->closeCursor();

        echo "Data deleted.";
    }

    $deleted = true;



?>
