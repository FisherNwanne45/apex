var Roibox = new Class({
  init: function (handle, options) {
    this.options = $extend(
      {
        resizeDuration: 400,
        resizeTransition: false, // default transition
        initialWidth: 250,
        initialHeight: 250,
        finalWidth: 360,
        finalHeight: 253,
        popupSrc: "index.php",
      },
      options || {}
    );

    if (!handle) {
      this.load();
    } else {
      $(handle).addEvent("click", this.load.bind(this));
    }

    this.eventKeyDown = this.keyboardListener.bindAsEventListener(this);
    this.eventPosition = this.position.bind(this);
  },

  load: function () {
    // Shaded overlay
    this.overlay = new Element("div", { id: "lbOverlay" }).injectInside(
      document.body
    );
    this.overlay.addEvent("click", this.close.bind(this));

    // Lightbox Wrapper
    this.frame = new Element("div", {
      id: "lbFrame",
      width: this.options.initialWidth,
      height: this.options.initialHeight,
      marginLeft: -(this.options.initialWidth / 2),
      display: "",
    }).injectInside(document.body);

    // Area above popup
    this.header = new Element("div", {
      id: "lbHeader",
      width: "100%",
      height: "30px",
    }).injectInside(this.frame);

    this.closeLink = new Element("a", {
      href: "javascript:void(0);",
    }).injectInside(this.header);
    this.closeLink.innerHTML =
      '<img src="/view/tal/tallibrary/closeButton.png" alt="close button" />';
    // this.closeLink.addEvent( 'click', this.close.bind(this) );
    this.header.addEvent("click", this.close.bind(this));
    this.iframe = new Element("iframe", {
      id: "lbIframe",
      src: this.options.popupSrc,
      width: "100%",
      frameborder: 0,
      height: this.options.finalHeight,
    }).injectInside(this.frame);

    if (window.gecko) {
      this.overlay.addClass("geckoShadow");
    } else {
      this.overlay.addClass("nonGeckoShadow");
    }

    this.fx = {
      overlay: this.overlay.effect("opacity", { duration: 500 }).hide(),
      resize: this.frame.effects(
        $extend(
          { duration: this.options.resizeDuration },
          this.options.resizeTransition
            ? { transition: this.options.resizeTransition }
            : {}
        )
      ),
      iframe: this.iframe.effect("opacity", { duration: 500 }),
    };

    this.position();

    this.setup(true);
    this.frame.setStyles({
      top: window.getScrollTop() + window.getHeight() / 15,
      display: "",
      marginLeft: -(this.options.initialWidth / 2),
    });

    if (window.gecko) {
      this.fx.overlay.start(1.0);
    } else {
      this.fx.overlay.start(0.8);
    }

    this.fx.resize.start({
      height: this.options.finalHeight + 30,
      width: this.options.finalWidth + 0,
      marginLeft: -(this.options.finalWidth / 2),
    });
    return true;
  },

  position: function () {
    this.overlay.setStyles({
      top: window.getScrollTop(),
      height: window.getHeight(),
    });
  },

  setup: function (open) {
    // var elements = $A(document.getElementsByTagName('object'));
    // elements.extend(document.getElementsByTagName(window.ie ? 'select' : 'embed'));
    // elements.each(function(el){
    // 	if (open) el.lbBackupStyle = el.style.visibility;
    // 	el.style.visibility = open ? 'hidden' : el.lbBackupStyle;
    // });
    var fn = open ? "addEvent" : "removeEvent";
    //		window[fn]('scroll', this.eventPosition)[fn]('resize', this.eventPosition);
    //		document[fn]('keydown', this.eventKeyDown);

    if (!open) {
      this.overlay.remove();
      this.frame.remove();
    }

    this.step = 0;
  },
  keyboardListener: function (event) {
    switch (event.keyCode) {
      case 27:
      case 88:
      case 67:
        this.close();
        break;
    }
  },

  close: function () {
    if (this.step < 0) return;
    this.step = -1;
    for (var f in this.fx) this.fx[f].stop();

    this.fx.resize.start({
      height: this.options.initialHeight,
      width: this.options.initialWidth,
      marginLeft: -this.options.initialWidth / 2,
    });

    this.fx.overlay.chain(this.setup.pass(false, this)).start(0);
    return false;
  },
});
