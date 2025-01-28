"use strict";
const cxfSliderCallback = function () {
  let e = elementorModules.frontend.handlers.Base,
    t = elementorFrontend.elementsHandler,
    s = elementorFrontend.hooks;
  elementorFrontend.utils;
  let i = e.extend({
      bindEvents() {
        this.getElementType(),
          this.setupSlider(),
          window.addEventListener("resize", this.setupSlider);
      },
      setupSlider() {
        let e = this.getElementSettings("cxf_slider_type");
        this.initSwiperSlider();
      },
      async initSwiperSlider() {
        this.sliderInstance && this.sliderInstance?.destroy(!0, !0),
          this.thumbSliderInstance && this.thumbSliderInstance?.destroy(!0, !0),
          (this.sliderInstance = null),
          (this.thumbSliderInstance = null);
        var e = this.$element.find(".cxf--slider"),
          t = e.data("prefix") ?? "cxf",
          s = this.$element.find(".cxf--thumb-slider"),
          i = s.data("prefix"),
          a = elementorFrontend.getCurrentDeviceMode(),
          l = elementorFrontend.breakpoints.getDeviceMinBreakpoint(a);
        t || (t = "cxf"), i || (i = "cxf_thumb");
        var n = this.getSwiperOptions(t);
        let o = this.$element.find(".cxf--arrow-prev"),
          r = this.$element.find(".cxf--arrow-next");
        o.hasClass("cxf--arrow-disabled") &&
          o.removeClass("cxf--arrow-disabled"),
          r.hasClass("cxf--arrow-disabled") &&
            r.removeClass("cxf--arrow-disabled"),
          e.hasClass("cxf--slider-disabled") &&
            e.removeClass("cxf--slider-disabled"),
          s.hasClass("cxf--thumb-slider-disabled") &&
            s.removeClass("cxf--thumb-slider-disabled"),
          (!n?.breakpoints[l]?.navigation ||
            !1 === n?.breakpoints[l]?.navigation?.enabled) &&
            (o.length > 0 && o.addClass("cxf--arrow-disabled"),
            r.length > 0 && r.addClass("cxf--arrow-disabled"));
        var d = elementorFrontend.utils.swiper;
        let c = !0 === n?.breakpoints[l]?.enabled;
        if (
          (!c && e.length > 0 && e.addClass("cxf--slider-disabled"),
          e.length > 0 && c)
        ) {
          var p = this.getSwiperThumbOptions(i);
          let h = !0 === p?.breakpoints[l]?.enabled;
          !h && s.length > 0 && s.addClass("cxf--thumb-slider-disabled"),
            s.length > 0 && h
              ? (this.thumbSliderInstance = await new d(s, p).then(
                  async (t) =>
                    (this.sliderInstance = await new d(e, n).then((e) => {
                      (e.controller.control = t), (t.controller.control = e);
                    }))
                ))
              : (this.sliderInstance = await new d(e, n));
        }
      },
      getSwiperOptions(e = "cxf") {
        e = `${e}_`;
        let t = this.getElementSettings();
        var s = {
          loop: "yes" === t[`${e}loop`],
          speed: t.cxf_speed ?? 500,
          allowTouchMove: "yes" === t[`${e}allow_touch_move`],
          slidesPerView: t[`${e}slides_per_view`] ?? "auto",
          spaceBetween: t[`${e}space_between`] ?? 70,
          effect: t[`${e}effect`] ?? "slide",
          autoplay: "yes" === t[`${e}autoplay`],
          direction: t[`${e}direction`] ?? "horizontal",
          navigation: !1,
          pagination: !1,
          breakpoints: {},
        };
        let i = t[`${e}enable_slider`] ?? !0;
        s.enabled = "yes" === i || !0 === i;
        let a = `${e}slides_per_view`;
        if (
          ("custom" === s.slidesPerView &&
            ((s.slidesPerView = t[`${e}custom_slides_per_view`] ?? "auto"),
            (a = `${e}custom_slides_per_view`)),
          !0 === s.autoplay &&
            (s.autoplay = {
              delay: t[`${e}autoplay_delay`] ?? 3e3,
              disableOnInteraction: "yes" === t[`${e}autoplay_interaction`],
              reverseDirection: "yes" === t[`${e}reverse_direction`],
            }),
          "yes" === t[`${e}mousewheel`] &&
            (s.mousewheel = { releaseOnEdges: !0 }),
          "yes" === t[`${e}navigation`] &&
            (s.navigation = {
              enabled: !0,
              prevEl: `.elementor-element-${this.getID()} .cxf--arrow-prev`,
              nextEl: `.elementor-element-${this.getID()} .cxf--arrow-next`,
            }),
          "yes" === t[`${e}pagination`])
        )
          switch (
            ((s.pagination = {
              enabled: !0,
              el: `.elementor-element-${this.getID()} .swiper-pagination`,
              clickable: !0,
              type: t[`${e}pagination_type`] ?? "bullets",
            }),
            s.pagination.type)
          ) {
            case "fraction":
              (s.pagination.formatFractionCurrent = (e) => ("0" + e).slice(-2)),
                (s.pagination.formatFractionTotal = (e) => ("0" + e).slice(-2)),
                (s.pagination.renderFraction = (
                  e,
                  t
                ) => `<span class="${e}"></span>
                 <span class="mid-line"></span>
                 <span class="${t}"></span>`);
              break;
            case "bullets":
              "number" === t[`${e}pagination_bullets_type`] &&
                (s.pagination.renderBullet = function (e, t) {
                  return '<span class="' + t + '">' + (e + 1) + "</span>";
                });
          }
        switch (
          ("yes" === t[`${e}slideshow_lazyload`] &&
            (s.lazy = { loadPrevNext: !0, loadPrevNextAmount: 1 }),
          s.effect)
        ) {
          case "fade":
            s.crossFade = "yes" === t[`${e}slideshow_lazyload`];
            break;
          case "coverflow":
            (s.slideShadows = "yes" === t[`${e}slide_shadows`]),
              (s.depth = t[`${e}coverflow_depth`] ?? 100),
              (s.modifier = t[`${e}coverflow_modifier`] ?? 1),
              (s.rotate = t[`${e}coverflow_rotate`] ?? 50),
              (s.scale = t[`${e}coverflow_scale`] ?? 1),
              (s.stretch = t[`${e}coverflow_stretch`] ?? 100);
            break;
          case "coverflow":
            (s.limitRotation = "yes" === t[`${e}flip_limit_rotation`]),
              (s.slideShadows = "yes" === t[`${e}slide_shadows`]);
            break;
          case "cube":
            (s.shadow = "yes" === t[`${e}cube_shadow`]),
              (s.slideShadows = "yes" === t[`${e}slide_shadows`]),
              (s.shadowOffset = t[`${e}cube_shadow_offset`] ?? 20),
              (s.shadowScale = t[`${e}cube_shadow_scale`] ?? 0.94);
            break;
          case "cards":
            (s.rotate = "yes" === t[`${e}cards_rotate`]),
              (s.slideShadows = "yes" === t[`${e}slide_shadows`]),
              (s.perSlideOffset = t[`${e}cards_per_slide_offsett`] ?? 8),
              (s.perSlideRotate = t[`${e}cards_per_slide_rotate`] ?? 2);
        }
        s.centeredSlides = "yes" === t[`${e}centered_slides`];
        let l = {},
          n = elementorFrontend.breakpoints.responsiveConfig.activeBreakpoints;
        for (let o in n) {
          let r = t[`${a}_${o}`];
          r || (r = t[a]), r || (r = "auto");
          var d = s.navigation ?? !1;
          "yes" === t[`${e}navigation_${o}`] &&
            (d = {
              enabled: !0,
              prevEl: `.elementor-element-${this.getID()} .cxf--arrow-prev`,
              nextEl: `.elementor-element-${this.getID()} .cxf--arrow-next`,
            });
          var c = s.pagination ?? !1;
          "yes" === t[`${e}pagination_${o}`] &&
            (c = {
              enabled: !0,
              el: `.elementor-element-${this.getID()} .swiper-pagination`,
              clickable: !0,
              type: t[`${e}pagination_type`] ?? "bullets",
            });
          let p = elementorFrontend.breakpoints.getDeviceMinBreakpoint(o),
            h = t[`${e}enable_slider_${o}`] ?? !0;
          l[p] = {
            slidesPerView: r,
            navigation: d,
            pagination: c,
            enabled: "yes" === h || !0 === h,
          };
        }
        return (
          (l[elementorFrontend.breakpoints.getDesktopMinPoint()] = {
            enabled: s.enabled ?? !0,
            slidesPerView: s.slidesPerView,
            navigation: s.navigation ?? !1,
            pagination: s.pagination ?? !1,
          }),
          (s.breakpoints = l),
          s
        );
      },
      getSwiperThumbOptions(e = "cxf_thumb") {
        let t = this.getElementSettings(),
          s = this.getSwiperOptions(e),
          i = { ...s };
        return (
          (e = `${e}_`),
          (i.loopAdditionalSlides =
            "custom" === t[`${e}loop_additional_slides`]
              ? t[`${e}loop_additional_slides`]
              : i.slidesPerView),
          "custom" === i.loopAdditionalSlides &&
            (i.loopAdditionalSlides =
              t[`${e}custom_loop_additional_slides`] ?? i.slidesPerView),
          (i.watchSlidesProgress = "yes" === t[`${e}watch_slides_progress`]),
          (i.slideToClickedSlide = "yes" === t[`${e}slide_to_clicked_slide`]),
          i
        );
      },
    }),
    a = (e) => {
      t.addHandler(i, { $element: e });
    },
    l = s.applyFilters("cxf/widgets/sliders", {
      "cxf--portfolio": ["skin-portfolio-one", "skin-portfolio-two"],
    });
  for (let [n, o] of Object.entries(l))
    s.addAction(`frontend/element_ready/${n}.default`, a),
      o.length > 0 &&
        o.forEach((e) => {
          s.addAction(`frontend/element_ready/${n}.${e}`, a);
        });
};
window.addEventListener("elementor/frontend/init", cxfSliderCallback);
