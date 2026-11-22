/**
 * @copyright (C) 2022,  Champion CMS, is based on code (2010-2021) 99ko https://github.com/99kocms/
 * @license https://license.championconsulting.com/cms/champion-public-license-v3.0.html CPLv3
 * @author Ronald Ingraham <r.ingrham@championconsultingl.com>
 * @author Andrew Champion <a.champion@championconsultingl.com>
 * @author Maddox Champion <m.champion@championconsultingl.com>
 * @author Katie Mae Champion <katie.champion@championconsultingl.com>
 * @author Kimberly Champion <kim.champion@championconsultingl.com>
 * 
 * @package Champion CMS https://github.com/ChampionConsulting/champion-cms
 */

  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.dropdown-trigger');
    var instances = M.Dropdown.init(elems, options);
  });

  // Or with jQuery

  $('.dropdown-trigger').dropdown();
  
  document.addEventListener("DOMContentLoaded", function () {
    if (document.querySelector('#mobile_menu')) {
        document.querySelector('#mobile_menu').addEventListener("click", function () {
            var navigation = document.querySelector('#header #navigation');
            toggleSlide(navigation);
        });
    }

    var pathname = window.location.href.split('#')[0];
    document.querySelectorAll('a[href^="#"]').forEach(function (item) {
        var link = item.getAttribute('href');
        item.setAttribute('href', pathname + link);
    });


    document.querySelectorAll('.msg').forEach(function (item, index) {
        item.querySelector('.msg-button-close').addEventListener('click', function () {
            fadeOut(item);
        });

        setTimeout(function () {
            fadeOut(item);
        }, 5000 + index * 5000);

    });

});

function toggleSlide(el) {
    if (el.clientHeight > 0) {
        el.classList.add('active');
    } else {
        el.classList.remove('active');
    }
    if (!el.classList.contains('active')) {
        // slideDown
        el.classList.add('active');
        el.style.height = "auto";
        var height = el.clientHeight + "px";
        el.style.height = "0px";
        setTimeout(function () {
            el.style.height = height;
        }, 0);
    } else {
        // slideUp
        el.style.height = "0px";
        el.addEventListener('transitionend', function () {
            el.classList.remove('active');
        }, {once: true});
    }
}

function fadeOut(el) {
    el.style.opacity = 1;
    (function fade() {
        if ((el.style.opacity -= .03) < 0) {
            el.style.display = "none";
        } else {
            requestAnimationFrame(fade);
        }
    })();
}
;
function fadeIn(el, display) {
    el.style.opacity = 0;
    el.style.display = display || "block";
    (function fade() {
        var val = parseFloat(el.style.opacity);
        if (!((val += .03) > 1)) {
            el.style.opacity = val;
            requestAnimationFrame(fade);
        }
    })();
};
