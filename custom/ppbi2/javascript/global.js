//
// Global Variables
//

var $j = jQuery.noConflict(),
  alertText =
    "Please be advised that you are leaving <?php echo $name; ?> 's website. This link is provided as a courtesy. <?php echo $name; ?> does not endorse or control the content of third party websites.",
  investorText =
    "Please be advised that you are leaving <?php echo $name; ?> 's website and will be taken to <?php echo $name; ?> which is the Holding Company of <?php echo $name; ?> . This link is provided as a courtesy.",
  elanAlertText =
    "Please be advised that you are are leaving <?php echo $name; ?> 's website and are being redirected to Elan Financial Service's website. This link is provided as a courtesy. <?php echo $name; ?> does not endorse or control the content of third party websites.",
  customFolder = "ppbi2",
  slideSpeed = 300,
  tabEffect = "fade",
  overlayColorVar = "#111", // Set FancyBox Background Color
  addthis_config = { ui_click: true };

// This avoids javascript errors for browsers that don't define the console object.
if (typeof console == "undefined") {
  console = {
    log: function (msg) {},
  };
}

//
// Document Ready Event
//

$j(document).ready(function () {
  // REMOVE WHEN STARTING PROGRAMMING!
  // shows the gray images for product category pages
  addDummyImages();
  // ^^ REMOVE ^^

  if ($j(".sbaLoans").length) {
    $j("h3").each(function () {
      $j(this).nextUntil("h3").andSelf().wrapAll('<div class="section"></div>');
    });
  }

  if ($j(".quote").length) {
    $j(".quote:even").addClass("even");
    $j(".quote:odd").addClass("odd");
  }

  if ($j("#letsTalkSBA").length) {
    $j("h2").each(function () {
      $j(this).nextUntil("h2").wrapAll('<div class="stateSection"></div>');
    });

    $j(".stateSection strong").parent().parent().addClass("name");
    $j(".stateSection a").parent().parent().addClass("email");

    $j(".stateSection .name").each(function () {
      $j(this)
        .nextUntil("br")
        .andSelf()
        .wrapAll('<div class="representative"></div>');
    });
  }

  if ($j(".downstream").length) {
    imageSwitch();
  }

  if ($j(".sports").length) {
    setupSports();
  }

  $j("body").removeClass("noJs").addClass("js");

  // Product Page
  if ($j("#home").length) {
    setupBanner();
  } else if ($j("#productPage").length) {
    setupProductPage();
  } else if ($j("#applicationPage").length) {
    setupApplicationPage();
  }

  if ($j("#home.test").length) {
    var cookieName;

    if ($j("#enablePopup").length) {
      cookieName = $j("#enablePopup").text();

      if (!readCookie(cookieName)) {
        createCookie(cookieName, 3);
        $j.fancybox("http://www.<?php echo $url; ?>/popup/home-popup.php", {
          hideOnContentClick: false,
          width: 765,
          height: 455,
          onStart: function () {
            $j("#fancybox-outer").css({ background: "transparent" });
            $j(
              "#fancybox-bg-n,#fancybox-bg-ne,#fancybox-bg-e,#fancybox-bg-se,#fancybox-bg-s,#fancybox-bg-sw,#fancybox-bg-w,#fancybox-bg-nw"
            ).css({ "background-image": "none" });
            $j("#fancybox-content").css({ border: "none" });
            $j("#fancybox-close").css({ right: "15px" });
          },
          overlayOpacity: 0.8,
          centerOnScroll: false,
          type: "iframe",
        });
      }
    }
  }

  if ($j("#contactUs").length || $j("#applicationPage").length) {
    $j("iframe").remove();
  }

  if ($j("#newsEvents.accordion").length) {
    newsAccordion();
  }

  if ($j("#searchPage").length) {
    $j("#searchPage").hide();
  }

  setOverLabelWrappers();

  doOnlineBanking();
  // Browser safe version of console.log().
  //consoleLog('It works.');
});

//
// Window Load Event
//

$j(window).load(function () {
  setSpeedBumps();
  setPopups();
  setClickableContainers();
  createOblDropDown();
  changeLoginType();

  if ($j("#locationsPage").length) {
    setupLocationsPage();
  }

  if ($j("#searchPage").length) {
    setupSearchPage();
    $j("#froisearch-button").after("").attr("value", "Submit");
    $j("#searchPage").show();
  }
  $j("#leftNav > li").has("ul").addClass("hasChildren");

  //setTargetBlanks(); 			// Uncomment, if needed.
  setTargetParent();
  setPrintLinks($j("#productPage .print, #productBlurb .print"));
  setupSharePopup();

  // empty out search field
  document.getElementById("roi_input").value = "";
  // empty out online banking
  document.getElementById("usernamet").value = "";
});

