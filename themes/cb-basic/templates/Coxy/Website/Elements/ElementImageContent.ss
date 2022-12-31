<div class="$ContainerClass">
    <% if $ShowTitle && $Title %>
        <h2 class="element__title">$Title</h2>
    <% end_if %>

    <div class="image-content__row">
        <div class="image-content__col">
            $Content
        </div>
        <% if $File %>
            <div class="image-content__col">
                <img width="100%" src="$File.URL" alt="$File.Title">
            </div>
        <% end_if %>
    </div>
</div>