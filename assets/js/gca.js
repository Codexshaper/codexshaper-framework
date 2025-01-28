(function (global, factory) {
  typeof exports === "object" && typeof module !== "undefined"
    ? factory(exports)
    : typeof define === "function" && define.amd
    ? define(["exports"], factory)
    : ((global = global || self),
      factory((global.window = global.window || {})));
})(this, function (exports) {
  "use strict";

  window.addEventListener("elementor/frontend/init", function () {
    const elementorFrontendBase = elementorModules.frontend.handlers.Base;
    const elementorHandler = elementorFrontend.elementsHandler;
    const elementorHook = elementorFrontend.hooks;

    let breakpoints = elementorFrontend.config.responsive.activeBreakpoints,
      i = elementorModules.frontend.handlers.Base,
      smoothAmount = 1.35,
      isSmoother = false,
      isMobileSmoother = false,
      t = jQuery;

    if (CXF_LOCALIZE_JS.cxf_animation) {
      let cxf_animation = CXF_LOCALIZE_JS.cxf_animation;
      smoothAmount = cxf_animation.smooth_amount ?? 1.35;
      isSmoother = cxf_animation.smooth_scroller ?? false;
      isMobileSmoother = cxf_animation.mobile_smooth_scroller ?? false;
    }

    var matchMedia = gsap.matchMedia();

    var smootherOption = {
      smooth: smoothAmount,
      effects: true,
      smoothTouch: 0.1,
      normalizeScroll: false,
      ignoreMobileResize: true,
    };

    if ("function" == typeof ScrollSmoother && "object" === typeof gsap) {
      // Enable smooth scrolling for large devices.
      if (isSmoother) {
        matchMedia.add("(min-width: 768px)", function () {
          ScrollSmoother.create(smootherOption);
        });
      }

      // Enable smooth scrolling for mobile devices.
      if (isMobileSmoother) {
        matchMedia.add("(max-width: 767px)", function () {
          ScrollSmoother.create(smootherOption);
        });
      }
    }

    const animationHandler = elementorFrontendBase.extend({
      bindEvents() {
        let animationType = this.getElementSettings("cxf_animation_type");
        if (
          "fade" === animationType &&
          (!this.isEdit ||
            this.getElementSettings("cxf_enable_animation_editor"))
        ) {
          this.fadeAnimation();
        }

        if ("widget" === this.getElementType()) {
          this.textAnimation();
          this.imageAnimation();
        }

        if (this.getElementSettings("cxf_enable_horizontal_scroll")) {
          this.horizontalScrollAnimation();
        }

        this.buttonAnimation();
      },
      textAnimation() {
        var self = this;
        var media = "all";
        var textAnimation = this.getElementSettings("cxf_text_animation");
        var elementContainer = this.findElement(".elementor-widget-container");
        var elementCount = elementContainer.children().length;
        var lastElement = jQuery(elementContainer.children()[elementCount - 1]);
        var animationBreakpoint = this.getElementSettings(
          "cxf_text_animation_breakpoint"
        );

        var duration = this.getElementSettings("cxf_text_animation_duration"),
          stagger = this.getElementSettings("cxf_text_animation_stagger"),
          translateX = this.getElementSettings(
            "cxf_text_animation_translate_x"
          ),
          translateY = this.getElementSettings(
            "cxf_text_animation_translate_y"
          ),
          scrollTrigger = this.getElementSettings(
            "cxf_text_animation_on_scroll"
          ),
          delay = this.getElementSettings("cxf_text_animation_delay");

        // Handle breakpoint settings
        if (animationBreakpoint) {
          var breakpoint = breakpoints[animationBreakpoint].value;
          media =
            this.getElementSettings("cxf_text_animation_breakpoint_min_max") ===
            "min"
              ? `min-width: ${breakpoint}px`
              : `max-width: ${breakpoint}px`;
        }

        switch (textAnimation) {
          case "char":
          case "word":
            var animationSettings = {
              duration: duration,
              autoAlpha: 0,
              delay: delay,
              stagger: stagger,
            };
            if (translateX) animationSettings.x = translateX;
            if (translateY) animationSettings.y = translateY;
            if (scrollTrigger) {
              animationSettings.scrollTrigger = {
                trigger: lastElement,
                start: "top 90%",
              };
            }

            var splitTextInstance = new SplitText(lastElement, {
              type: "chars, words",
            });
            var animatedElements =
              textAnimation === "word"
                ? splitTextInstance.words
                : splitTextInstance.chars;

            this.applyTextAnimation(animatedElements, animationSettings, media);
            break;

          case "text_move":
            var rotationDirection = this.getElementSettings(
                "cxf_text_animation_rotation_direction"
              ),
              rotation = this.getElementSettings("cxf_text_animation_rotation"),
              transformOrigin = this.getElementSettings(
                "cxf_text_animation_transform_origin"
              );

            var moveSettings = {
              duration: duration,
              delay: delay,
              opacity: 0,
              force3D: true,
              transformOrigin,
              stagger: stagger,
            };

            if (rotationDirection === "x") moveSettings.rotationX = rotation;
            if (rotationDirection === "y") moveSettings.rotationY = rotation;

            var scrollTriggerSettings = {};
            if (scrollTrigger) {
              scrollTriggerSettings.scrollTrigger = {
                trigger: lastElement,
                duration: 2,
                start: "top 90%",
                end: "bottom 60%",
                scrub: false,
                markers: false,
                toggleActions: "play none none none",
              };
            }

            var timeline = gsap.timeline(scrollTriggerSettings);

            if (media === "all") {
              self.applyTextMoveAnimation(timeline, lastElement, moveSettings);
            } else {
              matchMedia.add(
                `(${media})`,
                function () {
                  var splitTextMove = self.applyTextMoveAnimation(
                    timeline,
                    lastElement,
                    moveSettings
                  );
                  return function () {
                    splitTextMove.revert();
                    timeline.revert();
                  };
                }.bind(this)
              );
            }
            break;

          case "text_reveal":
            var revealSettings = {
              duration: duration,
              delay: delay,
              ease: "circ.out",
              y: 80,
              stagger: stagger,
              opacity: 0,
            };

            if (scrollTrigger) {
              revealSettings.scrollTrigger = {
                trigger: lastElement,
                start: "top 85%",
              };
            }

            var splitTextReveal = new SplitText(lastElement, {
              type: "lines, words, chars",
              linesClass: "cxf-reveal-line",
            });

            this.applyTextAnimation(
              splitTextReveal.chars,
              revealSettings,
              media
            );
            break;

          case "text_invert":
            var textColor = lastElement.css("color");

            // Convert RGB to HSL
            var hslColor = this.rgbToHsl(
              textColor.match(/\d+/g)[0],
              textColor.match(/\d+/g)[1],
              textColor.match(/\d+/g)[2]
            );

            var hue = hslColor[0].toFixed(1);
            var saturation = hslColor[1].toFixed(1);
            var lightness = hslColor[2].toFixed(1);
            var hslFormatted = `${hue}, ${saturation}%, ${lightness}%`;

            lastElement.css("--text-color", hslFormatted);

            if (media === "all") {
              this.applyTextInvertAnimation(lastElement);
            } else {
              matchMedia.add(
                `(${media})`,
                function () {
                  var splitTextInvert =
                    this.applyTextInvertAnimation(lastElement);
                  return function () {
                    splitTextInvert.revert();
                  };
                }.bind(this)
              );
            }
            break;
        }
      },
      applyTextAnimation(selector, animationSettings, media = "all") {
        if (media === "all") {
          gsap.from(selector, animationSettings);
        } else {
          matchMedia.add(`(${media})`, function () {
            gsap.from(selector, animationSettings);
            return function () {
              selector.revert();
            };
          });
        }
      },
      applyTextMoveAnimation(timeline, element, options) {
        var splitTextMove = new SplitText(element, { type: "lines" });
        gsap.set(element, { perspective: 400 });
        timeline.from(splitTextMove.lines, options);

        return splitTextMove;
      },
      applyTextInvertAnimation(element) {
        var splitTextInvert = new SplitText(element, {
          type: "lines",
          linesClass: "cxf-invert-line",
        });

        splitTextInvert.lines.forEach(function (line) {
          gsap.to(line, {
            backgroundPositionX: 0,
            ease: "none",
            scrollTrigger: {
              trigger: line,
              scrub: 1,
              start: "top 85%",
              end: "bottom center",
            },
          });
        });

        return splitTextInvert;
      },
      rgbToHsl(r, g, b) {
        r /= 255;
        g /= 255;
        b /= 255;
        var max = Math.max(r, g, b),
          min = Math.min(r, g, b);
        var h,
          s,
          l = (max + min) / 2;

        if (max == min) {
          h = s = 0;
        } else {
          var d = max - min;
          s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
          switch (max) {
            case r:
              h = (g - b) / d + (g < b ? 6 : 0);
              break;
            case g:
              h = (b - r) / d + 2;
              break;
            case b:
              h = (r - g) / d + 4;
              break;
          }
          h /= 6;
        }
        return [h * 360, s * 100, l * 100];
      },
      imageAnimation() {
        const animationType = this.getElementSettings("cxf_image_animation");
        var element = this.$element,
          imgElement = this.findElement("img"),
          imgParent = imgElement.parent();

        if (animationType === "reveal") {
          // Set styles for parent elements to hide overflow and ensure visibility settings
          imgParent.parent().css("overflow", "hidden");
          imgParent.css({
            overflow: "hidden",
            display: "block",
            visibility: "hidden",
            transition: "none",
          });

          var ease = this.getElementSettings("cxf_image_animation_ease"),
            hasEffect = false,
            effectClass = "";

          let effects = [
            "effect-zoom-in",
            "effect-zoom-out",
            "left-move",
            "right-move",
          ];
          // Remove any existing image effect classes from the element
          effects.forEach(function (effect) {
            const effectClass = `cxf--image-${effect}`;
            if (element.hasClass(effectClass)) {
              hasEffect = true;
              element.removeClass(effectClass);
            }
          });

          // Set initial visibility and add animation sequence
          let tl = gsap.timeline({
            scrollTrigger: {
              trigger: element,
              start: "top 50%",
            },
          });

          tl.set(imgParent, { autoAlpha: 1 });

          tl.from(imgParent, 1.5, {
            xPercent: -100,
            ease: ease,
            onComplete: function () {
              if (hasEffect) {
                element.addClass(effectClass);
                hasEffect = false;
              }
            },
          });

          tl.from(imgElement, 1.5, {
            xPercent: 100,
            scale: 1.3,
            delay: -1.5,
            ease: ease,
          });
        }

        if (animationType === "scale") {
          var animationFrom = this.getElementSettings(
              "cxf_image_animation_from"
            ),
            scaleStart = this.getElementSettings(
              "cxf_image_animation_scale_start"
            ),
            scaleEnd = this.getElementSettings("cxf_image_animation_scale_end"),
            ease = this.getElementSettings("cxf_image_animation_ease");

          // Set custom animation start if applicable
          if (animationFrom === "custom") {
            animationFrom = this.getElementSettings(
              "cxf_image_animation_custom_start"
            );
          }

          // Set overflow hidden on parent container
          imgParent.css("overflow", "hidden");

          // Initial scale setup
          gsap.set(imgElement, { scale: scaleStart });

          // Scale animation with ScrollTrigger
          gsap.to(imgElement, {
            scrollTrigger: {
              trigger: this.$element,
              start: animationFrom,
              scrub: true,
            },
            scale: scaleEnd,
            ease: ease,
          });
        }

        if (animationType === "stretch") {
          let imgElement = this.findElement("img"),
            imgParent = imgElement.parent();

          // Set padding and disable transition for the parent element
          imgParent.css({
            paddingBottom: "395px",
            transition: "none",
          });

          // Create timeline animation for the stretch effect
          gsap
            .timeline({
              scrollTrigger: {
                trigger: imgParent,
                start: "top top",
                pin: true,
                scrub: 1,
                pinSpacing: false,
                end: "bottom bottom+=100",
              },
            })
            .to(imgElement, {
              width: "100%",
              borderRadius: "0px",
            });
        }
      },
      fadeAnimation() {
        var element = this.$element;

        var type = this.getElementSettings("cxf_animation_from"),
          duration = this.getElementSettings("cxf_animation_duration"),
          offset = this.getElementSettings("cxf_animation_offset"),
          delay = this.getElementSettings("cxf_animation_delay"),
          ease = this.getElementSettings("cxf_animation_ease"),
          media = "all";

        var options = {
          opacity: 0,
          ease: ease,
          duration: duration,
          delay: delay,
        };

        switch (type) {
          case "top":
            options.y = -offset;
            break;
          case "bottom":
            options.y = offset;
            break;
          case "left":
            options.x = -offset;
            break;
          case "right":
            options.x = offset;
            break;
        }

        if (true == this.getElementSettings("cxf_animation_on_scroll")) {
          options.scrollTrigger = {
            trigger: element,
            start: "top 85%",
          };
        }

        element.css("transition", "none");

        if (this.getElementSettings("cxf_animation_breakpoint")) {
          var breakpoint =
            breakpoints[this.getElementSettings("cxf_animation_breakpoint")]
              .value;
          media =
            "min" ===
            this.getElementSettings("cxf_animation_breakpoint_min_max")
              ? `(min-width: ${breakpoint}px)`
              : `(max-width: ${breakpoint}px)`;

          matchMedia.add(media, function () {
            return gsap.from(element, options);
          });
        }

        if ("all" === media) {
          gsap.from(element, options);
        }
      },
      buttonAnimation() {
        var btnWrapper = this.findElement(".btn-wrapper"),
          hoverBgChange = this.findElement(".btn-hover-bgchange"),
          btnItem = this.findElement(".btn-item"),
          btnWrapperWidth = btnWrapper.width(),
          btnWrapperHeight = btnWrapper.height();

        if (btnWrapper.length) {
          var handleMouseMove = function (event, target, factor) {
            var offsetX = event.pageX - btnWrapper.offset().left,
              offsetY = event.pageY - btnWrapper.offset().top,
              moveX =
                ((offsetX - btnWrapperWidth / 2) / btnWrapperWidth) * factor,
              moveY =
                ((offsetY - btnWrapperHeight / 2) / btnWrapperHeight) * factor;

            gsap.to(target, 0.5, {
              x: moveX,
              y: moveY,
              ease: Power2.easeOut,
            });
          };

          // Add mousemove and mouseleave events for button animation
          btnWrapper.mousemove(function (event) {
            handleMouseMove(event, btnItem, 80);
          });

          btnWrapper.mouseleave(function () {
            gsap.to(btnItem, 0.5, { x: 0, y: 0, ease: Power2.easeOut });
          });
        }

        if (hoverBgChange.length) {
          var hoverSpan = document.createElement("span");
          hoverBgChange.append(hoverSpan);

          // Add mouseenter and mouseout events for background hover effect
          hoverBgChange.on("mouseenter", function (event) {
            var offsetX = event.pageX - jQuery(this).offset().left,
              offsetY = event.pageY - jQuery(this).offset().top;

            jQuery(this).find("span").css({ top: offsetY, left: offsetX });
          });

          hoverBgChange.on("mouseout", function (event) {
            var offsetX = event.pageX - jQuery(this).offset().left,
              offsetY = event.pageY - jQuery(this).offset().top;

            jQuery(this).find("span").css({ top: offsetY, left: offsetX });
          });
        }
      },
      horizontalScrollAnimation() {
        var self = this;
        let scrollContainer = this.$element.children();
        let scrollParent = this.$element;
        let scrollWidthInput = this.getElementSettings(
          "cxf_horizontal_scroll_width"
        );
        let scrollWidth = `${scrollWidthInput.size}${scrollWidthInput.unit}`;
        let media = "all";
        let breakpoint;
        let triggerOptions = {
          trigger: scrollParent,
          pin: true,
          scrub: 1,
        };

        if (this.$element.hasClass("e-con-boxed")) {
          scrollParent = this.$element.children();
          scrollContainer = this.$element.children(".e-con-inner").children();
        }

        if (!scrollContainer.length) return;
        scrollParent.addClass("cxf-horizontal-scroll");

        // Custom pin element override
        if (this.getElementSettings("cxf_custom_horizontal_element")) {
          triggerOptions.pin = this.getElementSettings(
            "cxf_custom_horizontal_element"
          );
        }

        // Custom pin scrub override
        if (this.getElementSettings("cxf_horizontal_scrub") === "no") {
          triggerOptions.scrub = false;
        }

        if (this.getElementSettings("cxf_horizontal_scrub") === "yes") {
          triggerOptions.scrub = true;
        }

        if (this.getElementSettings("cxf_horizontal_scrub") === "custom") {
          triggerOptions.scrub = this.getElementSettings(
            "cxf_horizontal_scrub_custom"
          );
        }

        if (this.getElementSettings("cxf_horizontal_toggle_actions_custom")) {
          triggerOptions.toggleActions = this.getElementSettings(
            "cxf_horizontal_toggle_actions_custom"
          );
        }

        if (
          (breakpoint = this.getElementSettings(
            "cxf_horizontal_scroll_breakpoint"
          ))
        ) {
          media = `min-width: (${breakpoints[breakpoint].value + 1}px)`;
          matchMedia.add(media, () => {
            self.setHorizontalScroll(
              scrollContainer,
              scrollParent,
              scrollWidth,
              triggerOptions
            );
            return () =>
              scrollParent.css({
                width: "var(--width)",
                "max-width": "min(100%,var(--width))",
                height: "auto",
              });
          });
        }

        if (media === "all") {
          this.setHorizontalScroll(
            scrollContainer,
            scrollParent,
            scrollWidth,
            triggerOptions
          );
        }
      },
      setHorizontalScroll(
        scrollContainer,
        scrollParent,
        scrollWidth,
        triggerOptions
      ) {
        scrollParent.css({
          width: scrollWidth,
          "max-width": scrollWidth,
          transition: "none",
          height: "100%",
        });
        scrollContainer.css({ transition: "none", height: "100%" });
        gsap.to(scrollContainer, {
          xPercent: -100 * (scrollContainer.length - 1),
          ease: "none",
          scrollTrigger: triggerOptions,
        });
      },
    });

    const animationAction = ($element) => {
      elementorHandler.addHandler(animationHandler, {
        $element,
      });
    };

    elementorHook.addAction("frontend/element_ready/widget", animationAction);

    elementorHook.addAction(
      "frontend/element_ready/container",
      animationAction
    );

    const globalAnimationHandler = elementorFrontendBase.extend({
      bindEvents() {
        const elementType = this.getElementType();
        if (
          !this.isEdit &&
          (elementType === "section" || elementType === "container")
        ) {
          if (this.getElementSettings("cxf_enable_sticky") === "yes") {
            var pinBreakpoint = this.getElementSettings("cxf_pin_breakpoint");

            if (
              pinBreakpoint &&
              jQuery(window).width() > breakpoints[pinBreakpoint].value
            ) {
              this.stickyAnimation();
            } else {
              this.stickyAnimation();
            }
          }
        }
      },
      stickyAnimation() {
        var triggerElement = this.$element;
        var pinElement = this.$element;
        var pinStart = this.getElementSettings("cxf_sticky_start");
        var pinEnd = this.getElementSettings("cxf_sticky_end");
        var pinDelay = this.getElementSettings("cxf_sticky_delay");
        var toggleActions = this.getElementSettings(
          "cxf_sticky_toggle_actions"
        );

        var triggerOptions = {
          trigger: triggerElement,
          pin: pinElement,
          pinSpacing: false,
          start: pinStart,
          end: pinEnd,
          delay: pinDelay,
          toggleActions: toggleActions,
        };

        // Handle custom start settings
        if (pinStart === "custom") {
          triggerOptions.start = this.getElementSettings(
            "cxf_sticky_start_custom"
          );
        }

        // Handle custom end settings
        if (pinEnd === "custom") {
          triggerOptions.end = this.getElementSettings("cxf_sticky_end_custom");
        }

        // Custom trigger override
        if (this.getElementSettings("cxf_custom_sticky_trigger")) {
          triggerOptions.trigger = this.getElementSettings(
            "cxf_custom_sticky_trigger"
          );
        }

        // Custom pin element override
        if (this.getElementSettings("cxf_custom_sticky_element")) {
          triggerOptions.pin = this.getElementSettings(
            "cxf_custom_sticky_element"
          );
        }

        // Custom pin container element override
        if (this.getElementSettings("cxf_sticky_container")) {
          triggerOptions.pinnedContainer = this.getElementSettings(
            "cxf_sticky_container"
          );
        }

        // Custom pin reparent override
        if (this.getElementSettings("cxf_sticky_reparent") === "yes") {
          triggerOptions.pinReparent = true;
        }

        // Custom pin spacer override
        if (this.getElementSettings("cxf_sticky_spacer")) {
          triggerOptions.pinSpacer =
            this.getElementSettings("cxf_sticky_spacer");
        }

        // Custom pin spacing override
        if (this.getElementSettings("cxf_sticky_spacing") === "no") {
          triggerOptions.pinSpacing = false;
        }

        if (this.getElementSettings("cxf_sticky_spacing") === "yes") {
          triggerOptions.pinSpacing = true;
        }

        if (this.getElementSettings("cxf_sticky_spacing") === "custom") {
          triggerOptions.pinSpacing = this.getElementSettings(
            "cxf_sticky_spacing_custom"
          );
        }

        // Custom pin type override
        if (this.getElementSettings("cxf_sticky_type") != "default") {
          triggerOptions.pinType = this.getElementSettings("cxf_sticky_type");
        }

        // Custom pin scrub override
        if (this.getElementSettings("cxf_sticky_scrub") === "no") {
          triggerOptions.scrub = false;
        }

        if (this.getElementSettings("cxf_sticky_scrub") === "yes") {
          triggerOptions.scrub = true;
        }

        if (this.getElementSettings("cxf_sticky_scrub") === "custom") {
          triggerOptions.scrub = this.getElementSettings(
            "cxf_sticky_scrub_custom"
          );
        }

        if (this.getElementSettings("cxf_sticky_toggle_actions_custom")) {
          triggerOptions.toggleActions = this.getElementSettings(
            "cxf_sticky_toggle_actions_custom"
          );
        }

        // Disable transition
        this.$element.css("transition", "none");

        // Pin area animation using gsap
        gsap.to(this.$element, {
          scrollTrigger: triggerOptions,
        });
      },
    });

    const globalAnimationAction = ($element) => {
      elementorHandler.addHandler(globalAnimationHandler, {
        $element,
      });
    };

    elementorHook.addAction(
      "frontend/element_ready/global",
      globalAnimationAction
    );

    const popupAnimationHandler = elementorFrontendBase.extend({
      bindEvents: function () {
        if (!this.getElementSettings("cxf_enable_popup")) return;
        var eneablePopupEditor = this.getElementSettings(
          "cxf_enable_popup_editor"
        );
        var isEditEnable = this.isEdit && !eneablePopupEditor;
        var self = this;

        if (isEditEnable) {
          jQuery.magnificPopup.close({
            items: {
              src: jQuery('<div id="cxf-popup" class="cxf-popup"></div>'),
              type: "inline",
            },
          });
        }

        this.$element.on("click", (event) => {
          event.preventDefault();

          if (isEditEnable) {
            self.runAjax();
          }
        });
      },

      runAjax: function () {
        const animationClass = this.getElementSettings("cxf_popup_animation");
        const animationDelay = this.getElementSettings(
          "cxf_popup_animation_delay"
        );

        jQuery.ajax({
          url: CXF_LOCALIZE_JS.ajaxUrl,
          type: "POST",
          dataType: "json",
          data: {
            action: "cxf_load_popup_content",
            widget_id: this.getID(),
            post_id: CXF_LOCALIZE_JS.post_id,
            nonce: CXF_LOCALIZE_JS.cxf_nonce,
          },
          success: (response) => {
            const popupContent = {
              removalDelay: animationDelay,
              items: {
                src: jQuery(
                  `<div id="cxf-popup" class="cxf-popup">${response.html}</div>`
                ),
                type: "inline",
              },
              callbacks: {
                beforeOpen: function () {
                  this.st.mainClass = animationClass;
                },
              },
            };

            jQuery.magnificPopup.open(popupContent);
          },
        });
      },
    });
  });
});