//
// Function Definitions
//

function confirmAlert(url) {
  jConfirm(alertText, "Confirm", function (r) {
    if (r) {
      window.open(url);
    } else {
      return false;
    }
  });
  return false;
}

function investorAlert(url) {
  jConfirm(investorText, "Confirm", function (r) {
    if (r) {
      window.open(url);
    } else {
      return false;
    }
  });
  return false;
}

function elanAlert(url) {
  jConfirm(elanAlertText, "Confirm", function (r) {
    if (r) {
      window.open(url);
    } else {
      return false;
    }
  });
  return false;
}

function confirmAlert2(url) {
  if (!confirmAlert(url)) return false;
}

// Online Banking Dropdown
function createOblDropDown() {
  var source = $j("#loginTo");
  var selected = source.find("option:first-child"); // get selected <option>
  var options = $j("option", source); // get all <option> elements

  // create <dl> and <dt> with selected value inside it
  $j("#obForm").prepend('<dl id="target" class="dropdown"></dl>');
  $j("#target").append(
    "<dt><a>" +
      selected.text() +
      '<span class="value">' +
      selected.val() +
      "</span></a></dt>"
  );
  $j("#target").append("<dd><ul></ul></dd>");

  // iterate through all the <option> elements and create UL
  options.each(function () {
    $j("#target dd ul").append(
      "<li><a>" +
        $j(this).text() +
        '<span class="value">' +
        $j(this).val() +
        "</span></a></li>"
    );
  });

  $j(".dropdown dt a").click(function () {
    $j(".dropdown dd ul").slideToggle("fast");
  });

  $j(".dropdown dd ul li a").click(function () {
    var text = $j(this).php();
    $j(".dropdown dt a").php(text);
    $j(".dropdown dd ul").hide();
    var source = $j("#loginTo");
    source.val($j(this).find("span.value").php());
    console.log(source.val());
  });

  $j("#obNav li.business").hide();
}

function changeLoginType() {
  $j(".dropdown dd ul").click(function () {
    var str = $j("#target dt a span").text();
    console.log(str);

    if (str == "Business eBanking") {
      $j("#user").hide();
      console.log(str);
    } else {
      $j("#user").show();
      console.log(str);
    }
  });
}

function doOnlineBanking() {
  $j("#obForm").submit(function () {
    var str = $j("#target dt a span").text();
    var checkUser = $j("#usernamet").val();

    var setUsername = checkUser;
    $j("#username").val(setUsername);

    // console.log(str);
    // console.log(checkUser);
    // console.log(checkCompany);
    if (str == "Business eBanking") {
      window.open("/", "_parent");
      return false;
    } else if (str == "- Select Login Type -") {
      alert("Please choose your online banking type.");
      return false;
    } else if (setUsername == "") {
      alert("Please enter your User ID");
      return false;
    } else {
      return true;
    }
  });
}

function oblFormSubmit() {
  var checkType = $j("#target dt a span").text();

  console.log(checkType);
}

// clickable container
function clickableContainer(target) {
  target

    .click(function () {
      // Get the anchor tag.
      var a = $j(this).find("a");

      // Get the href.
      var href = a.attr("href");
      // Make sure there's an href.
      if (!href) return false;

      // Check if we need to show a speedbump.
      var showSpeedBump = a.hasClass("confirm");
      if (showSpeedBump) {
        confirmAlert(href);
      }
      // Don't need to show speedbump.
      // Open PDFs and target=_blank in new window.
      else if (href.indexOf(".pdf") >= 0 || a.attr("target") == "_blank") {
        // Open in a new window.
        window.open(href);
      } else {
        // Open in current window.
        window.location = href;
      }

      return false;
    })
    .addClass("clickable");
}

