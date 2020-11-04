<li class="treeview">
    <a href="#"><i class="fa {{ $icon }}"></i> <span>{{ $label }}</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        @foreach ($items as $item)
    <li><a href="{{ $item['route'] }}" title="{{ isset($item['title']) ? $item['title'] : '' }}"><span class="fa fa-fw {{ isset($item['icon']) ? $item['icon'] : 'fa-circle-o' }} text-{{ $item['color'] }}"></span> {{ $item['label'] }}</a></li>
        @endforeach
    </ul>
</li>