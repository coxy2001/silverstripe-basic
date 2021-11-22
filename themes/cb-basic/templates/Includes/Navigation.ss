<nav>
    <ul class="nav justify-content-center">
        <% loop Menu(1) %>
            <li class="nav-item $LinkingMode">
                <a class="nav-link" href="$Link" title="$Title.XML">$MenuTitle.XML</a>
            </li>
        <% end_loop %>
    </ul>
</nav>
