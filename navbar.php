<?php
if (!isset($_SESSION['name'])) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-light justify-content-between" style="background-color: #e3f2fd;">
    <a class="navbar-brand brand-name" href="index.php">E-Agadir</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Category
                </a>
                <form action="">
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="all_products.php?categorie=wearable tech">Wearable Tech </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="all_products.php?categorie=camera">Camera</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="all_products.php?categorie=headphone">HeadPhone</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="all_products.php?categorie=cell phone">Cell Phone </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="all_products.php?categorie=computers">Computers</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="all_products.php?categorie=tablet">Tablet</a>
                    </div>
                </form>
            </li>
        </ul>
        <form class="search form-inline my-2 my-lg-0 ">
            <!--  -->
            <input class="form-control mr-sm-2" name="searchitem" placeholder="Search">
            <input href="all_products.php?search=<?php echo isset($_GET['searchitem']) ? $_GET['searchitem'] : ''; ?>" class="form-control btn btn-outline-success my-2 my-sm-0" type="submit" value="Search">
        </form>


        <div class="mr-1 navbar-right">
            <ul class="nav navbar-nav ml-auto sign">
                <li class="nav-item mr-2">
                    <a href="cart.php">
                        <img src="./font_svg/commerce.png" class="add_to_cart">
                        <b><span class="item_counter badge-danger">0</span></b>
                    </a>
                </li>

                <li class="nav-item mr-2">
                    <?php
                    if (isset($_SESSION['name'])) :
                    ?>
                        <a href="#" class="glyphicon glyphicon-log-in">
                            <button class="btn btn-primary "><img src="./font_svg/user.svg" alt="" width="28px" height="24px"> <?php echo $_SESSION['name']; ?></button>
                        </a>
                    <?php
                    else :
                    ?>
                        <a href="./login.php" class="glyphicon glyphicon-log-in">
                            <button class="btn btn-primary "><img src="./font_svg/user.svg" alt="" width="28px" height="24px"> <?php echo  'Sign In'; ?></button>
                        </a>
                    <?php
                    endif;
                    ?>
                </li>
                <li class="nav-item mr-2">
                    <?php
                    if (isset($_SESSION['name'])) :
                    ?>
                        <a href="./login.php?logout=true" class="glyphicon glyphicon-log-in">
                            <button class="btn btn-primary "><img src="./font_svg/sign up.svg" alt="" width="28px" height="24px"> <?php echo 'Logout'; ?></button>
                        </a>
                    <?php
                    else :
                    ?>
                        <a href="./register.php" class="glyphicon glyphicon-log-in">
                            <button class="btn btn-primary "><img src="./font_svg/sign up.svg" alt="" width="28px" height="24px"> <?php echo  'Sign Up'; ?></button>
                        </a>
                    <?php
                    endif;
                    ?>

                </li>
            </ul>
        </div>
    </div>
</nav>