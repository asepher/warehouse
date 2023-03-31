 <!DOCTYPE html>
<html lang="en"> 
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>SSL :: @yield('title')</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ asset('components/font-awesome/css/font-awesome.css') }}" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="{{ asset('components/_mod/jquery-ui.custom/jquery-ui.custom.css') }}" />
		<link rel="stylesheet" href="{{ asset('components/chosen/chosen.css') }}" />
		<link rel="stylesheet" href="{{ asset('components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}" />
		<link rel="stylesheet" href="{{ asset('components/bootstrap-timepicker/css/bootstrap-timepicker.css') }}" />
		<link rel="stylesheet" href="{{ asset('components/bootstrap-daterangepicker/daterangepicker.css') }}" />
		<link rel="stylesheet" href="{{ asset('components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }}" />
		<link rel="stylesheet" href="{{ asset('components/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css') }}" />

		<!-- text fonts -->
		<link rel="stylesheet" href="{{ asset('assets/css/ace-fonts.css') }}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{ asset('assets/css/ace.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="../assets/css/ace-part2.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="{{ asset('assets/css/ace-skins.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.css') }}" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.css" />
		<![endif]-->

		<!-- inline styles related to this page -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

		<!-- ace settings handler -->
		<script src="{{ asset('assets/js/ace-extra.js') }}"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="../components/html5shiv/dist/html5shiv.min.js"></script>
		<script src="../components/respond/dest/respond.min.js"></script>
		<![endif]-->
			<style>
    .disabled-link{
        cursor: default;
        pointer-events: none;        
        text-decoration: none;
        color: grey;
    }
