const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

function onEvent(query, event, callback) {
    $$(query).forEach((element) => {
        element.addEventListener(event, callback);
    });
}

document.addEventListener("DOMContentLoaded", () => {
    onEvent("[data-accordion]", "click", function (e) {
        const accordion = this.dataset.accordion;
        $$(`[data-accordion="${accordion}"]`).forEach((element) => {
            if (element != this) {
                element.nextElementSibling.style.maxHeight = null;
                element.classList.remove("accordion-item__header--expanded");
            }
        });

        const next = this.nextElementSibling;
        if (next.style.maxHeight) {
            next.style.maxHeight = null;
            this.classList.remove("accordion-item__header--expanded");
        } else {
            next.style.maxHeight = next.scrollHeight + 1 + "px";
            this.classList.add("accordion-item__header--expanded");
        }
    });

    $$(".splide--regular").forEach((element) => {
        new Splide(element, {
            type: "loop",
            lazyLoad: "nearby",
        }).mount();
    });
});
