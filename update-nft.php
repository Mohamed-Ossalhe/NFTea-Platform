<?php include 'connect.php' ?>

<?php

    if(isset($_GET["updateid"])) {
        $nft_id = $_GET["updateid"];
        $select_requet = "SELECT * FROM `nfts` WHERE nft_id = $nft_id";
        $select_requet_quered = mysqli_query($connect, $select_requet);
        $data_fetched = mysqli_fetch_assoc($select_requet_quered);
    }

    if(isset($_POST["submit"])) {
        $nft_name = $_POST["name"];
        $nft_image = $_FILES["image"];
        $nft_desc = $_POST["description"];
        $nft_collection_id = $_POST["collectionid"];
        $nft_price = $_POST["price"];

        if((!($_FILES["image"]["name"]))) {
            $sql_query = "UPDATE `nfts` SET nft_name = '$nft_name', nft_description = '$nft_desc', nft_price = '$nft_price', nft_collection_id = '$nft_collection_id' WHERE nft_id = $nft_id";
            if(mysqli_query($connect, $sql_query)) {
                header('location: dashboard.php');
            }
        }else {
            // prepare image
            $image_name = $nft_image["name"];
            $image_old_path = $nft_image["tmp_name"];
            $new_folder_path = "assets/nfts-images/" . $image_name;

            $sql_query = "UPDATE `nfts` SET nft_name = '$nft_name', nft_description = '$nft_desc', nft_price = '$nft_price', nft_image = '$new_folder_path', nft_collection_id = '$nft_collection_id' WHERE nft_id = $nft_id";

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
    <title>NFTea - Add New NFT</title>
    <?php include 'styles-links.php'  ?>
</head>
<body>
    <section class="add-nft-page">
        <div class="container">
            <div class="form-wrapper">
                <form method="post" enctype="multipart/form-data">
                    <div class="input-field">
                        <label for="name">NFT Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter NFT Name" autocomplete="off" value="<?php echo $data_fetched["nft_name"] ?>">
                    </div>
                    <div class="input-field">
                        <label for="image">NFT Image</label>
                        <input type="file" name="image" id="image" accept="png jpeg">
                    </div>
                    <div class="input-field">
                        <label for="image">NFT Description</label>
                        <textarea name="description" id="nft-description" cols="30" rows="10" placeholder="Enter NFT Description" autocomplete="off"><?php echo $data_fetched["nft_description"] ?></textarea>
                    </div>
                    <div class="input-field">
                        <label for="collectionid">Collection Name</label>
                        <select name="collectionid" id="collectionid">
                            <?php
                                $sql = "SELECT collection_name, collection_id FROM `collections`";
                                $sql_quered = mysqli_query($connect, $sql);
                                while($result = mysqli_fetch_assoc($sql_quered)) {
                                    echo '<option value="'. $result["collection_id"] .'">'. $result["collection_name"] .'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="input-field">
                        <label for="price">Price</label>
                        <input type="text" name="price" id="price" placeholder="Enter Price" autocomplete="off" value="<?php echo $data_fetched["nft_price"] ?>">
                    </div>
                    <div class="input-field">
                        <input type="submit" name="submit" id="submit" value="Update NFT">
                    </div>
                </form>
                <a href="dashboard.php"><button class="cancel">Cancel</button></a>
            </div>
        </div>
    </section>
</body>
</html>