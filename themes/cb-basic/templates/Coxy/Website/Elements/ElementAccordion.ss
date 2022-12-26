<div class="container">
    <% if $ShowTitle && $Title %>
        <h2 class="element__title">$Title</h2>
    <% end_if %>
    $Content
    <% if $AccordionItems %>
        <div class="accordion__items">
            <% loop $AccordionItems %>
                <div class="accordion__item">
                    <% if $Title %>
                        <h5 class="accordion__item-title">$Title</h5>
                    <% end_if %>
                    <div class="accordion__item-collapse">
                        $Content
                    </div>
                </div>
            <% end_loop %>
        </div>
    <% end_if %>
</div>