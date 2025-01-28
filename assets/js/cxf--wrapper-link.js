jQuery(document).ready(function () {
  // Event delegation for handling clicks on wrapper links
  jQuery("body").on("click", ".cxf--wrapper-link", function (event) {
    event.preventDefault(); // Prevent default behavior of the link
    const $el = jQuery(this);

    // Extract settings and data attributes
    const settings = $el.data("cxf-wrapper-link");
    const linkId = `cxf--wrapper-link-${$el.data("id")}`;

    // Check if the link element already exists to prevent duplication
    if (!jQuery(`#${linkId}`).length) {
      // Create and append a dynamic link element
      const $link = jQuery("<a>", {
        id: linkId,
        class: "bdt-hidden",
        href: settings.url,
        target: settings.is_external ? "_blank" : "_self",
        rel: settings.nofollow ? "nofollow noreferrer" : "",
      });

      jQuery("body").append($link);
    }

    // Trigger the click on the dynamically created link
    document.getElementById(linkId).click();
  });

  // Elementor global extension support
  // window.addEventListener("elementor/frontend/init", function () {
  //   if (elementorFrontend && typeof elementorFrontend !== "undefined") {
  //     elementorFrontend.hooks.addAction(
  //       "frontend/element_ready/global",
  //       function ($scope) {
  //         $scope.find(".cxf--wrapper-link").each(function () {
  //           const $el = jQuery(this);
  //           const settings = $el.data("cxf-wrapper-link");

  //           // Ensure settings are valid and apply a click handler
  //           if (settings && settings.url) {
  //             $el.css("cursor", "pointer").on("click", function () {
  //               $el.trigger("click");
  //             });
  //           }
  //         });
  //       }
  //     );
  //   }
  // });
});
