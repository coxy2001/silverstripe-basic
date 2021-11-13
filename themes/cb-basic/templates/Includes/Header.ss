<header>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a class="text-light" href="$BaseHref" title="Return to homepage">
                    <% if $SVG %>
                        $SVG('logo')
                    <% else %>
                        <h1 class="text-center text-light p-2">$SiteConfig.Title</h1>
                    <% end_if %>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <% include Navigation %>
            </div>
        </div>
    </div>
</header>
