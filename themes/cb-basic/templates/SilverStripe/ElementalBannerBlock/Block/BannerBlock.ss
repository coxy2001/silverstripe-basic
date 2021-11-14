<div class="row">
    <div class="col-12 banner_img" style="background-image: url($File.URL);min-height: {$BannerHeight}vh;">
        <div class="container">
            <div class="banner_content">
                <% if $ShowTitle %>
                    <h2>$Title</h2>
                <% end_if %>
                $Content
            </div>
        </div>
    </div>
</div>