@extends('layouts/dashboard/main')
@section('page_title', Route::currentRouteName())

@section('content')
    <div class="row col-sm-12">
        <h3 class="heading">@yield('page_title')</h3>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <div class="w-box" id="w_sort01">
                <div class="w-box-header">
                    New Buyer
                    <div class="pull-right"><span class="label label-success">123</span></div>
                </div>
                <div class="w-box-content cnt_a">
                    <form action="" method="post" class="elegant-aero">
                        <label><span>Buyer Name :</span>
                            <input id="name" type="text" name="name" placeholder="Buyer's Full Name" />
                        </label>
                        <label>
                            <span>Buyers Email :</span><input id="email" type="email" name="email" placeholder="Valid Email Address" /></label>
                        <label><span>Message :</span><textarea id="message" name="message" placeholder="Your Message to Us"></textarea></label>
                        <label><span>&nbsp;</span><input type="button" class="button" value="Send" /></label>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="w-box" id="w_sort02">
                <div class="w-box-header">
                    Lorem ipsum
                    <div class="pull-right">
                        <div class="btn-group">
                            <a class="btn dropdown-toggle btn-default btn-xs" data-toggle="dropdown" href="#">
                                <i class="glyphicon glyphicon-cog"></i> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="w-box-content">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>134</td>
                            <td>Summer Throssell</td>
                            <td><a class="__cf_email__" href="/cdn-cgi/l/email-protection" data-cfemail="4e3d3b23232b3c3a0e2b362f233e222b602d2123">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></td>
                        </tr>
                        <tr>
                            <td>135</td>
                            <td>Anthony Pound</td>
                            <td><a class="__cf_email__" href="/cdn-cgi/l/email-protection" data-cfemail="9bfaf5eff3f4f5e2ebdbfee3faf6ebf7feb5f8f4f6">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></td>
                        </tr>
                        <tr>
                            <td>136</td>
                            <td>Erin Church</td>
                            <td><a class="__cf_email__" href="/cdn-cgi/l/email-protection" data-cfemail="214453484f42614459404c514d440f424e4c">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></td>
                        </tr>
                        <tr>
                            <td>137</td>
                            <td>Declan Pamphlett</td>
                            <td><a class="__cf_email__" href="/cdn-cgi/l/email-protection" data-cfemail="a7c3c2c4cbc6c9d7e7c2dfc6cad7cbc289c4c8ca">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection