jQuery(document).ready(function () {
  jQuery("body").on("click", ".cxf--wrapper-link", function (e) {
    e.preventDefault();
    let l = jQuery(this),
      n = l.data("cxf-wrapper-link"),
      r = `cxf--wrapper-link-${l.data("id")}`;
    if (!jQuery(`#${r}`).length) {
      let t = jQuery("<a>", {
        id: r,
        class: "bdt-hidden",
        href: n.url,
        target: n.is_external ? "_blank" : "_self",
        rel: n.nofollow ? "nofollow noreferrer" : "",
      });
      jQuery("body").append(t);
    }
    document.getElementById(r).click();
  });
});
