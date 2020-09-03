<div id="sidebar-cont">
    <div id="company-name-cont">
        <img src="{{asset('Images/logo.svg')}}" alt="" srcset="">
        <p>bloomingal</p>
        <span class="oi oi-caret-bottom font-white"></span>
    </div>
    <div id="sidebar-items-cont">
        <ul>
            <li class="<?php if(Route::currentRouteName()=='home'){echo 'active';} ?>"><a href="{{route('home')}}"><span class="oi oi-project font-white"></span><p>Dashboard</p></a></li>
            <li class="<?php if(Route::currentRouteName()=='items'){echo 'active';} ?>"><a href="{{route('items')}}"><span class="oi oi-box font-white"></span><p>Items</p></a></li>
            <li id="sidebar-sales-btn" class="<?php 
                       $route = Route::current();
                        $name = $route->getName();
                        $cond=($name=== 'invoices' || $name=== 'create_invoice' 
                        || $name=== 'revenues' || $name==="create_revenue"
                        || $name==="customers" || $name==="create_customer"
                        );

                    if($cond){echo 'active';} ?>">
                    <span class="oi oi-credit-card font-white"></span>
                    <p>Sales</p> <span class="oi oi-chevron-bottom font-white"></span>
            </li>
            <div class="sidebar-hang-items <?php
                if($cond){echo 'show-hangin-items';}
                    ?>" 
                id="sidebar-sales-items">
                    <a href="{{route('invoices')}}"><p class="<?php if($cond){echo 'side-sel';}  ?>">Invoices</P></a>
                    <a href="{{route('revenues')}}"><p class="<?php if($cond){echo 'side-sel';}  ?>">Revenues</P></a>
                    <a href="{{route('customers')}}"><p class="<?php if($cond){echo 'side-sel';}  ?>">Customers</P></a>
            </div>
            <li><span class="oi oi-cart font-white"></span><p>Purchase</P></li>
            <li><span class="oi oi-briefcase font-white"></span><p>Banking</P></li>
            <li><span class="oi oi-pie-chart font-white"></span><p>Reports</P></li>
            <li><span class="oi oi-wrench font-white"></span><p>Settings</P></li>

        </ul>
    </div>
</div>