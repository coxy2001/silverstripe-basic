<% if $ShowTitle %>
    <div class="row">
        <div class="col-12">
            <h2>$Title</h2>
        </div>
    </div>
<% end_if %>

<div class="row">
    <div class="col-12 banner_img" style="background-image: url($File.URL);">
        <div class="banner_content">
            $Content
        </div>
    </div>
</div>