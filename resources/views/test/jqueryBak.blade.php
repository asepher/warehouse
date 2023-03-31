<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Aplikasi Login SSL</title>

        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" />
        <link rel="stylesheet" href="{{ asset('components/font-awesome/css/font-awesome.css') }}" />

        <!-- page specific plugin styles -->

        <!-- text fonts -->
        <link rel="stylesheet" href="{{ asset('assets/css/ace-fonts.css') }}" />

        <!-- ace styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/ace.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

        <!--[if lte IE 9]>
            <link rel="stylesheet" href="{{ asset('assets/css/ace-part2.css') }}" class="ace-main-stylesheet" />
        <![endif]-->
        <link rel="stylesheet" href="{{ asset('assets/css/ace-skins.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.css') }}" />

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="../assets/css/ace-ie.css" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->
        <script src="{{ asset('assets/js/ace-extra.js') }}"></script>

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
        <script src="../components/html5shiv/dist/html5shiv.min.js"></script>
        <script src="../components/respond/dest/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="no-skin">
        <!-- #section:basics/navbar.layout -->
        <div id="navbar" class="navbar navbar-default          ace-save-state">
            <div class="navbar-container ace-save-state" id="navbar-container">
                <!-- #section:basics/sidebar.mobile.toggle -->
                <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                    <span class="sr-only">Toggle sidebar</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>
                </button>

                <!-- /section:basics/sidebar.mobile.toggle -->
                <div class="navbar-header pull-left">
                    <!-- #section:basics/navbar.layout.brand -->
                    <a href="#" class="navbar-brand">
                        <small>                          
                            SinergiSuksesLogistik
                        </small>
                    </a>

                    <!-- /section:basics/navbar.layout.brand -->

                    <!-- #section:basics/navbar.toggle -->

                    <!-- /section:basics/navbar.toggle -->
                </div>

                <!-- #section:basics/navbar.dropdown -->
                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">


                        @guest



                                @if (Route::has('login'))

                                    <li class="light-blue dropdown-modal">
                                        <a href="{{ route('login') }}">
                                            {{ __('Login') }}
                                        </a>
                                    </li>  
                                 
                                @endif

                                @if (Route::has('register'))    
                                    <li class="light-blue dropdown-modal">
                                        <a  href="{{ route('register') }}">
                                            {{ __('Register') }}
                                        </a>
                                    </li> 

                                 
                                @endif


                        @else




                                <!-- #section:basics/navbar.user_menu -->
                                <li class="light-blue dropdown-modal">
                                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                        <img class="nav-user-photo" src="../assets/avatars/user.jpg" alt="Jason's Photo" />
                                        {{ Auth::user()->name }}
                                        <i class="ace-icon fa fa-caret-down"></i>
                                    </a>

                                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                        <li>
                                            <a href="#">
                                                <i class="ace-icon fa fa-cog"></i>
                                                Settings
                                            </a>
                                        </li>

                                        <li>
                                            <a href="profile.html">
                                                <i class="ace-icon fa fa-user"></i>
                                                Profile
                                            </a>
                                        </li>

                                        <li class="divider"></li>

                                        <li>
                                            <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                <i class="ace-icon fa fa-power-off"></i>
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                <!-- /section:basics/navbar.user_menu -->
                                





                        @endguest




                    </ul>
                </div>

                <!-- /section:basics/navbar.dropdown -->
            </div><!-- /.navbar-container -->
        </div>

        <!-- /section:basics/navbar.layout -->
        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try{ace.settings.loadState('main-container')}catch(e){}
            </script>

         
            <!-- /section:basics/sidebar -->
            <div class="main-content">
                <div class="main-content-inner">
                    <!-- #section:basics/content.breadcrumbs -->
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home home-icon"></i>
                                <a href="#">Home</a>
                            </li>

                            <li>
                                <a href="#">Login Page</a>
                            </li>
                         
                        </ul><!-- /.breadcrumb -->

                    

                        <!-- /section:basics/content.searchbox -->
                    </div>

                    <!-- /section:basics/content.breadcrumbs -->
                    <div class="page-content">
                       
                        <!-- /section:settings.box -->
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->              
                                
                               


        <div class="p-2 flex-shrink-0 bd-highlight">
            <button class="btn btn-success" id="btn-add">
                Add Todo
            </button>
        </div>




                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.page-content -->
                </div>
            </div><!-- /.main-content -->

            <div class="footer">
                <div class="footer-inner">
                    <!-- #section:basics/footer -->
                    <div class="footer-content">
                        <span class="bigger-100">                        
                            sinergisukseslogistik &copy; 2022
                        </span>

                        &nbsp; &nbsp;
                        
                    </div>

                    <!-- /section:basics/footer -->
                </div>
            </div>

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script src="{{ asset('components/jquery/dist/jquery.js') }}"></script>

        <!-- <![endif]-->

        <!--[if IE]>
<script src="../components/jquery.1x/dist/jquery.js"></script>
<![endif]-->
        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='../components/_mod/jquery.mobile.custom/jquery.mobile.custom.js'>"+"<"+"/script>");
        </script>
        <script src="{{ asset('components/bootstrap/dist/js/bootstrap.js') }}"></script>

        <!-- page specific plugin scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

        <!-- ace scripts -->
        <script src="{{ asset('assets/js/src/elements.scroller.js') }}"></script>
        <script src="{{ asset('assets/js/src/elements.colorpicker.js') }}"></script>
        <script src="{{ asset('assets/js/src/elements.fileinput.js') }}"></script>
        <script src="{{ asset('assets/js/src/elements.typeahead.js') }}"></script>
        <script src="{{ asset('assets/js/src/elements.wysiwyg.js') }}"></script>
        <script src="{{ asset('assets/js/src/elements.spinner.js') }}"></script>
        <script src="{{ asset('assets/js/src/elements.treeview.js') }}"></script>
        <script src="{{ asset('assets/js/src/elements.wizard.js') }}"></script>
        <script src="{{ asset('assets/js/src/elements.aside.js') }}"></script>
        <script src="{{ asset('assets/js/src/ace.js') }}"></script>
        <script src="{{ asset('assets/js/src/ace.basics.js') }}"></script>
        <script src="{{ asset('assets/js/src/ace.scrolltop.js') }}"></script>
        <script src="{{ asset('assets/js/src/ace.ajax-content.js') }}"></script>
        <script src="{{ asset('assets/js/src/ace.touch-drag.js') }}"></script>
        <script src="{{ asset('assets/js/src/ace.sidebar.js') }}"></script>
        <script src="{{ asset('assets/js/src/ace.sidebar-scroll-1.js') }}"></script>
        <script src="{{ asset('assets/js/src/ace.submenu-hover.js') }}"></script>
        <script src="{{ asset('assets/js/src/ace.widget-box.js') }}"></script>
        <script src="{{ asset('assets/js/src/ace.settings.js') }}"></script>
        <script src="{{ asset('assets/js/src/ace.settings-rtl.js') }}"></script>
        <script src="{{ asset('assets/js/src/ace.settings-skin.js') }}"></script>
        <script src="{{ asset('assets/js/src/ace.widget-on-reload.js') }}"></script>
        <script src="{{ asset('assets/js/src/ace.searchbox-autocomplete.js') }}"></script>



<script>
    
    jQuery(document).ready(function($){
    //----- Open model CREATE -----//
    jQuery('#btn-add').click(function () {
        alert('hello add ');
    
    });
   
});
</script>

    </body>
</html>
