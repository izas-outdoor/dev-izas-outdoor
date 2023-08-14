require(["jquery", "owlCarousel", "bootstrapselect", "bootstrapjs"], function (
    $
) {
    // home slider

    $(document).ready(function () {
        $(".owl-carousel").each(function () {
            $(this).on("initialize.owl.carousel", function () {
                $(this).find(".item").removeClass("hidden");
            });
            $(this).owlCarousel({
                loop: true,
                items: 4,
                margin: 10,
                nav: true,
                autoplay: true,
                autoplayTimeout: 6000,
                autoplayHoverPause: false,
                responsive: {
                    0: {
                        items: 1,
                    },
                    648: {
                        items: 1,
                    },

                    1000: {
                        items: 3,
                    },
                    1308: {
                        items: 3,
                    },
                },
            });
        });

        $('.hidden-md-down[data-item="6"]').addClass("outlet");

        $(".loading-mask .loader").remove();
        $("#checkout-loader .loader").remove();
    });
    $("#newsletter-popin-subscribe-footer").on("submit", function (e) {
        e.preventDefault();
        email = $("#newsletter-popin-email-footer").val();
        $(".footer-newsletter-error").addClass("hidden");
        $(".footer-newsletter-error-email").addClass("hidden");
        $(".footer-newsletter-success").addClass("hidden");
        var $form = $(e.currentTarget);
        if (email != "") {
            $.ajax({
                url: $form.attr("action"),
                method: "POST",
                data: $form.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.success) {
                        $(".footer-newsletter-success").removeClass("hidden");
                    } else {
                        $(".footer-newsletter-error").removeClass("hidden");
                    }
                },
            });
        } else {
            $(".footer-newsletter-error-email").removeClass("hidden");
        }
    });
    $("#footer-newsletter").on("submit", function (e) {
        e.preventDefault();
        email = $("#newsletter-popin-email-footer").val();
        $(".footer-newsletter-error").addClass("hidden");
        $(".footer-newsletter-error-email").addClass("hidden");
        $(".footer-newsletter-success").addClass("hidden");
        var $form = $(e.currentTarget);
        if (email != "") {
            $.ajax({
                url: $form.attr("action"),
                method: "POST",
                data: $form.serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.success) {
                        $(".footer-newsletter-success").removeClass("hidden");
                    } else {
                        $(".footer-newsletter-error").removeClass("hidden");
                    }
                },
            });
        } else {
            $(".footer-newsletter-error-email").removeClass("hidden");
        }
    });

    $(".links li").first().addClass("newsletter-popup-listener");
    $("ul.links li:nth-child(2)").addClass("store-searcher-link");
    $(".links li.newsletter-popup-listener a").removeAttr("href");
    $(".links li.newsletter-popup-listener a").prepend(
        '<i class="fas fa-envelope"></i>'
    );
    $(".links li.store-searcher-link a").prepend(
        '<i class="fas fa-store-alt"></i>'
    );
    $(".minisearch").click(function () {
        $(".minisearch").removeClass("active");
        // $(".tab").addClass("active"); // instead of this do the below
        $(this).addClass("active");
    });

    $("#confirm-conditions").prop("checked", false);
    $("#confirm-conditions").change(function () {
        if (this.checked) {
            $(".checkout").prop("disabled", false);
        } else {
            $(".checkout").prop("disabled", true);
        }
    });
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
            this.classList.toggle("active");

            /* Toggle between hiding and showing the active panel */
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
});

function headers(options) {
    options = options || {};
    options.headers = options.headers || {};
    options.headers["X-Requested-With"] = "XMLHttpRequest";
    return options;
}

function credentials(options) {
    if (options == null) {
        options = {};
    }
    if (options.credentials == null) {
        options.credentials = "same-origin";
    }
    return options;
}

function addOverlay() {
    // Check if the overlay already exists
    if (document.getElementById("customOverlay")) {
        console.log("Overlay already exists.");
        return;
    }

    // Create the overlay div
    const overlay = document.createElement("div");
    overlay.id = "customOverlay";
    overlay.style.position = "fixed";
    overlay.style.top = "0";
    overlay.style.left = "0";
    overlay.style.width = "100%";
    overlay.style.height = "100%";
    overlay.style.backgroundColor = "rgba(0, 0, 0, 0.7)"; // semi-transparent black
    overlay.style.zIndex = "1000"; // to ensure it's on top
    overlay.style.display = "flex"; // to use flexbox for centering the content
    overlay.style.justifyContent = "center"; // center horizontally
    overlay.style.alignItems = "center"; // center vertically
    overlay.style.opacity = "1"; // start fully transparent
    overlay.style.transition = "opacity 0.5s"; // 0.5 seconds transition for the opacity

    // Create the centered content div
    const content = document.createElement("div");
    content.innerHTML = "Un momento por favor";
    content.style.padding = "20px";
    content.style.fontSize = "24px";
    content.style.color = "#fff";
    content.style.borderRadius = "8px";

    // Append the content to the overlay
    overlay.appendChild(content);

    // Append the overlay to the body
    document.body.appendChild(overlay);
    // setTimeout(() => {
    //     overlay.style.opacity = '1';
    // }, 500);
}

