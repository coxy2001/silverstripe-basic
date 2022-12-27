const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

function onEvent(query, event, callback) {
    $$(query).forEach((element) => {
        element.addEventListener(event, callback);
    });
}

onEvent("[data-accordion]", "click", (e) => {
    const accordion = e.target.dataset.accordion;
    $$(`[data-accordion="${accordion}"]`).forEach((element) => {
        if (element != e.target) {
            element.nextElementSibling.style.maxHeight = null;
            element.classList.remove("accordion-item__header--expanded");
        }
    });

    const next = e.target.nextElementSibling;
    if (next.style.maxHeight) {
        next.style.maxHeight = null;
        e.target.classList.remove("accordion-item__header--expanded");
    } else {
        next.style.maxHeight = next.scrollHeight + 1 + "px";
        e.target.classList.add("accordion-item__header--expanded");
    }
});
