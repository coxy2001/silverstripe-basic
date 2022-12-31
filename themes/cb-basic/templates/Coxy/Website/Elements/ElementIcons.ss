<div class="$ContainerClass">
    <% if $ShowTitle && $Title %>
        <h2 class="element__title">$Title</h2>
    <% end_if %>

    <% if $Icons %>
        <div class="icons__grid">
            <% loop $Icons.Sort('Sort') %>
                <div class="icons__grid-item">
                    <img class="icons__image" src="$Image.URL" alt="$Image.Title">
                    $Content
                    <a class="icons__link" href="$Link">$Link</a>
                </div>
            <% end_loop %>
        </div>
    <% end_if %>
</div>