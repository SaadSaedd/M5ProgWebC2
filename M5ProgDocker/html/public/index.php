<?php
include_once("../source/database.php");

$connection = database_connect();

$result = $connection->query("
    SELECT B.idboek, B.naam, B.img, B.text, C.naam as catNaam 
    FROM boek B
    JOIN boek_has_catogorie ON boek_has_catogorie.boek_idboek = B.idboek
    JOIN catogorie C ON boek_has_catogorie.catogorie_idcatogorie = C.idcatogorie
");

// Check for errors in the query
if (!$result) {
    die("Query failed: " . $connection->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boeken Winkel</title>
</head>
<body>
<h1 class="title">Boeken Winkel</h1>

<section>
    <?php
        // LOOP TILL END OF DATA
        while ($rows = $result->fetch_assoc()) {
    ?>
        <!-- Pass the book ID as a query string parameter in the URL -->
        <a href="single.php?id=<?php echo $rows['idboek']; ?>">
            <div class="boeken__full">
                <div class="boek__title"><?php echo $rows['naam']; ?></div>
                <div class="boek__foto">
                    <img class="boek__img" src="<?php echo $rows['img']; ?>" alt="">
                </div>
                <div class="boek__text"><?php echo $rows['text']; ?></div>
                <div class="boek__catogorie"><?php echo $rows['catNaam']; ?></div>
            </div>
        </a>
    <?php
        }
    ?>
</section>

</body>
</html>
