
<?php

//Adrian ELgin
//to do list
//2/22/2023

    require('database.php');
    require('delete.php');

    $pdo = new PDO("mysql:host=localhost;dbname=todolist;charset=utf8","root","");

    //POST DATA
    $newTitle = filter_input(INPUT_POST, "newTitle", FILTER_UNSAFE_RAW);
    $newDescription = filter_input(INPUT_POST, "newDescription", FILTER_UNSAFE_RAW);

    //GET DATA
    $title = filter_input(INPUT_GET, "title", FILTER_UNSAFE_RAW);
    $description = filter_input(INPUT_GET, "description", FILTER_UNSAFE_RAW);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do List</title>
    <link rel="stylesheet" href="main.css">
</head>


<body>
<main>
    <header>
        <h1>To do List</h1>
    </header>

    <section>
        <h2>Things to do (insert data/read data)</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <label for="newTitle">Chore name:</label>
            <input type="text" id="newTitle" name="newTitle" required>
            <br>
            <label for="newDescription">Chore Description:</label>
            <input type="text" id="newDescription" name="newDescription" required>
            <br>
            <button>Add chore</button>

        </form>
    </section>

    <section>
        <?php include("database.php") ?>

        <?php

            $query = 'INSERT INTO todoitems
                        (Title, Description)
                        VALUES
                        (:newTitle, :newDescription)';
            $statement = $db->prepare($query);
            $statement->bindValue(':newTitle', $newTitle);
            $statement->bindValue(':newDescription', $newDescription);
            $statement->execute();
            $statement->closeCursor();                   
        ?>

        <?php
            $query = 'SELECT * FROM todoitems';

            $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();

            if (empty($results))
            {
                echo "You have no current tasks.";
            }
            else
            {
                foreach ($results as $result)
                {
                    //$itemNum = $result['itemNum'];
                    $Title = $result['Title'];
                    $Discription = $result['Description'];
                    //echo $Title . " " . $Discription;
                    echo "<li> " . $Title . "<br>" . $Discription . " <a href='./delete.php>Delete</a> </li> ";

                    
                    //echo "<button>Delete</button>";
                    //echo "<a href='./delete.php>Delete</a>";
                    echo "<br><br>";
                }
            }
        ?>  
    </section>


</main>
</body>
