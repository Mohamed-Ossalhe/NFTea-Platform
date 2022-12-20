<?php include 'connect.php' ?>
<?php
    if(isset($_GET["collectionid"])) {
        $collection_id = $_GET["collectionid"];
        $select_collection_artistes = "SELECT collection_artiste FROM `collections` WHERE collection_id = $collection_id";
        $select_artistes_query = mysqli_query($connect, $select_collection_artistes);
        $select_collection_quered = mysqli_fetch_assoc($select_artistes_query);
        $select_collection_nfts = "SELECT * FROM `nfts` WHERE nft_collection_id = $collection_id";
        $select_nfts_quered = mysqli_query($connect, $select_collection_nfts);
    }

    if(isset($_GET["deleteid"])) {
        $nft_id = $_GET["deleteid"];
        $delete_requet = "DELETE FROM `nfts` WHERE nft_id = $nft_id";
        if(mysqli_query($connect, $delete_requet)) {
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
    <title>NFTea - Admin Dashboard</title>
    <?php include 'styles-links.php'  ?>
</head>
<body>
    <div class="dashboard">
        <div class="container">
            <div class="dashboard-btns">
                <a href="add-nft.php"><button class="add-nft dash-btn">Add NFT</button></a>
                <a href="dashboard.php"><button class="add-collection dash-btn">Back <i class='bx bx-chevron-right'></i></button></a>
            </div>
            <div class="statistique">
                <!-- box -->
                <div class="statique-box">
                    <h1>Total Collection NFTS</h1>
                    <div class="box">
                        <i class="bx bxs-component"></i>
                        <p><?php echo mysqli_num_rows($select_nfts_quered);?></p>
                    </div>
                </div>
                <!-- box -->
                <div class="statique-box">
                    <h1>Total Collection</h1>
                    <div class="box">
                        <i class="bx bxs-chart"></i>
                        <p><?php echo mysqli_num_rows($select_artistes_query) ?></p>
                    </div>
                </div>
                <!-- box -->
                <div class="statique-box">
                    <h1>NFT la plus cher</h1>
                    <div class="box">
                        <i class="bx bxs-chart"></i>
                        <p>
                            <?php
                                $max_price = "SELECT nft_name FROM `nfts` ORDER BY nft_price DESC";
                                $max_price_quered = mysqli_query($connect, $max_price);
                                $result = mysqli_fetch_assoc($max_price_quered);
                                if(mysqli_num_rows($max_price_quered) !== 0) {
                                    echo $result["nft_name"];
                                }else {
                                    echo 'No NFT';
                                }
                            ?>
                        </p>
                    </div>
                </div>
                <!-- box -->
                <div class="statique-box">
                    <h1>NFT la moin cher</h1>
                    <div class="box">
                        <i class="bx bxs-chart"></i>
                        <p>
                            <?php
                                $min_price = "SELECT nft_name FROM `nfts` ORDER BY nft_price ASC";
                                $min_price_quered = mysqli_query($connect, $min_price);
                                $result = mysqli_fetch_assoc($min_price_quered);
                                if(mysqli_num_rows($min_price_quered) !== 0) {
                                    echo $result["nft_name"];
                                }else {
                                    echo 'No NFT';
                                }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="main-heading">
                <h1>COLLECTION</h1>
            </div>
            <div class="display-table">
                
                    
                    <?php

                    while($result = mysqli_fetch_assoc($select_nfts_quered)) {
                        echo '
                        <div class="collection nft">
                            <img src="'. $result["nft_image"] .'" alt="nft image" width="100%" height="300px" loading="lazy">
                            <h3>'. $result["nft_name"] .'</h3>
                            <p>'. $select_collection_quered["collection_artiste"] .'</p>
                            <p class="price">'. $result["nft_price"] .' ETH</p>
                            <div class="operation-td">
                                <a href="update-nft.php?updateid='. $result["nft_id"] .'" class="update"><i class="bx bxs-edit"></i>Update</a>
                                <a href="?deleteid='. $result["nft_id"] .'" class="delete"><i class="bx bxs-eraser"></i>Delete</a>
                            </div>
                        </div>
                        ';
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>