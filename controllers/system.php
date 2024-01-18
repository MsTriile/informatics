<?php
// check if user is logged in; if not, send them to the login page
if (!isset($_SESSION['username'])) {
    header("Location: /login");
    exit();
}


$url = parse_url($_SERVER['REQUEST_URI']);
$path = substr($url['path'], strlen('system/'));
$path = $path === '' ? '/dashboard' : $path;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once 'views/templates/head.php' ?>
    <title>IAS | <?php echo substr(strtoupper($path), 1) ?></title>
    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/system.css">
</head>


<body>
    <!-- Navbar -->
    <?php require_once 'views/system/navbar.php'; ?>

    <div class="row h-100" id="mainContainer">

        <!-- Sidebar -->
        <div class="col col-3 h-100 bg-secondary bg-gradient" id="sidebar">
            <?php require_once 'views/system/sidebar.php'; ?>
        </div>

        <!-- main content -->
        <main class="col container-fluid p-3" id="content">
            <?php
            switch ($path) {
                case '/dashboard':
                    require_once 'views/system/dashboard.php';
                    break;
                case '/students':
                    require_once 'views/system/students.php';
                    break;
                default:
                    require_once 'views/system/dashboard.php';
                    break;
            }
            ?>
        </main>
    </div>

    <?php require_once 'views/templates/body_scripts.php' ?>
</body>

</html>