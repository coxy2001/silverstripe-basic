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
                            <svg class="accordion-item__arrow" xmlns="http://www.w3.org/2000/svg" width="36.668" height="19.885" viewBox="0 0 36.668 19.885">
                                <path d="M-20084-15345.334l15.211,13.852,14.395-13.111" transform="translate(20087.531 15348.866)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"></path>
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