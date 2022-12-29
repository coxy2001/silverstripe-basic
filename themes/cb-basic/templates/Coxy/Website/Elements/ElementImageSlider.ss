<% if $ShowTitle && $Title %>
    <div class="container">
        <h2 class="element__title">$Title</h2>
    </div>
<% end_if %>

<% if $Slides %>
    <section class="splide" aria-label="Splide Basic HTML Example">
        <div class="splide__track">
            <ul class="splide__list">
                <% loop $Slides %>
                    <li class="splide__slide">
                        <div class="image-slider__slide" style="background-image: url({$Image.URL});">
                            <div class="image-slider__container container">
                                <div class="image-slider__content">
                                    <% if $Title %>
                                        <h2 class="image-slider__title">$Title</h2>
                                    <% end_if %>
                                    $Content
                                </div>
                            </div>
                        </div>
                    </li>
                <% end_loop %>
            </ul>
        </div>
    </section>
<% end_if %>