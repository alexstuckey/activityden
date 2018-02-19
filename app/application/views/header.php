<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <?php $this->load->helper('url'); ?>
        
        <!-- Popper JS -->
        <script src="<?php echo base_url('/static/js/popper.min.js'); ?>"></script>
        
        <!-- Vendor JS -->
        <script src="<?php echo base_url('/static/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('/static/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('/static/js/Chart.min.js'); ?>"></script>
        
        <!-- App JS -->
        <script src="<?php echo base_url('/static/js/homepage.js'); ?>"></script>

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="<?php echo base_url('/static/css/bootstrap.css'); ?>">

        <!-- App CSS -->
        <link rel="stylesheet" href="<?php echo base_url('/static/css/homepage.css'); ?>" type="text/css">

    </head>

    <body>
        <!-- Webpage -->
        <div id="page">

            <div id="nav">
                <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
                    <a class="navbar-brand" href="#">Staff Volunteering Programme</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#notifications">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#volunteering">Volunteering</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#managerShiftResponse">Respond to Applications</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#otherSection">Other Section</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
