/**
 * PSA鑑定代行サービス ランディングページ
 * カヌカード - JavaScript
 */

(function() {
    'use strict';

    // DOM Ready
    document.addEventListener('DOMContentLoaded', function() {
        initAOS();
        initSmoothScroll();
        initHeaderScroll();
        initMobileMenu();
        initFAQ();
        initCounterAnimation();
    });

    /**
     * AOS-like スクロールアニメーション
     */
    function initAOS() {
        const elements = document.querySelectorAll('[data-aos]');

        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    const delay = entry.target.getAttribute('data-delay') || 0;
                    setTimeout(function() {
                        entry.target.classList.add('aos-animate');
                    }, delay);
                }
            });
        }, observerOptions);

        elements.forEach(function(element) {
            observer.observe(element);
        });
    }

    /**
     * スムーススクロール
     */
    function initSmoothScroll() {
        const links = document.querySelectorAll('a[href^="#"]');

        links.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    const headerHeight = document.querySelector('.site-header').offsetHeight;
                    const targetPosition = targetElement.offsetTop - headerHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // モバイルメニューを閉じる
                    closeMobileMenu();
                }
            });
        });
    }

    /**
     * ヘッダースクロール効果
     */
    function initHeaderScroll() {
        const header = document.querySelector('.site-header');
        const scrollThreshold = 50;

        window.addEventListener('scroll', function() {
            if (window.scrollY > scrollThreshold) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // 初期チェック
        if (window.scrollY > scrollThreshold) {
            header.classList.add('scrolled');
        }
    }

    /**
     * モバイルメニュー
     */
    function initMobileMenu() {
        const toggle = document.querySelector('.mobile-toggle');
        const nav = document.querySelector('.main-nav');

        if (!toggle || !nav) return;

        toggle.addEventListener('click', function() {
            this.classList.toggle('active');
            nav.classList.toggle('mobile-open');

            // ハンバーガーアニメーション
            const spans = this.querySelectorAll('span');
            if (this.classList.contains('active')) {
                spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translate(7px, -6px)';
            } else {
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
        });
    }

    function closeMobileMenu() {
        const toggle = document.querySelector('.mobile-toggle');
        const nav = document.querySelector('.main-nav');

        if (toggle && toggle.classList.contains('active')) {
            toggle.classList.remove('active');
            nav.classList.remove('mobile-open');
            const spans = toggle.querySelectorAll('span');
            spans[0].style.transform = 'none';
            spans[1].style.opacity = '1';
            spans[2].style.transform = 'none';
        }
    }

    /**
     * FAQアコーディオン
     */
    function initFAQ() {
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(function(item) {
            const question = item.querySelector('.faq-question');

            question.addEventListener('click', function() {
                const isActive = item.classList.contains('active');

                // 他のアイテムを閉じる
                faqItems.forEach(function(otherItem) {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                    }
                });

                // クリックしたアイテムをトグル
                if (isActive) {
                    item.classList.remove('active');
                } else {
                    item.classList.add('active');
                }
            });
        });
    }

    /**
     * カウンターアニメーション
     */
    function initCounterAnimation() {
        const counters = document.querySelectorAll('.result-number[data-count]');
        let animated = false;

        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.5
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting && !animated) {
                    animated = true;
                    animateCounters();
                }
            });
        }, observerOptions);

        if (counters.length > 0) {
            observer.observe(counters[0].closest('.results-stats'));
        }

        function animateCounters() {
            counters.forEach(function(counter) {
                const target = parseInt(counter.getAttribute('data-count'));
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;

                const updateCounter = function() {
                    current += step;
                    if (current < target) {
                        counter.textContent = Math.floor(current).toLocaleString();
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target.toLocaleString();
                    }
                };

                updateCounter();
            });
        }
    }

    /**
     * フォームバリデーション（将来の拡張用）
     */
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    /**
     * ローディングアニメーション（将来の拡張用）
     */
    function showLoading(button) {
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> 送信中...';
    }

    function hideLoading(button, originalText) {
        button.disabled = false;
        button.innerHTML = originalText;
    }

    /**
     * スクロール位置に応じたアクティブナビゲーション
     */
    function updateActiveNav() {
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.main-nav a');

        window.addEventListener('scroll', function() {
            let current = '';
            const headerHeight = document.querySelector('.site-header').offsetHeight;

            sections.forEach(function(section) {
                const sectionTop = section.offsetTop - headerHeight - 100;
                const sectionHeight = section.offsetHeight;

                if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(function(link) {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });
    }

    // 初期化時にアクティブナビゲーションを有効化
    updateActiveNav();

    /**
     * 口コミフォーム - 文字数カウンター
     */
    function initReviewFormCharCounter() {
        const reviewTextarea = document.getElementById('review_message');
        const charCountSpan = document.getElementById('charCount');

        if (reviewTextarea && charCountSpan) {
            // 初期値を設定
            charCountSpan.textContent = reviewTextarea.value.length;

            // 入力時に文字数を更新
            reviewTextarea.addEventListener('input', function() {
                const currentLength = this.value.length;
                const maxLength = parseInt(this.getAttribute('maxlength')) || 1000;

                charCountSpan.textContent = currentLength;

                // 文字数が上限に近づいたら色を変える
                const charCountElement = charCountSpan.parentElement;
                if (currentLength >= maxLength * 0.9) {
                    charCountElement.style.color = '#D97706'; // warning color
                } else if (currentLength >= maxLength) {
                    charCountElement.style.color = '#DC2626'; // danger color
                } else {
                    charCountElement.style.color = '#94A3B8'; // default muted color
                }
            });
        }
    }

    /**
     * 口コミフォーム - 星評価のインタラクション
     */
    function initReviewFormStarRating() {
        const starInputs = document.querySelectorAll('.star-rating-input input[type="radio"]');
        const starLabels = document.querySelectorAll('.star-rating-input label');

        if (starInputs.length > 0) {
            // ラベルにホバー効果を追加
            starLabels.forEach(function(label, index) {
                label.addEventListener('mouseenter', function() {
                    // ホバー中の星とそれより前の星をハイライト
                    for (let i = starLabels.length - 1; i >= index; i--) {
                        starLabels[i].style.color = '#F59E0B';
                    }
                });

                label.addEventListener('mouseleave', function() {
                    // 選択されている星以外をデフォルト色に戻す
                    const checkedInput = document.querySelector('.star-rating-input input[type="radio"]:checked');
                    starLabels.forEach(function(lbl, idx) {
                        const correspondingInput = starInputs[starLabels.length - 1 - idx];
                        if (!checkedInput || correspondingInput !== checkedInput) {
                            lbl.style.color = '#CBD5E1';
                        }
                    });

                    // 選択されている星をハイライト
                    if (checkedInput) {
                        const checkedIndex = Array.from(starInputs).indexOf(checkedInput);
                        for (let i = starLabels.length - 1; i >= (starLabels.length - 1 - checkedIndex); i--) {
                            starLabels[i].style.color = '#F59E0B';
                        }
                    }
                });
            });

            // 星を選択した時の処理
            starInputs.forEach(function(input) {
                input.addEventListener('change', function() {
                    if (this.checked) {
                        const rating = parseInt(this.value);
                        // 選択された星とそれより前の星をハイライト
                        for (let i = starLabels.length - 1; i >= (starLabels.length - rating); i--) {
                            starLabels[i].style.color = '#F59E0B';
                        }
                        // それ以外の星をデフォルト色に
                        for (let i = 0; i < (starLabels.length - rating); i++) {
                            starLabels[i].style.color = '#CBD5E1';
                        }
                    }
                });
            });
        }
    }

    // 口コミフォーム機能を初期化
    initReviewFormCharCounter();
    initReviewFormStarRating();

    /**
     * 簡易見積もりモーダル
     */
    function initEstimateModal() {
        const modal = document.getElementById('estimateModal');
        const openBtn = document.getElementById('openEstimateModal');
        const closeBtn = document.getElementById('closeEstimateModal');
        const overlay = modal ? modal.querySelector('.estimate-modal-overlay') : null;
        const form = document.getElementById('estimateForm');
        const resultDiv = document.getElementById('estimateResult');

        if (!modal || !openBtn) return;

        // モーダルを開く
        openBtn.addEventListener('click', function() {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        // モーダルを閉じる
        function closeModal() {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', closeModal);
        }

        if (overlay) {
            overlay.addEventListener('click', closeModal);
        }

        // ESCキーで閉じる
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('active')) {
                closeModal();
            }
        });

        // 見積もり計算
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const agencyPlan = parseFloat(document.getElementById('agencyPlan').value);
                const psaPlan = parseFloat(document.getElementById('psaPlan').value);
                const cardCount = parseInt(document.getElementById('cardCount').value);
                const cardValue = parseFloat(document.getElementById('cardValue').value);

                if (!agencyPlan || !psaPlan || !cardCount || !cardValue) {
                    alert('すべての項目を入力してください');
                    return;
                }

                // 為替レート（仮: 1ドル = 150円）
                const exchangeRate = 150;

                // PSA鑑定料（ドル → 円）
                const psaFee = psaPlan * cardCount * exchangeRate;

                // 代行手数料（カード申告額の1%または2%）
                const agencyFee = cardValue * (agencyPlan / 100);

                // 合計
                const total = psaFee + agencyFee;

                // 結果を表示
                document.getElementById('resultPsaFee').textContent = formatCurrency(psaFee);
                document.getElementById('resultAgencyFee').textContent = formatCurrency(agencyFee);
                document.getElementById('resultTotal').textContent = formatCurrency(total);

                resultDiv.style.display = 'block';

                // 結果までスクロール
                resultDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            });
        }

        // 通貨フォーマット
        function formatCurrency(value) {
            return '¥' + Math.round(value).toLocaleString('ja-JP');
        }
    }

    // 見積もりモーダルを初期化
    initEstimateModal();

})();