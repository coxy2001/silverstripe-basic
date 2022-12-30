<div class="$ContainerClass">
    <% if $ShowTitle && $Title %>
        <h2 class="element__title">$Title</h2>
    <% end_if %>
    
    <% if $Images %>
        <div class="photo-gallery__grid">
            <% loop $Images.Sort('Sort') %>
                <div class="photo-gallery__grid-item">
                    <a class="photo-gallery__photo" href="$URL" target="_blank">
                        <img class="photo-gallery__image" src="$URL" alt="$Title">
                    </a>
                </div>
            <% end_loop %>
        </div>
    <% end_if %>
</div>