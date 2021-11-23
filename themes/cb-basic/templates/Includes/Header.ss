<header>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <a class="text-light" href="$BaseHref" title="Return to homepage">
                    <% if $SiteConfig.Logo %>
                        <img class="img-logo" height="81" src="$SiteConfig.Logo.URL" alt="$SiteConfig.Logo.Title">
                    <% else %>
                        <h1 class="text-light p-2">$SiteConfig.Title</h1>
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
