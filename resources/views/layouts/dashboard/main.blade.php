@include('layouts/dashboard/head')
<body class="full_width">
<div class='notifications top-right'></div>
<div class="style_switcher">
    <div class="sepH_c">
        <p>Colors:</p>
        <div class="clearfix">
            <a href="javascript:void(0)" class="style_item jQclr blue_theme style_active" title="blue">blue</a>
            <a href="javascript:void(0)" class="style_item jQclr dark_theme" title="dark">dark</a>
            <a href="javascript:void(0)" class="style_item jQclr green_theme" title="green">green</a>
            <a href="javascript:void(0)" class="style_item jQclr brown_theme" title="brown">brown</a>
            <a href="javascript:void(0)" class="style_item jQclr eastern_blue_theme" title="eastern_blue">eastern blue</a>
            <a href="javascript:void(0)" class="style_item jQclr tamarillo_theme" title="tamarillo">tamarillo</a>
        </div>
    </div>
    <div class="sepH_c">
        <p>Backgrounds:</p>
        <div class="clearfix">
            <span class="style_item jQptrn style_active ptrn_def" title=""></span>
            <span class="ssw_ptrn_a style_item jQptrn" title="ptrn_a"></span>
            <span class="ssw_ptrn_b style_item jQptrn" title="ptrn_b"></span>
            <span class="ssw_ptrn_c style_item jQptrn" title="ptrn_c"></span>
            <span class="ssw_ptrn_d style_item jQptrn" title="ptrn_d"></span>
            <span class="ssw_ptrn_e style_item jQptrn" title="ptrn_e"></span>
        </div>
    </div>
    <div class="sepH_c">
        <p>Layout:</p>
        <div class="clearfix">
            <label class="radio-inline"><input name="ssw_layout" id="ssw_layout_fluid" value="" checked="" type="radio"> Fluid</label>
            <label class="radio-inline"><input name="ssw_layout" id="ssw_layout_fixed" value="gebo-fixed" type="radio"> Fixed</label>
        </div>
    </div>
    <div class="sepH_c">
        <p>Sidebar position:</p>
        <div class="clearfix">
            <label class="radio-inline"><input name="ssw_sidebar" id="ssw_sidebar_left" value="" checked="" type="radio"> Left</label>
            <label class="radio-inline"><input name="ssw_sidebar" id="ssw_sidebar_right" value="sidebar_right" type="radio"> Right</label>
        </div>
    </div>
    <div class="sepH_c">
        <p>Show top menu on:</p>
        <div class="clearfix">
            <label class="radio-inline"><input name="ssw_menu" id="ssw_menu_click" value="" checked="" type="radio"> Click</label>
            <label class="radio-inline"><input name="ssw_menu" id="ssw_menu_hover" value="menu_hover" type="radio"> Hover</label>
        </div>
    </div>

    <div class="gh_button-group">
        <a href="#" id="showCss" class="btn btn-primary btn-sm">Show CSS</a>
        <a href="#" id="resetDefault" class="btn btn-default btn-sm">Reset</a>
    </div>
    <div class="hide">
        <ul id="ssw_styles">
            <li class="small ssw_mbColor sepH_a" style="display:none">body {<span class="ssw_mColor sepH_a" style="display:none"> color: #<span></span>;</span> <span class="ssw_bColor" style="display:none">background-color: #<span></span> </span>}</li>
            <li class="small ssw_lColor sepH_a" style="display:none">a { color: #<span></span> }</li>
        </ul>
    </div>
</div>		<div id="maincontainer" class="clearfix">

    <header>
        @include('layouts/dashboard/header_nav')
    </header>
    <div id="contentwrapper">
        <div class="main_content" ng-app="myApp">
            @yield('content')
        </div>
    </div>

</div>

<a href="javascript:void(0)" class="sidebar_switch on_switch bs_ttip" data-placement="auto right" data-viewport="body" title="Hide Sidebar">Sidebar switch</a>
<div class="sidebar">
    @include('layouts/dashboard/left_sidebar')
</div>
@include('layouts/dashboard/scripts')
</body>

<!-- Mirrored from gebo-admin-3.tzdthemes.com/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 30 Oct 2016 15:39:41 GMT -->
</html>