</style>

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
							<span>Sinergi</span>SuksesLogistik
						</small>
					</a>

					<!-- /section:basics/navbar.layout.brand -->

					<!-- #section:basics/navbar.toggle -->

					<!-- /section:basics/navbar.toggle -->
				</div>

				<!-- #section:basics/navbar.dropdown -->
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						

						<!-- #section:basics/navbar.user_menu -->
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="{{ asset('assets/avatars/avatar2.png') }}" alt="{{ Auth::user()->name }}" />	{{ Auth::user()->name }}
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
									<a href="{{ route('profile.view') }}">
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
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

									
								</li>
							</ul>
						</li>

						<!-- /section:basics/navbar.user_menu -->
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

			<!-- #section:basics/sidebar -->
			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>
				
				@include('layouts.part._sidebar')

				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
			</div>

			<!-- /section:basics/sidebar -->
			<div class="main-content">
				<div class="main-content-inner">
					
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="{{ route('home') }}">Home</a>
							</li>
							<li class="active">
								@yield('breadcrumb')
							</li>
						</ul><!-- /.breadcrumb -->						

						<!-- /section:basics/content.searchbox -->
					</div>



					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
										
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->								

							
								   
                                @yield('content')

							

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
						<span class="bigger-90">
							
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
		<script src="{{asset('components/jquery/dist/jquery.js')}}"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="../components/jquery.1x/dist/jquery.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../components/_mod/jquery.mobile.custom/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="{{ asset('components/bootstrap/dist/js/bootstrap.js') }}"></script>

		<!-- page specific plugin scripts -->
		<script src="{{ asset('components/datatables/media/js/jquery.dataTables.js') }}"></script>
		<script src="{{ asset('components/_mod/datatables/jquery.dataTables.bootstrap.js') }}"></script>
		<script src="{{ asset('components/datatables.net-buttons/js/dataTables.buttons.js') }}"></script>
		<script src="{{ asset('components/datatables.net-buttons/js/buttons.flash.js') }}"></script>
		<script src="{{ asset('components/datatables.net-buttons/js/buttons.html5.js') }}"></script>
		<script src="{{ asset('components/datatables.net-buttons/js/buttons.print.js') }}"></script>
		<script src="{{ asset('components/datatables.net-buttons/js/buttons.colVis.js') }}"></script>
		<script src="{{ asset('components/datatables.net-select/js/dataTables.select.js') }}"></script>
		<script src="{{ asset('components/_mod/jquery-ui.custom/jquery-ui.custom.js') }}"></script>
		<script src="{{ asset('components/jqueryui-touch-punch/jquery.ui.touch-punch.js') }}"></script>
		<script src="{{ asset('components/chosen/chosen.jquery.js') }}"></script>
		<script src="{{ asset('components/fuelux/js/spinbox.js') }}"></script>
		<script src="{{ asset('components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>
		<script src="{{ asset('components/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
		<script src="{{ asset('components/moment/moment.js') }}"></script>
		<script src="{{ asset('components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
		<script src="{{ asset('components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js') }}"></script>
		<script src="{{ asset('components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js') }}"></script>
		<script src="{{ asset('components/jquery-knob/js/jquery.knob.js') }}"></script>
		<script src="{{ asset('components/autosize/dist/autosize.js') }}"></script>
		<script src="{{ asset('components/jquery-inputlimiter/jquery.inputlimiter.js') }}"></script>
		<script src="{{ asset('components/jquery.maskedinput/dist/jquery.maskedinput.js') }}"></script>
		<script src="{{ asset('components/_mod/bootstrap-tag/bootstrap-tag.js') }}"></script>

		<!--[if lte IE 8]>
		  <script src="../components/ExplorerCanvas/excanvas.js"></script>
		<![endif]-->
		<script src="{{asset('components/jqueryui-touch-punch/jquery.ui.touch-punch.js')}}"></script>
		<script src="{{asset('components/_mod/easypiechart/jquery.easypiechart.js')}}"></script>
		<script src="{{asset('components/jquery.sparkline/index.js')}}"></script>
		<script src="{{asset('components/Flot/jquery.flot.js')}}"></script>
		<script src="{{asset('components/Flot/jquery.flot.pie.js')}}"></script>
		<script src="{{asset('components/Flot/jquery.flot.resize.js')}}"></script>

	

		<!-- ace scripts -->
		<script src="{{asset('assets/js/src/elements.scroller.js')}}"></script>
		<script src="{{asset('assets/js/src/elements.colorpicker.js')}}"></script>
		<script src="{{asset('assets/js/src/elements.fileinput.js')}}"></script>
		<script src="{{asset('assets/js/src/elements.typeahead.js')}}"></script>
		<script src="{{asset('assets/js/src/elements.wysiwyg.js')}}"></script>
		<script src="{{asset('assets/js/src/elements.spinner.js')}}"></script>
		<script src="{{asset('assets/js/src/elements.treeview.js')}}"></script>
		<script src="{{asset('assets/js/src/elements.wizard.js')}}"></script>
		<script src="{{asset('assets/js/src/elements.aside.js')}}"></script>
		<script src="{{asset('assets/js/src/ace.js')}}"></script>
		<script src="{{asset('assets/js/src/ace.basics.js')}}"></script>
		<script src="{{asset('assets/js/src/ace.scrolltop.js')}}"></script>
		<script src="{{asset('assets/js/src/ace.ajax-content.js')}}"></script>
		<script src="{{asset('assets/js/src/ace.touch-drag.js')}}"></script>
		<script src="{{asset('assets/js/src/ace.sidebar.js')}}"></script>
		<script src="{{asset('assets/js/src/ace.sidebar-scroll-1.js')}}"></script>
		<script src="{{asset('assets/js/src/ace.submenu-hover.js')}}"></script>
		<script src="{{asset('assets/js/src/ace.widget-box.js')}}"></script>
		<script src="{{asset('assets/js/src/ace.settings.js')}}"></script>
		<script src="{{asset('assets/js/src/ace.settings-rtl.js')}}"></script>
		<script src="{{asset('assets/js/src/ace.settings-skin.js')}}"></script>
		<script src="{{asset('assets/js/src/ace.widget-on-reload.js')}}"></script>
		<script src="{{asset('assets/js/src/ace.searchbox-autocomplete.js')}}"></script>


	    <!-- inline scripts related to this page -->
        <script type="text/javascript">
      jQuery(function($) {
                //initiate dataTables plugin
                var myTable = 
                $('#dynamic-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .DataTable( {
                    bAutoWidth: false,
                   
                    "aaSorting": [],
                    
                    
                    //"bProcessing": true,
                    //"bServerSide": true,
                    //"sAjaxSource": "http://127.0.0.1/table.php"   ,
            
                    //,
                    //"sScrollY": "200px",
                    //"bPaginate": false,
            
                    //"sScrollX": "100%",
                    //"sScrollXInner": "120%",
                    //"bScrollCollapse": true,
                    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                    //you may want to wrap the table inside a "div.dataTables_borderWrap" element
            
                    //"iDisplayLength": 50
            
            
                    select: {
                        style: 'multi'
                    }
                } );
            
                if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
					//resize the chosen on window resize
			
					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					}).trigger('resize.chosen');
					//resize chosen on sidebar collapse/expand
					$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
						if(event_name != 'sidebar_collapsed') return;
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					});
			
			
					$('#chosen-multiple-style .btn').on('click', function(e){
						var target = $(this).find('input[type=radio]');
						var which = parseInt(target.val());
						if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
						 else $('#form-field-select-4').removeClass('tag-input-style');
					});
				}
                
                $.fn.dataTable.Buttons.swfPath = "../components/datatables.net-buttons-swf/index.swf"; //in Ace demo ../components will be replaced by correct assets path
                $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
                
                new $.fn.dataTable.Buttons( myTable, {
                    buttons: [
                      {
                        "extend": "colvis",
                        "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        columns: ':not(:first):not(:last)'
                      },
                      {
                        "extend": "copy",
                        "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                      },
                      {
                        "extend": "csv",
                        "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                      },
                      {
                        "extend": "excel",
                        "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                      },
                      {
                        "extend": "pdf",
                        "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                      },
                      {
                        "extend": "print",
                        "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        autoPrint: false,
                        message: 'This print was produced using the Print button for DataTables'
                      }       
                    ]
                } );
                myTable.buttons().container().appendTo( $('.tableTools-container') );
                
                //style the message box
                var defaultCopyAction = myTable.button(1).action();
                myTable.button(1).action(function (e, dt, button, config) {
                    defaultCopyAction(e, dt, button, config);
                    $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
                });
                
                
                var defaultColvisAction = myTable.button(0).action();
                myTable.button(0).action(function (e, dt, button, config) {
                    
                    defaultColvisAction(e, dt, button, config);
                    
                    
                    if($('.dt-button-collection > .dropdown-menu').length == 0) {
                        $('.dt-button-collection')
                        .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                        .find('a').attr('href', '#').wrap("<li />")
                    }
                    $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
                });
            
                ////
            
                setTimeout(function() {
                    $($('.tableTools-container')).find('a.dt-button').each(function() {
                        var div = $(this).find(' > div').first();
                        if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
                        else $(this).tooltip({container: 'body', title: $(this).text()});
                    });
                }, 500);


                
                
                
                
                
                myTable.on( 'select', function ( e, dt, type, index ) {
                    if ( type === 'row' ) {
                        $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
                    }
                } );
                myTable.on( 'deselect', function ( e, dt, type, index ) {
                    if ( type === 'row' ) {
                        $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
                    }
                } );
            
            
            
            
                /////////////////////////////////
                //table checkboxes
                $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
                
                //select/deselect all rows according to table header checkbox
                $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
                    var th_checked = this.checked;//checkbox inside "TH" table header
                    
                    $('#dynamic-table').find('tbody > tr').each(function(){
                        var row = this;
                        if(th_checked) myTable.row(row).select();
                        else  myTable.row(row).deselect();
                    });
                });
                
                //select/deselect a row when the checkbox is checked/unchecked
                $('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
                    var row = $(this).closest('tr').get(0);
                    if(this.checked) myTable.row(row).deselect();
                    else myTable.row(row).select();
                });
            
            
            
                $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
                    e.stopImmediatePropagation();
                    e.stopPropagation();
                    e.preventDefault();
                });
                
                
                
                //And for the first simple table, which doesn't have TableTools or dataTables
                //select/deselect all rows according to table header checkbox
                var active_class = 'active';
                $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
                    var th_checked = this.checked;//checkbox inside "TH" table header
                    
                    $(this).closest('table').find('tbody > tr').each(function(){
                        var row = this;
                        if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                        else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
                    });
                });
                
                //select/deselect a row when the checkbox is checked/unchecked
                $('#simple-table').on('click', 'td input[type=checkbox]' , function(){
                    var $row = $(this).closest('tr');
                    if($row.is('.detail-row ')) return;
                    if(this.checked) $row.addClass(active_class);
                    else $row.removeClass(active_class);
                });
            
                
            
                /********************************/
                //add tooltip for small view action buttons in dropdown menu
                $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
                
                //tooltip placement on right or left
                function tooltip_placement(context, source) {
                    var $source = $(source);
                    var $parent = $source.closest('table')
                    var off1 = $parent.offset();
                    var w1 = $parent.width();
            
                    var off2 = $source.offset();
                    //var w2 = $source.width();
            
                    if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
                    return 'left';
                }
                
                
                
                
                /***************/
                $('.show-details-btn').on('click', function(e) {
                    e.preventDefault();
                    $(this).closest('tr').next().toggleClass('open');
                    $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
                });
                /***************/


                
                /**
                //add horizontal scrollbars to a simple table
                $('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
                  {
                    horizontal: true,
                    styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
                    size: 2000,
                    mouseWheelLock: true
                  }
                ).css('padding-top', '12px');
                */
             
            //datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
			
				//or change it into a date range picker
				$('.input-daterange').datepicker({autoclose:true});
			
			
				//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
				$('input[name=date-range-picker]').daterangepicker({
					'applyClass' : 'btn-sm btn-success',
					'cancelClass' : 'btn-sm btn-default',
					locale: {
						applyLabel: 'Apply',
						cancelLabel: 'Cancel',
					}
				})
				.prev().on(ace.click_event, function(){
					$(this).next().focus();
				});
			
			
				$('#timepicker1').timepicker({
					minuteStep: 1,
					showSeconds: true,
					showMeridian: false,
					disableFocus: true,
					icons: {
						up: 'fa fa-chevron-up',
						down: 'fa fa-chevron-down'
					}
				}).on('focus', function() {
					$('#timepicker1').timepicker('showWidget');
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
				
			
				
				if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
				 //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
				 icons: {
					time: 'fa fa-clock-o',
					date: 'fa fa-calendar',
					up: 'fa fa-chevron-up',
					down: 'fa fa-chevron-down',
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right',
					today: 'fa fa-arrows ',
					clear: 'fa fa-trash',
					close: 'fa fa-times'
				 }
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
				
				
				$(document).one('ajaxloadstart.page', function(e) {
					autosize.destroy('textarea[class*=autosize]')
					
					$('.limiterBox,.autosizejs').remove();
					$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
				});


            })        	
        </script>

        <!-- the following scripts are used in demo only for onpage help and you don't need them -->
        <link rel="stylesheet" href="{{ asset('assets/css/ace.onpage-help.css') }}" />
        <link rel="stylesheet" href="{{ asset('docs/assets/js/themes/sunburst.css') }}" />

        <script type="text/javascript"> ace.vars['base'] = '..'; </script>
        <script src="{{ asset('assets/js/src/elements.onpage-help.js') }}"></script>
        <script src="{{ asset('assets/js/src/ace.onpage-help.js') }}"></script>
        <script src="{{ asset('docs/assets/js/rainbow.js') }}"></script>
        <script src="{{ asset('docs/assets/js/language/generic.js') }}"></script>
        <script src="{{ asset('docs/assets/js/language/html.js') }}"></script>
        <script src="{{ asset('docs/assets/js/language/css.js') }}"></script>
        <script src="{{ asset('docs/assets/js/language/javascript.js') }}"></script>
         @include('sweet::alert')
	</body>
</html>
