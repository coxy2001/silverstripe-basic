<div class="$ContainerClass">
    <% if $ShowTitle && $Title %>
        <h2 class="element__title">$Title</h2>
    <% end_if %>

    <% if $Icons %>
        <div class="icons__grid">
            <% loop $Icons.Sort('Sort') %>
                <div class="icons__grid-item">
                    <% if $Image %>
                        <img class="icons__image" src="$Image.URL" alt="$Image.Title">
                    <% end_if %>
                    $Content
                    $CTALink.setClass('icons__link btn btn--primary')
                </div>
            <% end_loop %>
        </div>
    <% end_if %>

    <div class="icons__block-link-holder">
        $CTALink.setClass('icons__block-link btn btn--primary')
    </div>
</div>