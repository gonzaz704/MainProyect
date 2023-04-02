$(document).ready(function () {
    $(".news-slider").owlCarousel({
        items: 1,
        loop: true,
    });
    $(".chart-slider").owlCarousel({
        items: 1,
        loop: true,
    });
    $(".paper-slider").owlCarousel({
        items: 1,
        loop: true,
    });

    const tagged_slider = $(".tagged-news-slider");
    tagged_slider.owlCarousel({
        items: 1,
        loop: true,
        onInitialize: function (e) {
            const context = $(e.relatedTarget.$element.context);
            const slide = $(context.find(".post-slide")[0]);
            const container = slide
                .parent()
                .parent()
                .parent()
                .find(".news-popular-paper-container");

            const id = slide.data("news");
            $.get("news/" + id + "/popular/paper").then((response) => {
                container.empty().append(response);
            });
            $.get("news/" + id + "/title").then((response) => {
                $('.news-title').html(response);
            });
        },
    });
    tagged_slider.on("changed.owl.carousel", function (e) {
        const active = $($(e.target).find(".owl-item").eq(e.item.index)[0]).find(
            ".post-slide"
        );
        const id = active.data("news");
        const container = active
            .parent()
            .parent()
            .parent()
            .parent()
            .parent()
            .parent()
            .find(".news-popular-paper-container");
        $.get("news/" + id + "/popular/paper").then((response) => {
            container.empty().append(response);
        });
        $.get("news/" + id + "/title").then((response) => {
            $('.news-title').html(response);
        });
    });
});
