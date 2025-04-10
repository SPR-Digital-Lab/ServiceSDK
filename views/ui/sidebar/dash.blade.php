{{-- mobile --}}
<div class="overflow-auto bg-white position-absolute start-0 h-100 animated-slow d-block d-sm-none" x-cloak style="width: 14rem;z-index:150"
:style='runtime.sidebar.visible?{}:{marginLeft:"-14rem"}' :class="runtime.sidebar.visible?'shadow':''">
@include('glide.menu.mainmenu',['menu'=>$menu])
</div>

{{-- desktop --}}
<div class="flex-shrink-0 overflow-auto bg-white shadow-sm h-100 border-end animated-slow d-none d-sm-block" x-cloak style="width: 14rem;z-index:150"
:style="runtime.sidebar.visible?{}:{marginLeft:'-14rem'}">
@include('glide.menu.mainmenu',['menu'=>$menu])
</div>

<div :class="runtime.sidebar.visible?'d-block d-sm-none':'d-none'"
    x-transition:enter="animate__animated animate__fadeIn animate__faster"
    x-transition:leave="animate__animated animate__fadeOut animate__faster" x-cloak @click="runtime.sidebar.visible = false"
    class="top-0 bottom-0 position-fixed end-0 start-0"
    style="z-index: 90;backdrop-filter: blur(2px); background: rgb(0 0 0 / 10%);">
</div>
