jQuery(document).ready(function(a) {
    a(window).on("contextmenu", function(a) {
        a.preventDefault();
        return !1
    }).on("keydown", function(a) {
        var b = a.which || a.keyCode;
        if (a.ctrlKey && [69, 76, 85].includes(b) || 123 === b || 117 === b || a.altKey && 68 === b) return a.preventDefault(), !1
    })
});
(function() {
    var a = {
            open: !1,
            orientation: null
        },
        e = function(a, c) {
            window.dispatchEvent(new CustomEvent("dtchanges", {
                detail: {
                    open: a,
                    orientation: c
                }
            }))
        };
    setInterval(function() {
        var b = 160 < window.outerWidth - window.innerWidth,
            c = 160 < window.outerHeight - window.innerHeight,
            d = b ? "vertical" : "horizontal";
        c && b || !(window.Firebug && window.Firebug.chrome && window.Firebug.chrome.isInitialized || b || c) ? (a.open && e(!1, null), a.open = !1, a.orientation = null) : (a.open && a.orientation === d || e(!0, d), a.open = !0, a.orientation = d)
    }, 500);
    "undefined" !==
    typeof module && module.exports ? module.exports = a : window.devtools = a
})();
window.addEventListener("dtchanges", function(a) {
    a.detail.open && (a = document.getElementById("password"), null !== a && a.parentNode.remove())
});