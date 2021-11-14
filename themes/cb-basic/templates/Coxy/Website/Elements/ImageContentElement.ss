<% if $ShowTitle %>
    <div class="row">
        <div class="col-12">
            <h2>$Title</h2>
        </div>
    </div>
<% end_if %>

<div class="row">
    <% if $ImagePosition == "Left" %>
        <div class="col-12 col-md-6">
            <img width="100%" src="$File.URL" alt="$File.Title">
        </div>
    <% end_if %>
    <div class="col-12 col-md-6">
        $Content
    </div>
    <% if $ImagePosition == "Right" %>
        <div class="col-12 col-md-6">
            <img width="100%" src="$File.URL" alt="$File.Title">
        </div>
    <% end_if %>
</div>
