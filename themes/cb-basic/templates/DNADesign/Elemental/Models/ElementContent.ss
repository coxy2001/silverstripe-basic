<div class="$ContainerClass">
    <% if $ShowTitle && $Title %>
        <h2 class="element__title">$Title</h2>
    <% end_if %>

    <div class="content__row">
        <div class="content__col">
            $HTML
        </div>
        <% if $HTML2 %>
            <div class="content__col">
                $HTML2
            </div>
        <% end_if %>
    </div>
</div>