/* ==========================================================
 * CakePlate common JS code
 * 
 * https://github.com/rynop/CakePlate
 * ==========================================================
 * Copyright 2011 pwebo.com, LLC.
 * 
 * Dual licensed under the MIT and GPL licenses:
 *	http://www.opensource.org/licenses/mit-license.php
 *	http://www.gnu.org/licenses/gpl.html
 * ========================================================== */

/*
 * Put any js code here that is common across your views
 */

/**
 * Puts commas in
 */
function formatNumber(n) {
    if (!isFinite(n)) {
        return n;
    }

    var s = ""+n, abs = Math.abs(n), _, i;

    if (abs >= 1000) {
        _  = (""+abs).split(/\./);
        i  = _[0].length % 3 || 3;

        _[0] = s.slice(0,i + (n < 0)) +
               _[0].slice(i).replace(/(\d{3})/g,',$1');

        s = _.join('.');
    }

    return s;
}