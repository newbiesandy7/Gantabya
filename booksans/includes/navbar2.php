<?php
$currentPage = basename($_SERVER['PHP_SELF']);

// Function to check if a link is active
function isActive($pageName, $currentPage) {
    return ($pageName == $currentPage) ? 'active' : '';
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="images\whitelogo_wt-removebg.png" alt="logo" style=""> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= isActive('index.php', $currentPage) ?>" aria-current="page" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isActive('blog.php', $currentPage) ?>" href="../blog.php">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isActive('all-treks.php', $currentPage) ?>" href="../all-treks.php">Treks</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link <?= isActive('browse.php', $currentPage) ?>" href="browse.php">Hotels</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isActive('contact.php', $currentPage) ?>" href="../contact.php">Contact</a>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <form class="d-flex me-3" role="search" method="GET" action="blog.php">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>

                <?php
                
                if (isset($logged) && $logged) { 
                ?>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?= isActive('../profile.php', $currentPage) ?> <?= isActive('../userprofile.php', $currentPage) ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i> <?= htmlspecialchars($_SESSION['username'] ?? 'Guest') ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="../userprofile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php
                } else {
                ?>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link auth-link <?= isActive('login.php', $currentPage) ?>" href="../login.php">Login | Signup</a>
                        </li>
                    </ul>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</nav>