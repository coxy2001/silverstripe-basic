<% if $ShowTitle && $Title %>
    <div class="$ContainerClass">
        <h2 class="element__title">$Title</h2>
    </div>
<% end_if %>

<% if $Slides %>
    <section class="splide splide--regular">
        <div class="splide__track">
            <ul class="splide__list">
                <% loop $Slides.Sort('Sort') %>
                    <li class="splide__slide">
                        <div class="image-slider__slide" style="background-image: url({$Image.URL});">
                            <div class="image-slider__container $ContainerClass">
                                <div class="image-slider__content">
                                    <% if $Title %>
                                        <h2 class="image-slider__title">$Title</h2>
                                    <% end_if %>
                                    $Content
                                    $CTALink.setClass('image-slider__link btn btn--primary')
                                </div>
                            </div>
                        </div>
                    </li>
                <% end_loop %>
            </ul>
        </div>
    </section>
<% end_if %>