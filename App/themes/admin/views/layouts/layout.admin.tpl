<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{base_url()}">
    <meta charset="utf-8">
    <title>Banlytics</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Precise analytics for artists and record labels">

    {css('utopia-white.css')}
    {css('utopia-responsive.css')}
    {css('validationEngine.jquery.css')}

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    {js('jquery.min.js')}
    {js('jquery.cookie.js')}

</head>

<body>

<div class="container-fluid">

    <section>
        {block name=header}
            <div class="row-fluid">
                <div class="span12">
                    <div class="header-wrapper">

                        <a href="/" class="utopia-logo">{img file="logo.png" alt="Bandlytics"}</a>

                        <div class="header-right">
                            <div class="header-divider">&nbsp;</div>

                            <div class="search-panel header-divider">
                                <div class="search-box">
                                    {img file="icons/zoom.png" alt="Search"}
                                    <form action="" method="post">
                                        <input type="text" name="search" placeholder="search"/>
                                    </form>
                                </div>
                            </div>


                            <div class="notification header-divider">

                                <div class="notification-wrapper">

                                    <a href="#" class="notification-counter">8</a>
                                    <div id="triangle-down"></div>

                                    <div class="tabbable notification-box">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#message">Messages (3)</a></li>
                                            <li class=""><a data-toggle="tab" href="#activity">Activity (5)</a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <div id="message" class="tab-pane active">
                                                <ul class="message-list">
                                                    <li class="message new">
                                                        <div class="msg">
                                                            From: <a href="">Benjamiin Buttons</a> <span>40m ago</span>
                                                            <a class="subject" href="">Getting Started on Starlight Template</a>
                                                            <p>Vitae dicta sunt explicabo. Nemo enim</p>
                                                        </div>
                                                    </li>
                                                    <li class="message new">
                                                        <div class="msg">
                                                            From: <a href="">ThemePixels Team</a> <span>2 hours ago</span>
                                                            <a class="subject" href="">Thank you for using StarLight Template</a>
                                                            <p>Hi,Eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                        </div>
                                                    </li>
                                                    <li class="message">
                                                        <div class="msg">
                                                            From: <a href="">Katherine Kate</a> <span>40m ago</span>
                                                            <p>Lorem ipsum dolor sit amet...</p>
                                                        </div>
                                                    </li>
                                                    <li class="message">
                                                        <div class="msg">
                                                            From: <a href="">ThemePixels Team</a> <span>Yesterday</span>
                                                            <a class="subject" href="">Events for the next month</a>
                                                            <p>Hi,Eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                        </div>
                                                    </li>
                                                </ul>

                                                <div class="message-more"><a href="">See All Messages</a></div>

                                            </div>

                                            <div id="activity" class="tab-pane">
                                                <ul class="message-list">
                                                    <li class="user new">
                                                        <div class="msg">
                                                            <a href="">Justin Meller</a> added <a href="">John Doe</a> as Admin.
                                                        </div>
                                                    </li>
                                                    <li class="call new">
                                                        <div class="msg">
                                                            You missed a call from <a href="">Porfirio</a>
                                                        </div>
                                                    </li>
                                                    <li class="calendar new">
                                                        <div class="msg">
                                                            <a href="">Katherine Kate</a> invited you in an event <a href="">Rock Party</a>.
                                                        </div>
                                                    </li>
                                                    <li class="settings">
                                                        <div class="msg">
                                                            <a href="">Jane Doe</a> updated her profile.
                                                        </div>
                                                    </li>
                                                    <li class="follow">
                                                        <div class="msg">
                                                            <a href="">Jet Lee</a> is now following you.
                                                        </div>
                                                    </li>
                                                </ul>

                                                <div class="message-more"><a href="">View All Activities</a></div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div><!-- Notification end -->


                            <div class="user-panel header-divider">
                                <div class="user-info">
                                    {img file="icons/user.png" alt="user"}
                                    <a href="#">Admin user</a>
                                </div>

                                <div class="user-dropbox">
                                    <ul>
                                        <li class="user"><a href="">Profile</a></li>
                                        <li class="settings"><a href="">Account Settings</a></li>
                                        <li class="logout"><a href="index.html">Logout</a></li>
                                    </ul>
                                </div>

                            </div><!-- User panel end -->
                        </div>

                    </div>
                </div>
            </div>
        {/block}
    </section>

    <section>
        
        <div class="row-fluid">
            <section>
                <div class="span2 sidebar-container">
                    <div class="sidebar">

                        <div class="navbar sidebar-toggle">
                            <div class="container">

                                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </a>

                            </div>
                        </div>

                <div class="nav-collapse collapse leftmenu">

                    <ul>
                        <li class="current"><a class="dashboard smronju" href="dashboard" title="Dashboard"><span>Dashboard</span></a></li>
                        <li><a class="list" href="javascript:void(0)" title="Tables"><span>Yards</span></a>
                            <ul class="dropdown">
                                <li><a class="tables" href="admin/yards" title="Yards"><span>View Yard Listings</span></a>
                                <li><a class="widgets smronju" href="admin/yards/add" title="Add Yard Listing"><span>Add Yard Listing</span></a></li>
                            </ul>
                        </li>
                        <li><a class="tables" href="typography.html" title="Typography"><span>Typography</span></a></li>
                        <li><a class="elements" href="maps.html" title="Maps"><span>Maps</span></a></li>
                        <li><a class="charts" href="charts.html" title="Graphs &amp; Charts"><span>Charts</span></a></li>
                        <li><a class="barcode" href="barcode.html" title="Barcode"><span>Barcode</span></a></li>
                        <li><a class="editor" href="javascript:void(0)" title="Forms"><span>Forms</span></a>
                            <ul class="dropdown">
                                <li><a class="simple smronju" href="forms.html" title="Form Elements"><span>Form Element</span></a></li>
                                <li><a class="wizard-form smronju" href="wizard_form.html" title="Wizard Form"><span>Wizard Form</span></a></li>
                            </ul>
                        </li>
                        <li><a class="gallery" href="javascript:void(0)" title="Galleries"><span>Galleries</span></a>
                            <ul class="dropdown">
                                <li><a class="fluidgallery" href="fluid_galleries.html" title="Fluid Gallery"><span>Fluid Gallery</span></a></li>
                                <li><a class="slidergallery" href="mixed_galleries.html" title="Mixed Gallery"><span>Mixed Gallery</span></a></li>
                                <li><a class="videogallery" href="video_galleries.html" title="Video Gallery"><span>Video Gallery</span></a></li>
                            </ul>
                        </li>
                        <li><a class="grid" href="grid.html" title="Grid"><span>Grid</span></a></li>
                        <li><a class="calendar" href="calendar.html" title="Calendar"><span>Calendar</span></a></li>
                        <li><a class="icons" href="icons.html" title="Icons"><span> Icons</span></a></li>
                        <li><a class="chat" href="conversation.html" title="Conversation"><span>Conversation</span></a></li>
                        <li><a class="error" href="error.html" title="Error Page"><span>Error Page</span></a></li>
                    </ul>

                </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="span10">
                    {block name=content}
                    <!-- Content -->
                    {/block}
                </div>
            </section>
        </div>
        
    </section>

</div>

{js('utopia.js')}
{js('jquery.hoverIntent.min.js')}
{js('jquery.easing.1.3.js')}
{js('jquery.datatable.js')}
{js('tables.js')}
{js('jquery.sparkline.js')}
{js('jquery.vticker-min.js')}
{js('ui/datepicker.js')}
{js('jquery.validationEngine.js')}
{js('jquery.validationEngine-en.js')}
{js('maskedinput.js')}
{js('chosen.jquery.js')}
{js('header.js?v1')}
{js('sidebar.js?')}

{literal}
<script type="text/javascript">
    jQuery(function(){
        jQuery(".utopia").validationEngine('attach', {promptPosition : "topLeft", scroll: false});
    })
</script>

<script type="text/javascript">
    $(function() {

        $( "#utopia-dashboard-datepicker" ).datepicker().css({marginBottom:'20px'});

        jQuery("#validation").validationEngine();
        $("#phone").mask("(999) 9999999999");
        $(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true});
        
    });

</script>
{/literal}

</body>
</html>