function newsAccordion() {
  var newsHeading = $j("#newsEvents h3");
  var toggleHeading = $j(".toggle");

  // set up headings
  newsHeading.each(function () {
    $j(this).nextUntil(".item").wrapAll('<div class="itemContent"></div>');

    if ($j(this).next(".itemContent").length) {
      $j(this).addClass("toggle");
    } else {
      $j(this).addClass("link");
    }
  });

  $j(".toggle").click(function () {
    $j(this).toggleClass("selected").next().slideToggle();
  });

  if (location.hash) {
    $j(location.hash).find("h3").addClass("clicked").click();
    console.log(location.hash);
  } else {
    $j("#1 > h3.toggle").click();
  }
}

function productTabs() {
  var offset = 40;
  var productTabsContainer = $j("#productTabs");
  var productTabsDT = $j("#productTabs dt");
  var productTabsDD = $j("#productTabs dd");
  var productPage = $j("#productPage");

  if (productPage.hasClass("tabsTop")) {
    setupTabsTop();
  } else if (productPage.hasClass("tabsLeft")) {
    setupTabsLeft();
  } else if (productPage.hasClass("tabsAccordion")) {
    setupTabsAccordion();
  }

  function setupTabsAccordion() {
    productTabsDT.click(function () {
      $j(this).toggleClass("selected").next().slideToggle();
    });

    productTabsDT.eq(0).click();
  }

  function setupTabsLeft() {
    productTabsDT.click(function () {
      // Make this accessible to inner function.
      var that = this;

      // Update selected class.
      productTabsDT.removeClass("selected");
      $j(that).addClass("selected");

      productTabsDD.stop(true, true).fadeOut(400, function () {
        // Resize container to dd
        var ddHeight = $j(that).next().outerHeight();
        productTabsContainer
          .stop(true, true)
          .animate({ height: ddHeight + "px" });

        // Show dd
        $j(that).next().fadeIn(400);
      });

      // productTabsDD.stop(true,true).animate({opacity:0},function(){
      //
      // 	// Resize container to dd
      // 	var ddHeight = $j(that).next().outerHeight();
      // 	productTabsContainer.stop(true,true).animate({ height : ddHeight + 'px' });
      //
      // 	// Show dd
      // 	$j(that).next().animate({ opacity : 1 });
      // });
    });
    productTabsDT.eq(0).click();
  }

  function setupTabsTop() {
    productTabsDT.addClass("label");
    productTabsDT.eq(0).addClass("selected");
    productTabsDD.addClass("pane").wrapInner('<div class="tabDiv"></div>');
    productTabsDD.css("position", "absolute");
    productTabsDD.not("dd:eq(0)").hide();
    productTabsContainer.css(
      "height",
      $j("#productTabs dd:eq(0)").height() + offset
    );

    productTabsDT.click(function () {
      var holdThis = $j(this);
      if (!holdThis.hasClass("selected")) {
        productTabsDT.removeClass("selected");
        holdThis.addClass("selected");
        if (tabEffect === "slide") {
          productTabsDD.slideUp(slideSpeed);
          productTabsContainer.animate(
            { height: holdThis.next().height() + offset },
            slideSpeed,
            function () {
              holdThis.next().slideDown(slideSpeed);
            }
          );
        } else {
          productTabsDD.fadeOut(slideSpeed);
          productTabsContainer.animate(
            { height: holdThis.next().height() + offset },
            slideSpeed,
            function () {
              holdThis.next().fadeIn(slideSpeed);
            }
          );
        }
      }
    });
  }
}

function setupProductPage() {
  productTabs();
  if ($j("#applyNow2").length) {
  }
}

function setPrintLinks(target) {
  target.click(function () {
    window.print();
  });
}
//	Overlabel - place a div with the class 'overLabelWrapper' around whatever will be using this code.
// Make sure that the label is set to display block
function setOverLabelWrappers() {
  var $overLabelWrapper = $j(".overLabelWrapper");

  if ($overLabelWrapper.length) {
    var labelFor = $overLabelWrapper.find("form label[for]"),
      inputFor = $overLabelWrapper.find("form input").attr("id");
    if (labelFor !== inputFor) {
      labelFor.addClass("overLabel");
      $overLabelWrapper.find("input[type=text]").addClass("overLabel");
      $overLabelWrapper.find("input[type=password]").addClass("overLabel");
      $overLabelWrapper.find("input.overLabel").focus(function () {
        $j(this).prev().css({
          "text-indent": "-9999px",
        });
      });
      $overLabelWrapper.find("input.overLabel").blur(function () {
        if ($j(this).val() == "") {
          $j(this).prev().css({
            "text-indent": "0",
          });
        }
      });
    }
  }
}

