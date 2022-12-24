<div class="banner__image" style="background-image: url($File.URL);min-height: {$BannerHeight}vh;">
    <div class="banner__container container">
        <div class="banner__content">
            <% if $ShowTitle && $Title %>
                <h2 class="banner__title">$Title</h2>
            <% end_if %>
            $Content
        </div>
    </div>
</div>