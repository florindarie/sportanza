/**
 * Sportnza Theme - Main JavaScript
 *
 * @package Sportnza
 */

document.addEventListener('DOMContentLoaded', function () {

    // ─── Mobile Menu Toggle ─────────────────────────────────────────
    var mobileMenuBtn = document.querySelector('.mobile-menu-btn');

    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function () {
            this.classList.toggle('active');

            var mobileMenu = document.querySelector('.mobile-menu');

            if (!mobileMenu) {
                mobileMenu = document.createElement('div');
                mobileMenu.className = 'mobile-menu';

                // Use theme URI from wp_localize_script
                var themeUri = (typeof sportnzaData !== 'undefined') ? sportnzaData.themeUri : '';

                mobileMenu.innerHTML =
                    '<nav class="mobile-nav">' +
                        '<a href="#sports" class="mobile-nav-item">' +
                            '<img src="' + themeUri + '/assets/images/SPORTS.svg" alt="Sports" class="nav-icon">' +
                            '<span>Sports</span>' +
                        '</a>' +
                        '<a href="#live" class="mobile-nav-item">' +
                            '<img src="' + themeUri + '/assets/images/LIVE.svg" alt="Live" class="nav-icon">' +
                            '<span>Live</span>' +
                        '</a>' +
                        '<a href="#fantasy" class="mobile-nav-item">' +
                            '<img src="' + themeUri + '/assets/images/FANTASY.svg" alt="Fantasy" class="nav-icon">' +
                            '<span>Fantasy</span>' +
                        '</a>' +
                        '<a href="#vip" class="mobile-nav-item">' +
                            '<img src="' + themeUri + '/assets/images/VIP.svg" alt="VIP" class="nav-icon">' +
                            '<span>VIP</span>' +
                        '</a>' +
                    '</nav>' +
                    '<div class="mobile-actions">' +
                        '<button class="btn btn-outline btn-full">Log In</button>' +
                        '<button class="btn btn-primary btn-full">Sign Up</button>' +
                    '</div>';

                document.body.appendChild(mobileMenu);
            }

            mobileMenu.classList.toggle('active');
            document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
        });
    }

    // ─── Header Scroll Effect ───────────────────────────────────────
    var header = document.querySelector('.header');

    window.addEventListener('scroll', function () {
        if (window.scrollY > 100) {
            header.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.3)';
        } else {
            header.style.boxShadow = 'none';
        }
    });

    // ─── Smooth Scroll for Anchor Links ─────────────────────────────
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            var href = this.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                var target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }

                // Close mobile menu if open
                var mobileMenu = document.querySelector('.mobile-menu');
                if (mobileMenu && mobileMenu.classList.contains('active')) {
                    mobileMenu.classList.remove('active');
                    document.querySelector('.mobile-menu-btn').classList.remove('active');
                    document.body.style.overflow = '';
                }
            }
        });
    });

    // ─── Newsletter Form ────────────────────────────────────────────
    var newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function (e) {
            e.preventDefault();
            var btn = this.querySelector('.btn');
            var originalText = btn.textContent;
            btn.textContent = 'Subscribing...';
            btn.disabled = true;

            setTimeout(function () {
                btn.textContent = 'Subscribed!';
                btn.style.background = 'linear-gradient(135deg, #22c55e 0%, #16a34a 100%)';
                newsletterForm.querySelector('.newsletter-input').value = '';

                setTimeout(function () {
                    btn.textContent = originalText;
                    btn.style.background = '';
                    btn.disabled = false;
                }, 2000);
            }, 1000);
        });
    }

    // ─── Card Hover Effects with Parallax ───────────────────────────
    var cards = document.querySelectorAll('.featured-card, .article-card, .wide-card');

    cards.forEach(function (card) {
        card.addEventListener('mousemove', function (e) {
            var rect = this.getBoundingClientRect();
            var x = e.clientX - rect.left;
            var y = e.clientY - rect.top;
            var centerX = rect.width / 2;
            var centerY = rect.height / 2;
            var rotateX = (y - centerY) / 20;
            var rotateY = (centerX - x) / 20;

            this.style.transform = 'perspective(1000px) rotateX(' + rotateX + 'deg) rotateY(' + rotateY + 'deg) translateY(-4px)';
        });

        card.addEventListener('mouseleave', function () {
            this.style.transform = '';
        });
    });

    // ─── Animate Elements on Scroll ─────────────────────────────────
    var animateOnScroll = function () {
        var elements = document.querySelectorAll('.section, .featured-section, .promo-card, .trending-section');

        elements.forEach(function (element) {
            var elementTop = element.getBoundingClientRect().top;
            var windowHeight = window.innerHeight;

            if (elementTop < windowHeight - 100) {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }
        });
    };

    // Set initial styles for scroll animation
    document.querySelectorAll('.section, .featured-section, .promo-card, .trending-section').forEach(function (element) {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    });

    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Run on load

    // ─── Button Ripple Effect ───────────────────────────────────────
    var rippleStyle = document.createElement('style');
    rippleStyle.textContent = '@keyframes ripple { to { transform: translate(-50%, -50%) scale(4); opacity: 0; } }';
    document.head.appendChild(rippleStyle);

    document.querySelectorAll('.btn').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            var ripple = document.createElement('span');
            var rect = this.getBoundingClientRect();

            ripple.style.cssText =
                'position: absolute; background: rgba(255, 255, 255, 0.3); border-radius: 50%; ' +
                'pointer-events: none; width: 100px; height: 100px; transform: translate(-50%, -50%) scale(0); ' +
                'animation: ripple 0.6s ease-out;';

            ripple.style.left = (e.clientX - rect.left) + 'px';
            ripple.style.top = (e.clientY - rect.top) + 'px';

            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);

            setTimeout(function () {
                ripple.remove();
            }, 600);
        });
    });

});
