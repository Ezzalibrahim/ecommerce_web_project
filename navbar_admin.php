<nav class="navbar navbar-expand navbar-expand-lg justify-content-between navbar-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand brand-name " href="index.php"><strong>E-Agadir</strong></a>

    <div class="mr-1 navbar-right">
        <ul class="navbar-nav ml-auto mt-2 mt-lg-0  ">
            <li class="nav-item mr-3">
                <a href="./sign.html" class=" ">
                    <button class="btn btn-primary "><img src="../font_svg/user.svg" alt="" width="28px" height="24px">
                        <?php
                        session_start();
                        if (isset($_SESSION['name'])) echo $_SESSION['name']; ?></button>
                </a>
            </li>
            <li class="nav-item">
                <button class="btn btn-outline-primary ">
                    <a href="index.php?logout=yes"><img src="../font_svg/sign up.svg" alt="" width="28px" height="24px">
                        LogOut </a></button>
            </li>

        </ul>
    </div>
</nav>
<?php
if (isset($_GET['logout'])) {
    session_start();
    unset($_SESSION['name']);
}
?>