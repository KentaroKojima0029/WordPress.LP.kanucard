/**
 * Kanucard Landing Page - LP専用JavaScript
 */

(function($) {
    'use strict';

    // DOM Ready
    $(document).ready(function() {
        initAOS();
        initSmoothScroll();
        initMobileMenu();
        initHeaderScroll();
        initContactForm();
        initCounterAnimation();
    });

    /**
     * AOSアニメーション初期化
     */
    function initAOS() {
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                offset: 100
            });
        }
    }

    /**
     * スムーススクロール
     */
    function initSmoothScroll() {
        $('.lp-site a[href^="#"]').on('click', function(e) {
            e.preventDefault();
            var target = $(this.hash);
            if (target.length) {
                var headerHeight = $('.lp-header').outerHeight();
                $('html, body').animate({
                    scrollTop: target.offset().top - headerHeight
                }, 800);

                // モバイルメニューを閉じる
                closeMobileMenu();
            }
        });
    }

    /**
     * モバイルメニュー
     */
    function initMobileMenu() {
        var $toggle = $('.lp-mobile-menu-toggle');
        var $nav = $('.lp-main-navigation');

        $toggle.on('click', function() {
            var isExpanded = $(this).attr('aria-expanded') === 'true';
            $(this).attr('aria-expanded', !isExpanded);
            $(this).toggleClass('active');
            $nav.toggleClass('mobile-open');

            // ハンバーガーアニメーション
            if (!isExpanded) {
                $(this).find('span').eq(0).css('transform', 'rotate(45deg) translate(5px, 5px)');
                $(this).find('span').eq(1).css('opacity', '0');
                $(this).find('span').eq(2).css('transform', 'rotate(-45deg) translate(7px, -6px)');
            } else {
                $(this).find('span').css('transform', 'none').css('opacity', '1');
            }
        });
    }

    function closeMobileMenu() {
        var $toggle = $('.lp-mobile-menu-toggle');
        var $nav = $('.lp-main-navigation');

        $toggle.attr('aria-expanded', 'false').removeClass('active');
        $toggle.find('span').css('transform', 'none').css('opacity', '1');
        $nav.removeClass('mobile-open');
    }

    /**
     * ヘッダースクロール効果
     */
    function initHeaderScroll() {
        var $header = $('.lp-header');
        var scrollThreshold = 50;

        $(window).on('scroll', function() {
            if ($(this).scrollTop() > scrollThreshold) {
                $header.addClass('scrolled');
            } else {
                $header.removeClass('scrolled');
            }
        });

        // 初期チェック
        if ($(window).scrollTop() > scrollThreshold) {
            $header.addClass('scrolled');
        }
    }

    /**
     * コンタクトフォーム処理
     */
    function initContactForm() {
        var $form = $('#lp-contact-form');
        var $message = $('#lp-form-message');

        $form.on('submit', function(e) {
            e.preventDefault();

            var $submitBtn = $form.find('.lp-btn-submit');
            var originalText = $submitBtn.text();

            // ボタンを無効化
            $submitBtn.prop('disabled', true).text('送信中...');

            // フォームデータを取得
            var formData = {
                action: 'kanucard_contact',
                nonce: $form.find('#contact_nonce').val(),
                name: $form.find('#name').val(),
                email: $form.find('#email').val(),
                message: $form.find('#message').val()
            };

            // Ajax送信
            $.ajax({
                url: (typeof kanucard_ajax !== 'undefined') ? kanucard_ajax.ajax_url : '/wp-admin/admin-ajax.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        $message.removeClass('error').addClass('success').text('送信が完了しました。ありがとうございます！').show();
                        $form[0].reset();
                    } else {
                        $message.removeClass('success').addClass('error').text('送信に失敗しました。再度お試しください。').show();
                    }
                },
                error: function() {
                    $message.removeClass('success').addClass('error').text('エラーが発生しました。再度お試しください。').show();
                },
                complete: function() {
                    $submitBtn.prop('disabled', false).text(originalText);

                    // 5秒後にメッセージを非表示
                    setTimeout(function() {
                        $message.fadeOut();
                    }, 5000);
                }
            });
        });
    }

    /**
     * カウンターアニメーション
     */
    function initCounterAnimation() {
        var $counters = $('.lp-stat-number');
        var animated = false;

        function animateCounters() {
            $counters.each(function() {
                var $this = $(this);
                var countTo = $this.attr('data-count');

                $({ countNum: 0 }).animate({
                    countNum: countTo
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function() {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $this.text(this.countNum);

                        // パーセント記号を追加（顧客満足度の場合）
                        if ($this.parent().find('.lp-stat-label').text().includes('%')) {
                            $this.text(this.countNum + '%');
                        } else if ($this.parent().find('.lp-stat-label').text().includes('年')) {
                            $this.text(this.countNum + '+');
                        } else {
                            $this.text(this.countNum.toLocaleString() + '+');
                        }
                    }
                });
            });
        }

        // スクロール時にカウンターが見えたらアニメーション開始
        $(window).on('scroll', function() {
            if (!animated && isElementInViewport($('.lp-stats-section'))) {
                animated = true;
                animateCounters();
            }
        });

        // 初期チェック
        if (isElementInViewport($('.lp-stats-section'))) {
            animated = true;
            animateCounters();
        }
    }

    /**
     * 要素が画面内にあるかチェック
     */
    function isElementInViewport($element) {
        if ($element.length === 0) return false;

        var elementTop = $element.offset().top;
        var elementBottom = elementTop + $element.outerHeight();
        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();

        return elementBottom > viewportTop && elementTop < viewportBottom;
    }

})(jQuery);