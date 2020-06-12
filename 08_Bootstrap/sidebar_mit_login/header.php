<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <span>
            <a href="#" class="nav-item btn btn-dark" id="menu-toggle"><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-right"></i> </a>
        </span>
        <div class="col justify-content-start">
            <a class="navbar-brand" href="#"> Navbar</a>
        </div>
        <button class="navbar-toggler btn btn-dark" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <!-- <li class="nav-item active">
                    <a href="#" class="btn btn-dark" id="menu-toggle"><i class="fa fa-bars"></i></a>
                </li> -->
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="#">Action 1</a>
                        <a class="dropdown-item" href="#">Action 2</a>
                    </div>
                </li>
            </ul>
            <?php  
            if (isset($_SESSION['username'])) : 
                echo"<a class='btn btn-dark' type='button' href='inc/logout.php'>Logout</a>";
            endif;
            if (!isset($_SESSION['username'])) :
            echo "<a class='btn btn-dark' type='button' href='inc/login.php'>Login</a>";
            endif ?>
        </div>
    </nav>