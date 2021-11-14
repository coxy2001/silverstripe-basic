<div class="row">
    <div class="col-12 banner_img" style="background-image: url($File.URL);min-height: {$BannerHeight}vh;">
        <div class="container d-flex h-100">
            <div class="banner_content align-self-center">
                <% if $ShowTitle %>
                    <h2>$Title</h2>
                <% end_if %>
                $Content
            </div>
        </div>
    </div>
</div>