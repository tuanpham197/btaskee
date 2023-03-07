function loadContentDownApp() {
    var headDown = document.getElementById("headDownApp");
    var textDown = document.getElementById("textDownApp");
    var checkLang = document.documentElement.lang;
    var userAgent = navigator.userAgent;
    switch (checkLang) {
        case "vi":
            headDown.innerHTML = "Bạn đã sẵn sàng để<br/>trải nghiệm?";
            textDown.innerHTML = "Tải, đăng ký và trải nghiệm những tính năng thú vị chỉ có trên Ứng dụng bTaskee.";
            document.getElementById("imgchplay").href =
                "https://play.google.com/store/apps/details?id=com.lanterns.btaskee&hl=vi";
            document.getElementById("imgappstore").href =
                "https://apps.apple.com/vn/app/btaskee-maids-and-cleaning/id1054302942?l=vi";
            break;
        case "en-US":
            headDown.innerHTML = "Book a home cleaning task right away";
            textDown.innerHTML =
                "Download, register and experience exciting features only available on bTaskee App – On-demand Home Services";
            document.getElementById("imgchplay").href =
                "https://play.google.com/store/apps/details?id=com.lanterns.btaskee&hl=en";
            document.getElementById("imgappstore").href =
                "https://apps.apple.com/vn/app/btaskee-maids-and-cleaning/id1054302942?l=en";
            break;
        case "ko-KR":
            headDown.innerHTML = "Book a home cleaning task right away";
            textDown.innerHTML =
                "Download, register and experience exciting features only available on bTaskee App – On-demand Home Services";
            document.getElementById("imgchplay").href =
                "https://play.google.com/store/apps/details?id=com.lanterns.btaskee&hl=ko";
            document.getElementById("imgappstore").href =
                "https://apps.apple.com/vn/app/btaskee-maids-and-cleaning/id1054302942?l=ko";
            break;
        case "th":
            headDown.innerHTML = "จองบริการทำความสะอาดที่ใช่! กับ bTaskee";
            textDown.innerHTML =
                "ดาวน์โหลด ลงทะเบียน และเปิดรับประสบการณ์สุดพิเศษที่เราพร้อมมอบให้ผ่านแอปพลิเคชัน bTaskee - บริการทำความสะอาดรายชั่วโมง";
            document.getElementById("imgchplay").href =
                "https://play.google.com/store/apps/details?id=com.lanterns.btaskee&hl=th";
            document.getElementById("imgappstore").href =
                "https://apps.apple.com/th/app/btaskee-maids-and-cleaning/id1054302942?l=th";
            break;
        default:
            headDown.innerHTML = "Book a home cleaning task right away";
            textDown.innerHTML =
                "Download, register and experience exciting features only available on bTaskee App – On-demand Home Services";
            document.getElementById("imgchplay").href =
                "https://play.google.com/store/apps/details?id=com.lanterns.btaskee&hl=en";
            document.getElementById("imgappstore").href =
                "https://apps.apple.com/vn/app/btaskee-maids-and-cleaning/id1054302942?l=en";
    }
    if (userAgent.match(/iPad/i) || userAgent.match(/iPhone/i) || userAgent.match(/iPod/i)) {
        location.href = document.getElementById("imgappstore").href;
    } else if (userAgent.match(/Android/i)) {
        location.href = document.getElementById("imgchplay").href;
    } else {
        console.log("PC");
    }
}

var ElementorProFrontendConfig = {
    "ajaxurl": "https:\/\/www.btaskee.com\/wp-admin\/admin-ajax.php",
    "nonce": "f2ed5ec285",
    "urls": {
        "assets": "https:\/\/www.btaskee.com\/wp-content\/plugins\/elementor-pro\/assets\/",
        "rest": "https:\/\/www.btaskee.com\/wp-json\/"
    },
    "shareButtonsNetworks": {
        "facebook": {
            "title": "Facebook",
            "has_counter": true
        },
        "twitter": {
            "title": "Twitter"
        },
        "linkedin": {
            "title": "LinkedIn",
            "has_counter": true
        },
        "pinterest": {
            "title": "Pinterest",
            "has_counter": true
        },
        "reddit": {
            "title": "Reddit",
            "has_counter": true
        },
        "vk": {
            "title": "VK",
            "has_counter": true
        },
        "odnoklassniki": {
            "title": "OK",
            "has_counter": true
        },
        "tumblr": {
            "title": "Tumblr"
        },
        "digg": {
            "title": "Digg"
        },
        "skype": {
            "title": "Skype"
        },
        "stumbleupon": {
            "title": "StumbleUpon",
            "has_counter": true
        },
        "mix": {
            "title": "Mix"
        },
        "telegram": {
            "title": "Telegram"
        },
        "pocket": {
            "title": "Pocket",
            "has_counter": true
        },
        "xing": {
            "title": "XING",
            "has_counter": true
        },
        "whatsapp": {
            "title": "WhatsApp"
        },
        "email": {
            "title": "Email"
        },
        "print": {
            "title": "Print"
        }
    },
    "facebook_sdk": {
        "lang": "vi",
        "app_id": ""
    },
    "lottie": {
        "defaultAnimationUrl": "https:\/\/www.btaskee.com\/wp-content\/plugins\/elementor-pro\/modules\/lottie\/assets\/animations\/default.json"
    }
};