function setPopups() {
  $j("#downstreamObl")
    .fancybox({
      hideOnContentClick: false,
      width: 570,
      height: 185,
      centerOnScroll: false,
      titleShow: false,
      overlayOpacity: 0.8,
      overlayColor: overlayColorVar,
      autoScale: false,
      padding: 0,
    })
    .addClass("iframe");
  $j("#questions a, #requestInfo a")
    .fancybox({
      hideOnContentClick: false,
      width: 680,
      height: 800,
      centerOnScroll: false,
      titleShow: false,
      overlayOpacity: 0.8,
      overlayColor: overlayColorVar,
      autoScale: false,
      padding: 0,
    })
    .addClass("iframe");
  $j("#contactProfessional")
    .fancybox({
      hideOnContentClick: false,
      width: 680,
      height: 960,
      centerOnScroll: false,
      titleShow: false,
      overlayOpacity: 0.8,
      overlayColor: overlayColorVar,
      autoScale: false,
      padding: 0,
    })
    .addClass("iframe");
  $j("#calculatorsPage li a")
    .fancybox({
      hideOnContentClick: false,
      width: 650,
      height: 600,
      centerOnScroll: false,
      titleShow: false,
      overlayOpacity: 0.8,
      overlayColor: overlayColorVar,
      autoScale: false,
      padding: 0,
    })
    .addClass("iframe");
  /*$j("a.newsletterSignup").fancybox({
		'hideOnContentClick': false,
		'width': 200,
		'height': 300,
		'centerOnScroll': false,
		'titleShow': false,
		'overlayOpacity': 0.8,
		'overlayColor': overlayColorVar,
		'autoScale': false,
		'padding': 0
	}).addClass('iframe');*/
  $j("a.comparePopup, a.comparePopupWide").fancybox({
    hideOnContentClick: false,
    width: 880,
    height: 900,
    centerOnScroll: false,
    titleShow: false,
    overlayOpacity: 0.8,
    overlayColor: overlayColorVar,
    autoScale: false,
    padding: 0,
  });

  // Alert Box inside fancybox
  $j("a.confirmPopup").each(function () {
    $j(this).click(iframeCheck);
  });
  if ($j("body.popup").length) {
    if ($j("a.confirm").length) {
      var width = $j("body").width();
      var height = $j("body").height();
      var smallFrame = false;

      if (width < 600) {
        $j("body").css("padding", "0 " + (600 - width) / 2 + "px");
        smallFrame = true;
      }

      var left = (600 - width) / 2;
      var top = 0;
      if ($j("body .inner").length) {
        width = $j("body .inner").width();
        height = $j("body .inner").height();
        left = $j("body .inner").position().left;
        top = $j("body .inner").position().top;
      }
      if (smallFrame) {
        $j("html > head").append(
          "<style>#popup_overlay { width:" +
            width +
            "px !important; height:" +
            height +
            "px !important; left:" +
            left +
            "px !important; top:" +
            top +
            "px !important }</style>"
        );
      }
    }
  }
}

// Alert Box inside fancybox
function iframeCheck() {
  var iframeFound = $j("#fancybox-frame").length;
  if (iframeFound) {
    setupAlertBox();
  } else {
    setTimeout(iframeCheck, 250);
  }
}
function setupAlertBox() {
  $j("#fancybox-frame").load(function () {
    var width = $j("#fancybox-content").width();
    if (width < 600) {
      $j("#fancybox-content")
        .css("width", "600px")
        .css("margin-left", (600 - width) / -2 + "px");
      $j("#fancybox-close").click(function () {
        $j("#fancybox-content").css("margin-left", 0);
      });
    }
  });
}

function setSpeedBumps() {
  $j("a.confirm").click(function () {
    if (!confirmAlert($j(this).attr("href"))) {
      return false;
    }
  });

  $j("a.investor").click(function () {
    if (!investorAlert($j(this).attr("href"))) {
      return false;
    }
  });

  $j("a.elanConfirm").click(function () {
    if (!elanAlert($j(this).attr("href"))) {
      return false;
    }
  });
}

// Add elements that need a clickable container.
function setClickableContainers() {
  // Clickcable containers.
  clickableContainer($j("#productList > ul > li"));
  clickableContainer($j("#featuredProducts > li"));
  clickableContainer($j("#letsTalk"));
  clickableContainer($j(".newsPreview"));
  clickableContainer($j("ul#serviceList > li"));

  // Clickable containers for search page.
  if ($j("#searchPage").length) {
    setTimeout(function () {
      $j("#froisearch-results li")
        .addClass("clickable")
        .live("click", function () {
          window.location = $j(this).find("a:first").attr("href");
        });
    }, 50);
  }
}

