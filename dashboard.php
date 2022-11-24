<?php include 'connect.php' ?>
<?php 
    $select_collections = "SELECT * FROM `collections`";
    $select_collections_quered = mysqli_query($connect, $select_collections);
    $select_nfts = "SELECT * FROM `nfts`";
    $select_nfts_quered = mysqli_query($connect, $select_nfts);
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
                <!-- <a href="add-nft.php"><button class="add-nft dash-btn">Add NFT</button></a> -->
                <a href="add-collection.php"><button class="add-nft dash-btn">Add Collection</button></a>
                <a href="index.php"><button class="add-collection dash-btn"><i class='bx bxs-home-alt-2'></i> Back to Home</button></a>
            </div>
            <div class="statistique">
                <!-- box -->
                <div class="statique-box">
                    <h1>Total NFTS</h1>
                    <div class="box">
                        <i class="bx bxs-component"></i>
                        <p><?php echo mysqli_num_rows($select_nfts_quered)?></p>
                    </div>
                </div>
                <!-- box -->
                <div class="statique-box">
                    <h1>Total Collection</h1>
                    <div class="box">
                        <i class="bx bxs-chart"></i>
                        <p><?php echo mysqli_num_rows($select_collections_quered)?></p>
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
                <h1>Collections Dashboard</h1>
            </div>
            <div class="display-table">
                <?php
                    if(isset($_GET["deleteid"])) {
                        $collection_id = $_GET["deleteid"];
                        $delete_requet = "DELETE FROM `collections` WHERE collection_id = $collection_id";
                        mysqli_query($connect, $delete_requet);
                    }


                    $sql = "SELECT * FROM `collections`";
                    $sql_quered = mysqli_query($connect, $sql);
                    while($result = mysqli_fetch_assoc($sql_quered)) {
                        echo '
                        <div class="collection nft">
                            <img src="'. $result["collection_image"] .'" alt="nft image" width="100%" height="300px" loading="lazy">
                            <h3>'. $result["collection_name"] .'</h3>
                            <p>'. $result["collection_artiste"] .'</p>
                            <div class="operation-td">
                                <a href="collection-nfts.php?collectionid='. $result["collection_id"] .'" class="view"><i class="bx bxs-show"></i>View</a>
                                <a href="update-collection.php?updateid='. $result["collection_id"] .'" class="update"><i class="bx bxs-edit"></i>Update</a>
                                <a href="?deleteid='. $result["collection_id"] .'" class="delete"><i class="bx bxs-eraser"></i>Delete</a>
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