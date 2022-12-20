<?php include 'connect.php' ?>

<?php

    if(isset($_GET["updateid"])) {
        $collection_id = $_GET["updateid"];
        $select_requet = "SELECT * FROM `collections` WHERE collection_id = $collection_id";
        $select_requet_quered = mysqli_query($connect, $select_requet);
        $data_fetched = mysqli_fetch_assoc($select_requet_quered);
    }

    if(isset($_POST["submit"])) {
        $collection_name = $_POST["name"];
        $collection_image = $_FILES["image"];
        $collection_artiste = $_POST["collectionid"];

        if((!($_FILES["image"]["name"]))) {
            $sql_query = "UPDATE `collections` SET collection_name = '$collection_name', collection_artiste = '$collection_artiste' WHERE collection_id = $collection_id";
            if(mysqli_query($connect, $sql_query)) {
                header('location: dashboard.php');
            }
        }else {
            // prepare image
            $image_name = $collection_image["name"];
            $image_old_path = $collection_image["tmp_name"];
            $new_folder_path = "assets/collection-images/" . $image_name;

            $sql_query = "UPDATE `collections` SET collection_name = '$collection_name', collection_image = '$new_folder_path', collection_artiste = '$collection_artiste' WHERE collection_id = $collection_id";
            if(mysqli_query($connect, $sql_query)) {
                move_uploaded_file($image_old_path, $new_folder_path);
                header('location: dashboard.php');
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NFTea - Add New Collection</title>
    <?php include 'styles-links.php'  ?>
</head>
<body>
    <section class="add-nft-page">
        <div class="container">
            <div class="form-wrapper">
                <form method="post" enctype="multipart/form-data">
                    <div class="input-field">
                        <label for="name">Collection Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter Collection Name" autocomplete="off" value="<?php echo $data_fetched["collection_name"] ?>">
                    </div>
                    <div class="input-field">
                        <label for="image">Collection Image</label>
                        <input type="file" name="image" id="image" accept="png jpeg" value="<?php echo $data_fetched["collection_image"] ?>">
                    </div>
                    <div class="input-field">
                        <label for="collectionid">Collection Author</label>
                        <input type="text" name="collectionid" id="collectionid" placeholder="Enter Collection Author" autocomplete="off" value="<?php echo $data_fetched["collection_artiste"] ?>">
                    </div>
                    <!-- <div class="input-field">
                        <label for="price">Price</label>
                        <input type="text" name="price" id="price" placeholder="Enter Price" autocomplete="off">
                    </div> -->
                    <div class="input-field">
                        <input type="submit" name="submit" id="submit" value="Update Collection">
                    </div>
                </form>
                <a href="dashboard.php"><button class="cancel">Cancel</button></a>
            </div>
        </div>
    </section>
</body>
</html>