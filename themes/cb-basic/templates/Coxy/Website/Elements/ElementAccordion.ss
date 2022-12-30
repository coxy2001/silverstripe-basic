<div class="$ContainerClass">
    <% if $ShowTitle && $Title %>
        <h2 class="element__title">$Title</h2>
    <% end_if %>
    $Content
    <% if $AccordionItems %>
        <div class="accordion__items">
            <% loop $AccordionItems.Sort('Sort') %>
                <div class="accordion-item">
                    <% if $Title %>
                        <h5 class="accordion-item__header" data-accordion="$AccordionID">
                            <div class="accordion-item__title">$Title</div>
                            <svg class="accordion-item__arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40" focusable="false">
                                <path d="m15.5 0.932-4.3 4.38 14.5 14.6-14.5 14.5 4.3 4.4 14.6-14.6 4.4-4.3-4.4-4.4-14.6-14.6z"></path>
                            </svg>
                        </h5>
                    <% end_if %>
                    <div class="accordion-item__collapse">
                        <div class="accordion-item__content">
                            $Content
                        </div>
                    </div>
                </div>
            <% end_loop %>
        </div>
    <% end_if %>
</div>