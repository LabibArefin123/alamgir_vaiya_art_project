@php
    $layout = $settings->navbar_layout ?? 1;
@endphp

<!-- Topbars -->
<div id="topbar1" class="topbar-layout" @if ($layout != 1) style="display:none" @endif>
    @include('frontend.layouts.topbars.topbar_1')
</div>

<div id="topbar2" class="topbar-layout" @if ($layout != 2) style="display:none" @endif>
    @include('frontend.layouts.topbars.topbar_2')
</div>

<div id="topbar3" class="topbar-layout" @if ($layout != 3) style="display:none" @endif>
    @include('frontend.layouts.topbars.topbar_3')
</div>

<!-- Navbars -->
<div id="navbar1" class="navbar-layout" @if ($layout != 1) style="display:none" @endif>
    @include('frontend.layouts.navbars.navbar_1')
</div>

<div id="navbar2" class="navbar-layout" @if ($layout != 2) style="display:none" @endif>
    @include('frontend.layouts.navbars.navbar_2')
</div>

<div id="navbar3" class="navbar-layout" @if ($layout != 3) style="display:none" @endif>
    @include('frontend.layouts.navbars.navbar_3')
</div>
