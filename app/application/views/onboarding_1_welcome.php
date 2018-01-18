<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Welcome</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Vendor JS -->
        <script src="../../static/js/jquery.min.js"></script>
        <script src="../../static/js/bootstrap.min.js"></script>

        <!-- App JS -->
        <script src="../../static/js/homepage.js"></script>

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="../../static/css/bootstrap.css">

        <!-- App CSS -->
        <link rel="stylesheet" href="../../static/css/homepage.css" type="text/css">

    </head>

    <body>

        <!-- Webpage -->
        <div id="page">
            <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
                <a class="navbar-brand" href="#">Staff Volunteering Programme</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>

            <h1><br /></h1>

            <div class="container-fluid text-center" id="content">
                <div class="row content">
                    <div class="col-sm-3 sidenav" id="leftSide">
                    </div>

                    <div data-spy="scroll" data-target=".navbar" data-offset="70" class="col-sm-6 text-left" id="centre">

                        <!-- Volunteering Div -->
                        <div style="text-align:center;">
                            <h1>Welcome!</h1>
                            <h6>You are registering as username <?php echo $cis_username ?>.</h6>
                            <p><br />Thank you for signing up to Durham University's Volunteering Project. With this account you can organize and track your volunteering activities.</p>
                            <a href="onboarding_2_enter_details_info.html">
                                <button type="submit" class="btn btn-primary">Continue</button>
                            </a>
                        </div>
                        <!-- End if Volunteering Div -->

                    </div>

                    <div class="col-sm-3 sidenav" id="rightSide">
                    </div>
                </div>
            </div>

            <!-- FOOTER -->
            <h1><br /></h1>

            <div style="background:white">
                <footer class="container text-center">
                    <h4><br /></h4>
                    <h1>We'd love to hear from you</h1>
                    <h4><br /></h4>
                    <p><b>Staff Volunteering & Outreach Team</b></p>
                    <a href="mailto:community.engagement@durham.ac.uk">
                        <img style="margin:20px;" src="../../src/images/mail.png" width="30px">
                    </a>
                    <a href="https://www.facebook.com/SVODurham/">
                        <img style="margin:20px;" src="../../src/images/FB-f-Logo.png" width="30px">
                    </a>
                    <a href="tel:0191 334 2199">
                        <img style="margin:20px;" src="../../src/images/telephone.png" width="30px">
                    </a>
                </footer>

                <footer class="container text-center">
                    <hr>
                    <p><br /><b>design & programming</b><br />software engineering team</p>
                </footer>

            </div>
        </div>
    </body>
</html>