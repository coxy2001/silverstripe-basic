<div class="container">
    <% if $ShowTitle && $Title %>
        <h2 class="element__title">$Title</h2>
    <% end_if %>
    
    <div class="image-content__row">
        <% if $ImagePosition == "Left" %>
            <div class="image-content__container">
                <img width="100%" src="$File.URL" alt="$File.Title">
            </div>
        <% end_if %>
        <div class="image-content__container">
            $Content
        </div>
        <% if $ImagePosition == "Right" %>
            <div class="image-content__container">
                <img width="100%" src="$File.URL" alt="$File.Title">
            </div>
        <% end_if %>
    </div>
</div>