var checkClassDownload = document.getElementsByClassName("popupDownApp");

function DownLoadAsker() {
    var userAgent = navigator.userAgent;
    if (userAgent.match(/iPad/i) || userAgent.match(/iPhone/i) || userAgent.match(/iPod/i)) {
        location.href = "https://apps.apple.com/app/btaskee/id1054302942";
    } else if (userAgent.match(/Android/i)) {
        location.href = "https://play.google.com/store/apps/details?id=com.lanterns.btaskee";
    } else {
        elementorProFrontend.modules.popup.showPopup({
            id: 37673
        });
    }
}
for (var i = 0; i < checkClassDownload.length; i++) {
    checkClassDownload[i].addEventListener('click', function () {
        DownLoadAsker()
    }, false);
}

(function (h, o, t, j, a, r) {
    h.hj = h.hj || function () {
        (h.hj.q = h.hj.q || []).push(arguments)
    };
    h._hjSettings = {
        hjid: 1738801,
        hjsv: 6
    };
    a = o.getElementsByTagName('head')[0];
    r = o.createElement('script');
    r.async = 1;
    r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
    a.appendChild(r);
})(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');

document.getElementById("btkButtonDownAskerAnd").onclick = function() {
    pushEventDownAnd()
};
document.getElementById("btkButtonDownAskerIos").onclick = function() {
    pushEventDownIos()
};

function pushEventDownAnd() {
    clevertap.event.push("btkButtonDownAskerAnd", {
        "URL": window.location.href,
        "Language": document.documentElement.lang
    });
}

function pushEventDownIos() {
    clevertap.event.push("btkButtonDownAskerIos", {
        "URL": window.location.href,
        "Language": document.documentElement.lang
    });
}
document.getElementById("btkButtonCall").onclick = function() {
    pushCallPhone()
};

function pushCallPhone() {
    clevertap.event.push("btkButtonCall", {
        "URL": window.location.href,
        "Language": document.documentElement.lang
    });
}
document.getElementById("btkButtonDownAskerAnd").onclick = function() {
    pushEventDownAnd()
};
document.getElementById("btkButtonDownAskerIos").onclick = function() {
    pushEventDownIos()
};

function pushEventDownAnd() {
    clevertap.event.push("btkButtonDownAskerAnd", {
        "URL": window.location.href,
        "Language": document.documentElement.lang
    });
}

function pushEventDownIos() {
    clevertap.event.push("btkButtonDownAskerIos", {
        "URL": window.location.href,
        "Language": document.documentElement.lang
    });
}

window.lazyLoadOptions = {
    elements_selector: "img[data-lazy-src],.rocket-lazyload",
    data_src: "lazy-src",
    data_srcset: "lazy-srcset",
    data_sizes: "lazy-sizes",
    class_loading: "lazyloading",
    class_loaded: "lazyloaded",
    threshold: 300,
    callback_loaded: function(element) {
        if (element.tagName === "IFRAME" && element.dataset.rocketLazyload == "fitvidscompatible") {
            if (element.classList.contains("lazyloaded")) {
                if (typeof window.jQuery != "undefined") {
                    if (jQuery.fn.fitVids) {
                        jQuery(element).parent().fitVids();
                    }
                }
            }
        }
    }
};
window.addEventListener('LazyLoad::Initialized', function(e) {
    var lazyLoadInstance = e.detail.instance;
    if (window.MutationObserver) {
        var observer = new MutationObserver(function(mutations) {
            var image_count = 0;
            var iframe_count = 0;
            var rocketlazy_count = 0;
            mutations.forEach(function(mutation) {
                for (i = 0; i < mutation.addedNodes.length; i++) {
                    if (typeof mutation.addedNodes[i].getElementsByTagName !== 'function') {
                        return;
                    }
                    if (typeof mutation.addedNodes[i].getElementsByClassName !==
                        'function') {
                        return;
                    }
                    images = mutation.addedNodes[i].getElementsByTagName('img');
                    is_image = mutation.addedNodes[i].tagName == "IMG";
                    iframes = mutation.addedNodes[i].getElementsByTagName('iframe');
                    is_iframe = mutation.addedNodes[i].tagName == "IFRAME";
                    rocket_lazy = mutation.addedNodes[i].getElementsByClassName(
                        'rocket-lazyload');
                    image_count += images.length;
                    iframe_count += iframes.length;
                    rocketlazy_count += rocket_lazy.length;
                    if (is_image) {
                        image_count += 1;
                    }
                    if (is_iframe) {
                        iframe_count += 1;
                    }
                }
            });
            if (image_count > 0 || iframe_count > 0 || rocketlazy_count > 0) {
                lazyLoadInstance.update();
            }
        });
        var b = document.getElementsByTagName("body")[0];
        var config = {
            childList: true,
            subtree: true
        };
        observer.observe(b, config);
    }
}, false);