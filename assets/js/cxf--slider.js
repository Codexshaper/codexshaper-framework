"use strict";

/**
 * Initialize sliders when Elementor frontend initializes
 */
const cxfSliderCallback = function () {
  const elementorFrontendBase = elementorModules.frontend.handlers.Base;
  const elementorHandler = elementorFrontend.elementsHandler;
  const elementorHook = elementorFrontend.hooks;
  const elementorUtils = elementorFrontend.utils;

  const cxfSliderHandler = elementorFrontendBase.extend({
    bindEvents() {
      const elementType = this.getElementType();
      this.setupSlider();
      // Resize.
      window.addEventListener("resize", this.setupSlider);
    },
    setupSlider() {
      const sliderType = this.getElementSettings("cxf_slider_type");
      switch (sliderType) {
        case "swiper":
          this.initSwiperSlider();
          break;
        default:
          this.initSwiperSlider();
          break;
      }
    },
    async initSwiperSlider() {
      if (this.sliderInstance) {
        this.sliderInstance?.destroy(true, true);
      }

      if (this.thumbSliderInstance) {
        this.thumbSliderInstance?.destroy(true, true);
      }

      this.sliderInstance = null;
      this.thumbSliderInstance = null;

      var swiperSlider = this.$element.find(".cxf--slider");
      var swiperPrefix = swiperSlider.data("prefix") ?? "cxf";
      var swiperThumbSlider = this.$element.find(".cxf--thumb-slider");
      var swiperThumbPrefix = swiperThumbSlider.data("prefix");
      var currentDevice = elementorFrontend.getCurrentDeviceMode();
      var breakpoint =
        elementorFrontend.breakpoints.getDeviceMinBreakpoint(currentDevice);
      if (!swiperPrefix) {
        swiperPrefix = "cxf";
      }
      if (!swiperThumbPrefix) {
        swiperThumbPrefix = "cxf_thumb";
      }
      var options = this.getSwiperOptions(swiperPrefix);

      // console.log(this.getID());
      // console.log("Slider");
      // console.log(options);
      // console.log(options.breakpoints[breakpoint]);

      let prevEl = this.$element.find(".cxf--arrow-prev");
      let nextEl = this.$element.find(".cxf--arrow-next");

      if (prevEl.hasClass("cxf--arrow-disabled")) {
        prevEl.removeClass("cxf--arrow-disabled");
      }

      if (nextEl.hasClass("cxf--arrow-disabled")) {
        nextEl.removeClass("cxf--arrow-disabled");
      }

      if (swiperSlider.hasClass("cxf--slider-disabled")) {
        swiperSlider.removeClass("cxf--slider-disabled");
      }

      if (swiperThumbSlider.hasClass("cxf--thumb-slider-disabled")) {
        swiperThumbSlider.removeClass("cxf--thumb-slider-disabled");
      }

      if (
        !options?.breakpoints[breakpoint]?.navigation ||
        false === options?.breakpoints[breakpoint]?.navigation?.enabled
      ) {
        if (prevEl.length > 0) {
          prevEl.addClass("cxf--arrow-disabled");
        }
        if (nextEl.length > 0) {
          nextEl.addClass("cxf--arrow-disabled");
        }
      }

      var Swiper = elementorFrontend.utils.swiper;
      let is_enabled_slider =
        true === options?.breakpoints[breakpoint]?.enabled;

      if (!is_enabled_slider && swiperSlider.length > 0) {
        swiperSlider.addClass("cxf--slider-disabled");
      }

      // console.log(currentDevice);
      // console.log(breakpoint);
      // console.log(options.breakpoints[breakpoint]);
      if (swiperSlider.length > 0 && is_enabled_slider) {
        var thumbOptions = this.getSwiperThumbOptions(swiperThumbPrefix);

        // console.log("Thumbnail");
        // console.log(thumbOptions);

        let is_enabled_thumb_slider =
          true === thumbOptions?.breakpoints[breakpoint]?.enabled;

        if (!is_enabled_thumb_slider && swiperThumbSlider.length > 0) {
          swiperThumbSlider.addClass("cxf--thumb-slider-disabled");
        }

        if (swiperThumbSlider.length > 0 && is_enabled_thumb_slider) {
          this.thumbSliderInstance = await new Swiper(
            swiperThumbSlider,
            thumbOptions
          ).then(
            async (thumbInstance) =>
              (this.sliderInstance = await new Swiper(
                swiperSlider,
                options
              ).then((mainInstance) => {
                mainInstance.controller.control = thumbInstance;
                thumbInstance.controller.control = mainInstance;
              }))
          );
        } else {
          this.sliderInstance = await new Swiper(swiperSlider, options);
        }
      }
    },
    getSwiperOptions(prefix = "cxf") {
      prefix = `${prefix}_`;
      const elementSettings = this.getElementSettings();

      var swiperOptions = {
        loop: "yes" === elementSettings[`${prefix}loop`],
        speed: elementSettings.cxf_speed ?? 500,
        allowTouchMove: "yes" === elementSettings[`${prefix}allow_touch_move`],
        slidesPerView: elementSettings[`${prefix}slides_per_view`] ?? "auto",
        spaceBetween: elementSettings[`${prefix}space_between`] ?? 70,
        effect: elementSettings[`${prefix}effect`] ?? "slide",
        autoplay: "yes" === elementSettings[`${prefix}autoplay`],
        direction: elementSettings[`${prefix}direction`] ?? "horizontal",
        navigation: false,
        pagination: false,
        breakpoints: {},
      };

      let enable_slider = elementSettings[`${prefix}enable_slider`] ?? true;
      swiperOptions.enabled = "yes" === enable_slider || true === enable_slider;
      // Setup slide per show.
      let slidesPerViewControl = `${prefix}slides_per_view`;
      if ("custom" === swiperOptions.slidesPerView) {
        swiperOptions.slidesPerView =
          elementSettings[`${prefix}custom_slides_per_view`] ?? "auto";
        slidesPerViewControl = `${prefix}custom_slides_per_view`;
      }

      // Setup autoplay.
      if (true === swiperOptions.autoplay) {
        swiperOptions.autoplay = {
          delay: elementSettings[`${prefix}autoplay_delay`] ?? 3000,
          disableOnInteraction:
            "yes" === elementSettings[`${prefix}autoplay_interaction`],
          reverseDirection:
            "yes" === elementSettings[`${prefix}reverse_direction`],
        };
      }

      if ("yes" === elementSettings[`${prefix}mousewheel`]) {
        swiperOptions.mousewheel = {
          releaseOnEdges: true,
        };
      }

      if ("yes" === elementSettings[`${prefix}navigation`]) {
        swiperOptions.navigation = {
          enabled: true,
          prevEl: `.elementor-element-${this.getID()} .cxf--arrow-prev`,
          nextEl: `.elementor-element-${this.getID()} .cxf--arrow-next`,
        };
      }

      if ("yes" === elementSettings[`${prefix}pagination`]) {
        swiperOptions.pagination = {
          enabled: true,
          el: `.elementor-element-${this.getID()} .swiper-pagination`,
          clickable: true,
          type: elementSettings[`${prefix}pagination_type`] ?? "bullets",
        };

        switch (swiperOptions.pagination.type) {
          case "fraction":
            swiperOptions.pagination.formatFractionCurrent = (num) =>
              ("0" + num).slice(-2);
            swiperOptions.pagination.formatFractionTotal = (num) =>
              ("0" + num).slice(-2);
            swiperOptions.pagination.renderFraction = (
              currentClass,
              totalClass
            ) =>
              `<span class="${currentClass}"></span>
                 <span class="mid-line"></span>
                 <span class="${totalClass}"></span>`;
            break;
          case "bullets":
            if (
              "number" === elementSettings[`${prefix}pagination_bullets_type`]
            ) {
              swiperOptions.pagination.renderBullet = function (
                index,
                className
              ) {
                return (
                  '<span class="' + className + '">' + (index + 1) + "</span>"
                );
              };
            }

            break;
        }
      }

      if ("yes" === elementSettings[`${prefix}slideshow_lazyload`]) {
        swiperOptions.lazy = {
          loadPrevNext: true,
          loadPrevNextAmount: 1,
        };
      }

      switch (swiperOptions.effect) {
        case "fade":
          swiperOptions.crossFade =
            "yes" === elementSettings[`${prefix}slideshow_lazyload`];
          break;

        case "coverflow":
          swiperOptions.slideShadows =
            "yes" === elementSettings[`${prefix}slide_shadows`];
          swiperOptions.depth =
            elementSettings[`${prefix}coverflow_depth`] ?? 100;
          swiperOptions.modifier =
            elementSettings[`${prefix}coverflow_modifier`] ?? 1;
          swiperOptions.rotate =
            elementSettings[`${prefix}coverflow_rotate`] ?? 50;
          swiperOptions.scale =
            elementSettings[`${prefix}coverflow_scale`] ?? 1;
          swiperOptions.stretch =
            elementSettings[`${prefix}coverflow_stretch`] ?? 100;
          break;
        case "coverflow":
          swiperOptions.limitRotation =
            "yes" === elementSettings[`${prefix}flip_limit_rotation`];
          swiperOptions.slideShadows =
            "yes" === elementSettings[`${prefix}slide_shadows`];
          break;
        case "cube":
          swiperOptions.shadow =
            "yes" === elementSettings[`${prefix}cube_shadow`];
          swiperOptions.slideShadows =
            "yes" === elementSettings[`${prefix}slide_shadows`];
          swiperOptions.shadowOffset =
            elementSettings[`${prefix}cube_shadow_offset`] ?? 20;
          swiperOptions.shadowScale =
            elementSettings[`${prefix}cube_shadow_scale`] ?? 0.94;
          break;

        case "cards":
          swiperOptions.rotate =
            "yes" === elementSettings[`${prefix}cards_rotate`];
          swiperOptions.slideShadows =
            "yes" === elementSettings[`${prefix}slide_shadows`];
          swiperOptions.perSlideOffset =
            elementSettings[`${prefix}cards_per_slide_offsett`] ?? 8;
          swiperOptions.perSlideRotate =
            elementSettings[`${prefix}cards_per_slide_rotate`] ?? 2;
          break;
      }

      swiperOptions.centeredSlides =
        "yes" === elementSettings[`${prefix}centered_slides`];

      const breakpoints = {};

      const activeBreakpoints =
        elementorFrontend.breakpoints.responsiveConfig.activeBreakpoints;

      // const activeBreakpoints =
      //   elementorFrontend.breakpoints.getActiveBreakpointsList();

      // console.log(activeBreakpoints);
      // console.log(elementorFrontend.breakpoints);
      // console.log(elementorFrontend.breakpoints.getDesktopMinPoint());

      for (let device in activeBreakpoints) {
        let slidesToShow = elementSettings[`${slidesPerViewControl}_${device}`];

        if (!slidesToShow) {
          slidesToShow = elementSettings[slidesPerViewControl];
        }

        if (!slidesToShow) {
          slidesToShow = "auto";
        }

        var navigation = swiperOptions.navigation ?? false;

        if ("yes" === elementSettings[`${prefix}navigation_${device}`]) {
          navigation = {
            enabled: true,
            prevEl: `.elementor-element-${this.getID()} .cxf--arrow-prev`,
            nextEl: `.elementor-element-${this.getID()} .cxf--arrow-next`,
          };
        }

        var pagination = swiperOptions.pagination ?? false;

        if ("yes" === elementSettings[`${prefix}pagination_${device}`]) {
          pagination = {
            enabled: true,
            el: `.elementor-element-${this.getID()} .swiper-pagination`,
            clickable: true,
            type: elementSettings[`${prefix}pagination_type`] ?? "bullets",
          };
        }

        let breakpoint =
          elementorFrontend.breakpoints.getDeviceMinBreakpoint(device);
        let enable_slider =
          elementSettings[`${prefix}enable_slider_${device}`] ?? true;

        // console.log(`${prefix}enable_slider_${device}`);
        // console.log(elementSettings[`${prefix}enable_slider_${device}`]);
        // console.log(enable_slider);
        // console.log(device);

        breakpoints[breakpoint] = {
          slidesPerView: slidesToShow,
          navigation: navigation,
          pagination: pagination,
          enabled: "yes" === enable_slider || true === enable_slider,
        };
      }

      var defaultBreakpointValue =
        elementorFrontend.breakpoints.getDesktopMinPoint();

      breakpoints[defaultBreakpointValue] = {
        enabled: swiperOptions.enabled ?? true,
        slidesPerView: swiperOptions.slidesPerView,
        navigation: swiperOptions.navigation ?? false,
        pagination: swiperOptions.pagination ?? false,
      };

      swiperOptions.breakpoints = breakpoints;

      return swiperOptions;
    },

    getSwiperThumbOptions(prefix = "cxf_thumb") {
      const elementSettings = this.getElementSettings();
      const swiperOptions = this.getSwiperOptions(prefix);
      const thumbOptions = { ...swiperOptions };

      prefix = `${prefix}_`;

      thumbOptions.loopAdditionalSlides =
        "custom" === elementSettings[`${prefix}loop_additional_slides`]
          ? elementSettings[`${prefix}loop_additional_slides`]
          : thumbOptions.slidesPerView;

      if ("custom" === thumbOptions.loopAdditionalSlides) {
        thumbOptions.loopAdditionalSlides =
          elementSettings[`${prefix}custom_loop_additional_slides`] ??
          thumbOptions.slidesPerView;
      }
      thumbOptions.watchSlidesProgress =
        "yes" === elementSettings[`${prefix}watch_slides_progress`];
      thumbOptions.slideToClickedSlide =
        "yes" === elementSettings[`${prefix}slide_to_clicked_slide`];

      return thumbOptions;
    },
  });

  const cxfSliderAction = ($element) => {
    elementorHandler.addHandler(cxfSliderHandler, {
      $element,
    });
  };

  const sliderWidgets = elementorHook.applyFilters("cxf/widgets/sliders", {
    "cxf--portfolio": ["skin-portfolio-one", "skin-portfolio-two"],
  });

  for (const [widget, skins] of Object.entries(sliderWidgets)) {
    elementorHook.addAction(
      `frontend/element_ready/${widget}.default`,
      cxfSliderAction
    );

    if (skins.length > 0) {
      skins.forEach((skin) => {
        elementorHook.addAction(
          `frontend/element_ready/${widget}.${skin}`,
          cxfSliderAction
        );
      });
    }
  }
};

window.addEventListener("elementor/frontend/init", cxfSliderCallback);

// window.addEventListener("resize", cxfSliderCallback);
