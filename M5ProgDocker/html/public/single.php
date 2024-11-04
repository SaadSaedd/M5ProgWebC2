<?php
include_once("../source/database.php");

$connection = database_connect();

// Check if the 'id' parameter is in the URL
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    // Corrected query with updated join conditions
    $stmt = $connection->prepare("
        SELECT B.naam, B.img, B.text, C.naam as catNaam
        FROM boek B
        JOIN boek_has_catogorie ON boek_has_catogorie.boek_idboek = B.idboek
        JOIN catogorie C ON boek_has_catogorie.catogorie_idcatogorie = C.idcatogorie
        WHERE B.idboek = ?
    ");
    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the book details
    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "Book not found.";
        exit();
    }
} else {
    echo "No book ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="single.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

<section class="single">
    <div class="single__left">
        <img src="<?php echo $book['img']; ?>" alt="<?php echo $book['naam']; ?>">
        </div>
    <div class="single__right">
    <h1><?php echo $book['naam']; ?></h1>
    <div class="boek__catogorie"><?php echo $book['catNaam']; ?></div>
    <div class="boek__text"><?php echo $book['text']; ?></div>
    </div>

</section>
<a href="index.php"><button class="btn"> home
</button></a>

    
</body>
</html>
