<?php include 'connect.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NFTea - Enjoy Creating and Selling Digital Arts</title>
    <?php include 'styles-links.php'  ?>
</head>
<body>
    <!-- hero -->
    <section class="hero market-hero">
        <!-- header -->
        <header>
            <div class="container">
                <div class="header-wrapper">
                    <div class="logo">
                        <h1><a href="index.php">NF<span>Tea</span></a></h1>
                    </div>
                    <div class="burger-menu">
                        <div class="bar top"></div>
                        <div class="bar middle"></div>
                        <div class="bar bottom"></div>
                    </div>
                    <nav class="navigation-menu">
                        <ul class="nav-links">
                            <li class="nav-link"><a href="index.php">Home</a></li>
                            <li class="nav-link"><a href="market-place.php">MarketPlace</a></li>
                            <!-- <li class="nav-link"><a href="#">About us</a></li>
                            <li class="nav-link"><a href="#">Support</a></li> -->
                        </ul>
                        <a href="dashboard.php"><button class="log-in">Dashboard</button></a>
                    </nav>
                </div>
            </div>
        </header>
        <!-- hero content -->
        <div class="hero-content">
            <div class="container">
                <div class="content-wrapper market-wrapper">
                    <div class="hero-heading">
                        <h1>Explore & Discover Thousands of Incridebale Digital Arts.</h1>
                    </div>
                    <div class="hero-btns">
                        <a href="dashboard.php"><button class="hero-btn">Get Start</button></a>
                        <div class="video-btn">
                            <div class="play-btn"><i class='bx bx-play'></i></div>
                            <p>Learn More?</p>
                        </div>
                    </div>
                    <div class="video">
                        <iframe width="798" height="449" src="https://www.youtube.com/embed/erJUoC-DkZ0" title="YouCode - Votre avenir en numérique" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- popular collections -->
    <section class="popular-collections">
        <div class="container">
            <div class="collections-wrapper">
                <div class="main-heading">
                    <h1>Discover +1000 of Digital Arts</h1>
                    <hr>
                </div>
                <div class="filters">
                    <a href="market-place.php"><div class="filter">
                        <h3>All</h3>
                    </div></a>
                    <?php
                        $select_all_colls = "SELECT collection_id,collection_name FROM `collections`";
                        $select_colls_quered = mysqli_query($connect, $select_all_colls);
                        while($data_fetched = mysqli_fetch_assoc($select_colls_quered)) {
                            echo '
                                <a href="?filterid='. $data_fetched["collection_id"] .'"><div class="filter">
                                    <h3>'. $data_fetched["collection_name"] .'</h3>
                                </div></a>';
                        }
                    ?>
                </div>
                <div class="collections" id="nfts">
                    <?php
                        // $select_nft_artiste = "SELECT collection_artiste FROM `collections`";
                        // $select_artiste_quered = mysqli_query($connect, $select_nft_artiste);
                        // $artistes = mysqli_fetch_assoc($select_artiste_quered);
                        // print_r($artistes);
                        if(isset($_GET["filterid"])) {
                            $filter_id = $_GET["filterid"];
                            $filter_sql = "SELECT * FROM `nfts` WHERE nft_collection_id = $filter_id";
                            $filter_query = mysqli_query($connect, $filter_sql);
                            while($result = mysqli_fetch_assoc($filter_query)) {
                                echo '
                                <div class="collection nft">
                                    <img src="'. $result["nft_image"] .'" alt="nft image" width="100%" height="300px" loading="lazy">
                                    <h3>'. $result["nft_name"] .'</h3>
                                    <p>'./* $artistes["collection_artiste"] .*/'</p>
                                    <p class="price"><b>'. $result["nft_price"] .' ETH</b></p>
                                </div>
                                ';
                            }
                        }else {
                            $select_nfts = "SELECT nft_name, nft_image, nft_price, nft_description FROM `nfts`";
                            $select_nfts_quered = mysqli_query($connect, $select_nfts);
                            while($result = mysqli_fetch_assoc($select_nfts_quered)) {
                                echo '
                                <div class="collection nft">
                                    <img src="'. $result["nft_image"] .'" alt="nft image" width="100%" height="300px" loading="lazy">
                                    <h3>'. $result["nft_name"] .'</h3>
                                    <p>'. $result["nft_description"] .'</p>
                                    <p class="price"><b>'. $result["nft_price"] .' ETH</b></p>
                                </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <div class="news-letter-section">
        <div class="container">
            <div class="news-letter-wrapper">
                <div class="main-heading">
                    <h1>Subscribe to get Latest Updates</h1>
                    <hr>
                </div>
                <p class="news-letter-text">
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae
                </p>
                <?php
                    if(isset($_POST["submit_subscriber"])) {
                        $subscriberEmail = $_POST["email"];
                        $insertEmail = "INSERT INTO `subscribers` (subscriber_email) VALUES ('$subscriberEmail')";
                        mysqli_query($connect, $insertEmail);
                    }
                ?>
                <form method="post">
                    <input type="email" name="email" id="email" placeholder="Enter Your Email" autocomplete="off">
                    <input type="submit" name="submit_subscriber" value="Subscribe">
                </form>
            </div>
        </div>
    </div>
    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-wrapper">
                <div class="info-links">
                    <div class="website-info">
                        <h1 class="footer-logo">NF<span>Tea</span></h1>
                        <p class="website-desc">
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae
                        </p>
                    </div>
                    <div class="website-links links">
                        <h4>Page Links</h4>
                        <ul class="page-links">
                            <li class="page-link"><a href="#">Home</a></li>
                            <li class="page-link"><a href="#">MarketPlace</a></li>
                        </ul>
                    </div>
                    <div class="useful-links links">
                        <h4>Useful Links</h4>
                        <ul class="page-links">
                            <li class="page-link"><a href="#">Home</a></li>
                            <li class="page-link"><a href="#">MarketPlace</a></li>
                        </ul>
                    </div>
                    <div class="contact-info links">
                        <h4>Contact Info</h4>
                        <ul class="page-links">
                            <li class="page-link"><a href="#">info@nftea.com</a></li>
                            <li class="page-link"><a href="#">+1 (234) 9845 342</a></li>
                            <li class="page-link"><a href="#">+1 (983) 4855 239</a></li>
                        </ul>
                    </div>
                </div>
                <div class="copyright-section">
                    <div class="copyright-text">
                        Copyright 2022 - <p>NF<span>Tea</span></p> - All Rights are Reserved
                    </div>
                    <ul class="social-links">
                        <li class="social-link"><a href="#" title="Facebook"><i class='bx bxl-facebook'></i></a></li>
                        <li class="social-link"><a href="#" title="Twitter"><i class='bx bxl-twitter' ></i></a></li>
                        <li class="social-link"><a href="#" title="Dribble"><i class='bx bxl-dribbble' ></i></a></li>
                        <li class="social-link"><a href="#" title="Blog"><i class='bx bxl-blogger' ></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="assets/js/main-script.js"></script>
</body>
</html>