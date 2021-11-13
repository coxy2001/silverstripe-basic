<nav>
    <ul class="nav">
        <% loop Menu(1) %>
            <li class="nav-item $LinkingMode">
                <a class="nav-item" href="$Link" title="$Title.XML">$MenuTitle.XML</a>
            </li>
        <% end_loop %>
    </ul>
</nav>
