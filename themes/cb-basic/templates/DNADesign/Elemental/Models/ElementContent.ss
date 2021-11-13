<% if $ShowTitle %>
    <div class="row">
        <div class="col-12">
            <h2>$Title</h2>
        </div>
    </div>
<% end_if %>

<div class="row">
    <div class="col-12 <% if $HTML2 %>col-md-6<% end_if %>">
        $HTML
    </div>
    <% if $HTML2 %>
        <div class="col-12 col-md-6">
            $HTML2
        </div>
    <% end_if %>
</div>