function removeOverlay() {
    const overlayToRemove = document.getElementById("customOverlay");
    if (overlayToRemove) {
        overlayToRemove.style.opacity = "0"; // start the fade-out effect

        // Wait for the transition to complete before removing from DOM
        setTimeout(() => {
            overlayToRemove.remove();
        }, 500);
    } else {
        console.log("Overlay not found.");
    }
}

document.addEventListener("click", (e) => {
    const { target } = e;
    console.log(target)
    if (
        target.matches("a.routable") ||
        !!target.closest("a.routable") ||
        target.matches("a.action.remove") ||
        !!target.closest("a.action.remove")
    ) {
        addOverlay();

        e.preventDefault();
        try {
            console.log(
                e.target.href ||
                    e.target.closest("a.routable")?.href ||
                    target.closest("a.action.remove")?.href
            );
            e = window.event;
            const route =
                e.target.href ||
                e.target.closest("a.routable")?.href ||
                target.closest("a.action.remove")?.href;
            window.history.pushState({}, "", route);

            urlLocationHandler(route).then(() => {
                removeOverlay();
                return false;
            });
        } catch (e) {
            console.log(e);
            removeOverlay();
            return false;
        }
    } else if (target.matches("div.toolbar-sorter") || !!target.closest("div.toolbar-sorter")) {
        document.querySelector("#layer-product-list .panels").style.display =
        "block";
    }
});
const urlLocationHandler = async (route, options) => {
    let location = route;
    console.log(location);
    options = headers(credentials(options));
    document.querySelector("#layer-product-list .panels").style.display =
        "none";

    document.querySelector(".wt-overlay").classList.remove("black-overlay");
    var event = new Event("hide.bs.collapse");
    document.querySelector(".panel-collapse").dispatchEvent(event);
    let response = await fetch(location, options).then((response) => response);
    const inner = await response.text();
    var doc = document.implementation.createHTMLDocument();
    doc.open();
    doc.write(inner);

    document.title = doc.getElementsByTagName("title")[0].text; // div.getElementsByTagName('title')[0].text;
    document.getElementById("maincontent").innerHTML =
        doc.getElementById("maincontent").innerHTML;
    try {
        const docMetaTags = doc.querySelectorAll("meta");
        const currentHead = document.head;

        docMetaTags.forEach((metaTag) => {
            let selector = "meta";
            const nameAttr = metaTag.getAttribute("name");
            const httpEquivAttr = metaTag.getAttribute("http-equiv");
            const propertyAttr = metaTag.getAttribute("property");
            const charsetAttr = metaTag.getAttribute("charset");

            if (nameAttr) {
                selector += `[name="${nameAttr}"]`;
            } else if (httpEquivAttr) {
                selector += `[http-equiv="${httpEquivAttr}"]`;
            } else if (propertyAttr) {
                selector += `[property="${propertyAttr}"]`;
            } else if (charsetAttr) {
                selector += `[charset]`;
            }

            let currentMetaTag = currentHead.querySelector(selector);

            if (!currentMetaTag) {
                currentMetaTag = document.createElement("meta");
                if (nameAttr) currentMetaTag.setAttribute("name", nameAttr);
                if (httpEquivAttr)
                    currentMetaTag.setAttribute("http-equiv", httpEquivAttr);
                if (propertyAttr)
                    currentMetaTag.setAttribute("property", propertyAttr);
                if (charsetAttr)
                    currentMetaTag.setAttribute("charset", charsetAttr);
                currentHead.append(currentMetaTag);
            }

            const contentAttr = metaTag.getAttribute("content");
            if (contentAttr) {
                currentMetaTag.setAttribute("content", contentAttr);
            }
        });
    } catch (e) {
        console.error("An error occurred:", e);
    }
};
// document.querySelectorAll('.category-list').forEach(c=>{
//     c.addEventListener("mouseenter",function(e){
//         c.closest('header').addClass('hover')
//         c.getElementsByClassName('submenu-container').removeClass('hidden')
//     })
// })
// document.querySelectorAll('.category-list').forEach(c=>{
//     c.addEventListener("mouseleave",function(e){
//         c.closest('header').removeClass('hover')
//         c.getElementsByClassName('submenu-container').addClass('hidden')
//     })
// })

// document.querySelectorAll('category-list').addEventListener("mouseleave",function(e){
//     this.closest('header').removeClass('hover')
//     this.getElementsByClassName('submenu-container').addClass('hidden')

// })