function setupLocationsPage() {
  if ($j("#locationsPage").hasClass("toggle")) {
    var togglers = $j("#locList > li > .top h2");
    togglers.click(function () {
      $j(this)
        .parents("li")
        .toggleClass("active")
        .find(".bottom")
        .slideToggle();
    });

    togglers.eq(0).click();
  }
}

function setupApplicationPage() {
  var steps = $j("#application > div.inform-form-steps").detach();
  if (steps.length) {
    steps.prepend("<h3>Application Steps</h3>");
    $j("#leftColumn").append(steps);
  }
}

function setupSearchPage() {
  setTimeout(function () {
    $j("#froisearch-results > ul > li").append(
      '<span class="more">Learn More</span>'
    );
  }, 200);
}

//Setup share popups
function setupSharePopup() {
  var url = window.location;
  var sharePopup = $j(".sharePopup");
  var shareButton = $j(".socialButtons .share");
  var twitterElement = $j(".sharePopup .twitter a");
  var emailElement = $j(".sharePopup .email a");
  var facebookElement = $j(".sharePopup .facebook a");
  var productTitle = $j("#mainContent h1").text().replace("&", "and");
  var greeting = encodeURIComponent("Hi - \r\n\r\n");
  var greetingTwitter = encodeURIComponent("Check out ");
  var message = encodeURIComponent(
    "This excited me, and I thought you might find it exciting too. Check out " +
      productTitle
  );

  if (sharePopup.length === 0 || shareButton.length === 0) {
    return;
  }

  // set up the events
  shareButton.click(function () {
    sharePopup.fadeIn();
  });
  sharePopup.find(".close").click(function (e) {
    e.stopImmediatePropagation();
    sharePopup.hide();
  });

  if (twitterElement.length) {
    twitterElement.attr(
      "href",
      "https://twitter.com/share?url=" + url + "&text=" + message
    );
  }
  if (emailElement.length) {
    var subject = greetingTwitter + productTitle;
    var body = message + " at " + url + ".";
    emailElement.attr(
      "href",
      "mailto:?subject=" + subject + "&body=" + greeting + body
    );
  }
  if (facebookElement.length) {
    facebookElement.attr(
      "href",
      "http://www.facebook.com/sharer.php?u=" +
        url +
        "&t=" +
        greeting +
        message +
        "."
    );
  }
}

// Adds dummy images to a page.
function addDummyImages() {
  if ($j("#productCategory").length) {
    $j("#productCategory a").each(function () {
      if ($j(this).children("img").length > 0)
        $j(this).php(
          '<img alt="" src="/custom/' + customFolder + '/image/graybox.jpg">'
        );
    });
  }
}

function setTargetBlanks() {
  $j("a.newPage").each(function () {
    this.attr["target"] = "_blank";
  });
}

function setTargetParent() {
  $j("#comparisonChart a").each(function () {
    $j(this).attr("target", "_parent");
  });
}

function consoleLog(msg) {
  if (typeof console != "undefined") {
    console.log(msg);
  }
}

// Cookies!
function createCookie(name, value, days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    var expires = "; expires=" + date.toGMTString();
  } else var expires = "";
  document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
}

function readCookie(name) {
  var cookieMeLookingFor = escape(name) + "=";
  var allTheCookies = document.cookie.split(";");
  for (var i = 0; i < allTheCookies.length; i++) {
    var cookie = allTheCookies[i];
    while (cookie.charAt(0) == " ") cookie = cookie.substring(1, cookie.length);
    if (cookie.indexOf(cookieMeLookingFor) == 0)
      return unescape(
        cookie.substring(cookieMeLookingFor.length, cookie.length)
      );
  }
  return null;
}

function imageSwitch() {
  $j(".imageSwitch").each(function () {
    var href = $j(this).attr("href"),
      src = href.substring(0, href.length);

    $j(this)
      .php('<img src="' + src + '" alt="<?php echo $name; ?> " />')
      .css("cursor", "default")
      .click(function (e) {
        e.preventDefault();
      });
  });
}

function setupSports() {
  $j(".sports img:gt(0)").parent().parent().parent().addClass("floatLeftImage");
}
