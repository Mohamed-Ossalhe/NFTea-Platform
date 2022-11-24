<?php include 'connect.php' ?>
<?php 
    if(isset($_POST["submit"])) {
        $nft_name = $_POST["name"];
        $nft_image = $_FILES["image"];
        $nft_desc = $_POST["description"];
        $nft_collection_id = $_POST["collectionid"];
        $nft_price = $_POST["price"];

        // prepare image
        $image_name = $nft_image["name"];
        $image_old_path = $nft_image["tmp_name"];
        $new_folder_path = "assets/nfts-images/" . $image_name;

        $sql_query = "INSERT INTO `nfts`(nft_name, nft_description, nft_price, nft_image, nft_collection_id) VALUES('$nft_name', '$nft_desc', '$nft_price', '$new_folder_path', '$nft_collection_id')";

        if(mysqli_query($connect, $sql_query)) {
            move_uploaded_file($image_old_path, $new_folder_path);
            header('location: dashboard.php');
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
                    <?php
                        $check_collection = "SELECT * FROM `collections`";
                        $check_query = mysqli_query($connect, $check_collection);
                        if(mysqli_num_rows($check_query) !== 0){
                    ?>
                        <form method="post" enctype="multipart/form-data">
                        <div class="input-field">
                            <label for="name">NFT Name</label>
                            <input type="text" name="name" id="name" placeholder="Enter NFT Name" autocomplete="off">
                        </div>
                        <div class="input-field">
                            <label for="image">NFT Image</label>
                            <input type="file" name="image" id="image" accept="png jpeg">
                        </div>
                        <div class="input-field">
                            <label for="image">NFT Description</label>
                            <textarea name="description" id="nft-description" cols="30" rows="10" placeholder="Enter NFT Description" autocomplete="off"></textarea>
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
                            <input type="text" name="price" id="price" placeholder="Enter Price" autocomplete="off">
                        </div>
                        <div class="input-field">
                            <input type="submit" name="submit" id="submit" value="Add NFT">
                        </div>
                    </form>
                    <?php }else {?>
                        <h1>No Collection Available, Add Collection From Dashboard</h1>
                    <?php } ?>
                <a href="dashboard.php"><button class="cancel">Cancel</button></a>
            </div>
        </div>
    </section>
</body>
</html>