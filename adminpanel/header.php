<?php

require_once "admin_crud.php";
$classobj = new Admincrud();
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['login']) == true) {
    header("Location:../index.php");
}


$orderCount =  $classobj->newOrderCount();

/*
  Call Enquiry Request table to fetch new message added into the database 
*/
$enquiryRequestCount =  $classobj->newEnquiryRequestCount();
?>

<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <script src="https://kit.fontawesome.com/e0a2479f2e.js" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">



    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,0,0" />



    <link rel="stylesheet" href="header.css">

    <style>



    </style>

    <title>Admin page</title>

</head>



<body>

    <div class="navbar container-fluid sticky-top">
        <span class="menu"><i class="fas fa-bars"></i></span>
        <img src="./assets/starlingbags.svg" alt="" width="100%" style="max-width: 150px;">
        <span class="settings"><i class="fa-solid fa-gear"></i></span>
    </div>

    <div class="settings-block card">
        <div class="card-body d-flex flex-column  text-center ">
            <div class=" option change-password m-2 d-flex">
                <a href="./changepassword" class="d-flex" style="text-decoration: none;">
                    <span class="w-100 align-self-center change-password-text ">Change Password </span>
                    <span class="settings-block-icon  flex-shrink-1"><i class="fa-solid fa-key"></i></span>
                </a>
            </div>
            <div class=" option logout-option m-2 ">
                <a href="./contactDetails" class="d-flex">
                    <span class="w-100 align-self-center logout-option-text">Contact Details </span>
                    <span class="settings-block-icon flex-shrink-1"> <i class="fa-regular fa-pen-to-square"></i></span>
                </a>
            </div>
            <div class=" option logout-option m-2 ">
                <a href="adminlogout" class="d-flex">
                    <span class="w-100 align-self-center logout-option-text">logout </span>
                    <span class="settings-block-icon flex-shrink-1"> <i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                </a>
            </div>
        </div>
    </div>
    <nav class="sidebar">
        <header>
            <span class="menu"><i class="fas fa-bars" id="header-menu"></i></span>
        </header>
        <hr>

        <div class="menu-bar">
            <div class="menu-links">
                <ul>
                    
                    <li>
                        <a href="dashboard" class="menu-link">
                            <div class="sidebar-menu-li">
                                <i id="menu-icon" class="fa-solid fa-gauge"></i>
                                <span class="menu-link-name">Dashboard</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <?php
                        /*
                          Bof - Adding Enquiry notification count
                        */
                            $enquiryCount = $enquiryRequestCount[0]["count(id)"];
                            if ($enquiryCount) {
                                
                                echo '<div id="noti">' . $enquiryCount . '</div>';
                            }
                        /*
                          Eof - Enquiry notification count
                        */
                        ?>
                        <a href="inbox" class="menu-link">
                            <div class="sidebar-menu-li">
                                <i id="menu-icon" class="fa-solid fa-gauge"></i>
                                <span class="menu-link-name">Inbox</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <?php
                        if ($orderCount) {                           
                            $orders =  count($orderCount);
                            echo '<div id="noti">' . $orders . '</div>';
                        }
                        ?>
                        <a href="order" class="menu-link">
                            <div class="sidebar-menu-li">
                                <i id="menu-icon" class='fas fa-address-card'></i>
                                <span class="menu-link-name">Orders</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="home" class="menu-link">
                            <div class="sidebar-menu-li">
                                <i id="menu-icon" class="fa-solid fa-house"></i>
                                <span class="menu-link-name">Categories</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="shop" class="menu-link">
                            <div class="sidebar-menu-li">
                                <i id="menu-icon" class="fa-solid fa-bag-shopping"></i>
                                <span class="menu-link-name">Shop</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="choosequot" class="menu-link customQotePages">
                            <div class="sidebar-menu-li">
                                <i id="menu-icon" class="Quote-icon"><span class="material-symbols-outlined">description</span></i>
                                <span class="menu-link-name Quote-text">Quote</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</body>

<script type="text/javascript">
    const menu = document.querySelectorAll('.menu')
    const headermenu = document.querySelector('#header-menu')
    const toggle = document.querySelector('.toggle')
    const sidebar = document.querySelector('.sidebar')
    const sidebarmenuli = document.querySelectorAll('.sidebar-menu-li')
    const menulinkname = document.querySelectorAll('.menu-link-name')
    const menulink = document.querySelectorAll('.menu-link')
    const toggleleft = document.querySelector('.toggle-left')
    const toggleright = document.querySelector('.toggle-right')
    const menuicon = document.querySelectorAll('#menu-icon')
    const settings = document.querySelector('.settings')
    let settingsblock = document.querySelector('.settings-block')

    settings.onclick = function() {
        settingsblock.classList.toggle('active')
    }

    window.onclick = function(event) {
        if (!event.target.matches(".fa-gear")) {
            settingsblock.classList.remove('active')
        }

        if (!event.target.matches('.fa-bars')) {
            sidebar.classList.remove('active')

            for (let i = 0; i < menulinkname.length; i++) {
                menulinkname[i].classList.remove('active')
            }

            for (let i = 0; i < menuicon.length; i++) {
                menuicon[i].classList.remove('active')
            }

            for (let i = 0; i < sidebarmenuli.length; i++) {
                sidebarmenuli[i].classList.remove('active')
            }
        }
    }

    for (let i = 0; i < menu.length; i++) {

        menu[i].addEventListener("click", function() {
            sidebar.classList.toggle('active')
            for (let i = 0; i < menulinkname.length; i++) {
                menulinkname[i].classList.toggle('active')
            }
            for (let i = 0; i < menuicon.length; i++) {
                menuicon[i].classList.toggle('active')
            }

            for (let i = 0; i < sidebarmenuli.length; i++) {
                sidebarmenuli[i].classList.toggle('active')
            }
        })



    }

    // var x = window.matchMedia("(max-width: 700px)")

    // window.onscroll = function() {

    //     if (x.matches) {

    //         if (window.scrollY >= 1) {

    //             headermenu.classList.add('active');

    //         }



    //     }



    // }





    // toggleleft.addEventListener("click", function () {





    //     sidebar.style.width = "100px";



    //     toggleleft.style.display = "none";

    //     for (let i = 0; i < menulinkname.length; i++) {



    //         menulinkname[i].classList.add('active')



    //     }

    //     for (let i = 0; i < menulink.length; i++) {



    //         menulink[i].classList.add('active')



    //     }

    //     for (let i = 0; i < menuicon.length; i++) {



    //         menuicon[i].style.fontSize = "25px"



    //     }





    // })



    // toggleright.addEventListener("click", function () {

    //     sidebar.style.width = "250px";

    //     toggleleft.style.display = "flex";

    //     for (let i = 0; i < menulinkname.length; i++) {



    //         menulinkname[i].classList.remove('active')

    //     }

    //     for (let i = 0; i < menulink.length; i++) {



    //         menulink[i].classList.remove('active')



    //     }

    //     for (let i = 0; i < menuicon.length; i++) {



    //         menuicon[i].style.fontSize = "20px"



    //     }

    // })
</script>



</html>