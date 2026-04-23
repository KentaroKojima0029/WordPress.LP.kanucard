/**
 * PSA鑑定代行サービス ランディングページ
 * カヌカード - JavaScript
 */

(function() {
    'use strict';

    // モーダル用スクロールロック
    var scrollLockCount = 0;
    var savedScrollY = 0;

    function lockScroll() {
        if (scrollLockCount === 0) {
            savedScrollY = window.scrollY;
            document.body.classList.add('modal-open');
            document.body.style.top = '-' + savedScrollY + 'px';
        }
        scrollLockCount++;
    }

    function unlockScroll() {
        scrollLockCount--;
        if (scrollLockCount <= 0) {
            scrollLockCount = 0;
            document.body.classList.remove('modal-open');
            document.body.style.top = '';
            window.scrollTo(0, savedScrollY);
        }
    }

    // DOM Ready
    document.addEventListener('DOMContentLoaded', function() {
        initAOS();
        initSmoothScroll();
        initHeaderScroll();
        initMobileMenu();
        initFAQ();
        initCounterAnimation();
        initAccessButton();
        initContactModal();
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
        const counters = document.querySelectorAll('.result-number span[data-count], .result-number[data-count]');
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

        function render(counter, value, isDecimal, decimalClass) {
            if (isDecimal) {
                const v = value.toFixed(1);
                const parts = v.split('.');
                const intPart = Number(parts[0]).toLocaleString();
                counter.innerHTML = decimalClass
                    ? intPart + '<span class="' + decimalClass + '">.' + parts[1] + '</span>'
                    : intPart + '.' + parts[1];
            } else {
                counter.textContent = Math.floor(value).toLocaleString();
            }
        }

        function animateCounters() {
            counters.forEach(function(counter) {
                const targetStr = counter.getAttribute('data-count');
                const target = parseFloat(targetStr);
                if (isNaN(target) || target <= 0) return;
                const isDecimal = targetStr.indexOf('.') !== -1;
                const decimalClass = counter.getAttribute('data-decimal-class') || '';
                const duration = 1000;
                const step = target / (duration / 16);
                let current = 0;

                const updateCounter = function() {
                    current += step;
                    if (current < target) {
                        render(counter, current, isDecimal, decimalClass);
                        requestAnimationFrame(updateCounter);
                    } else {
                        render(counter, target, isDecimal, decimalClass);
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
     * 口コミフォーム - 星評価のインタラクション（CSSのみで動作、JSは補助）
     */
    function initReviewFormStarRating() {
        // CSSの:checked ~ labelで動作するため、JSは不要
        // 必要に応じて追加の処理をここに記述
    }

    // 口コミフォーム機能を初期化
    initReviewFormCharCounter();
    initReviewFormStarRating();

    /**
     * 口コミスライダー
     */
    function initTestimonialSlider() {
        var slider = document.querySelector('.testimonial-slider');
        if (!slider) return;

        var slides = slider.querySelectorAll('.testimonial-slide');
        var dotsContainer = document.querySelector('.testimonial-slider-dots');
        if (!slides.length || !dotsContainer) return;

        // ドットを生成
        slides.forEach(function(_, i) {
            var dot = document.createElement('button');
            dot.className = 'testimonial-slider-dot' + (i === 0 ? ' active' : '');
            dot.setAttribute('aria-label', (i + 1) + '件目');
            dot.addEventListener('click', function() {
                slides[i].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'start' });
            });
            dotsContainer.appendChild(dot);
        });

        var dots = dotsContainer.querySelectorAll('.testimonial-slider-dot');

        function getSlideStep() {
            var gap = parseFloat(getComputedStyle(slider).gap) || 24;
            return slides[0].offsetWidth + gap;
        }

        // スクロール位置からアクティブなドットを更新
        function updateDots() {
            var step = getSlideStep();
            var idx = Math.round(slider.scrollLeft / step);
            idx = Math.max(0, Math.min(idx, slides.length - 1));
            dots.forEach(function(d, i) {
                d.classList.toggle('active', i === idx);
            });
        }

        slider.addEventListener('scroll', updateDots);
    }
    initTestimonialSlider();

    /**
     * 口コミカード タップでモーダル全文表示（モバイル）
     */
    function initTestimonialModal() {
        var isMobile = window.matchMedia('(max-width: 768px)');
        var cards = document.querySelectorAll('.testimonial-slide');
        var overlay = document.getElementById('reviewDetailOverlay');
        var closeBtn = document.getElementById('reviewDetailClose');
        if (!overlay || !cards.length) return;

        function applyCollapse(mobile) {
            cards.forEach(function(card) {
                if (mobile) {
                    card.classList.add('is-collapsed');
                } else {
                    card.classList.remove('is-collapsed');
                }
            });
        }

        applyCollapse(isMobile.matches);
        isMobile.addEventListener('change', function(e) {
            applyCollapse(e.matches);
        });

        function openModal(card) {
            var name = card.querySelector('.testimonial-info h4');
            var stars = card.querySelector('.stars');
            var text = card.querySelector('.testimonial-text');
            var result = card.querySelector('.testimonial-result');

            document.getElementById('reviewDetailName').innerHTML = name ? name.innerHTML : '';
            document.getElementById('reviewDetailStars').innerHTML = stars ? stars.innerHTML : '';
            document.getElementById('reviewDetailText').innerHTML = text ? text.innerHTML : '';
            document.getElementById('reviewDetailResult').innerHTML = result ? result.innerHTML : '';

            overlay.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            overlay.classList.remove('is-open');
            document.body.style.overflow = '';
        }

        cards.forEach(function(card) {
            card.style.cursor = 'pointer';
            card.addEventListener('click', function(e) {
                if (!isMobile.matches) return;
                openModal(card);
            });
        });

        closeBtn.addEventListener('click', closeModal);
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) closeModal();
        });
    }
    initTestimonialModal();

    /**
     * 簡易見積もりモーダル
     */
    function initEstimateModal() {
        const modal = document.getElementById('estimateModal');
        const openBtn = document.getElementById('openEstimateModal');
        const openBtnHero = document.getElementById('openEstimateModalHero');
        const closeBtn = document.getElementById('closeEstimateModal');
        const overlay = modal ? modal.querySelector('.estimate-modal-overlay') : null;
        const form = document.getElementById('estimateForm');
        const resultDiv = document.getElementById('estimateResult');

        if (!modal) return;

        // 管理者サイトから代行料率を取得して代行プランの選択肢を更新する
        // PSA社プラン価格設定（commission_rates）テーブルの値を反映
        function loadCommissionRatesFromAPI() {
            const agencyPlanSelectEl = document.getElementById('agencyPlan');
            if (!agencyPlanSelectEl) return;

            fetch('https://daiko.kanucard.com/api/public/commission-rates', {
                method: 'GET',
                mode: 'cors'
            })
                .then(function(response) {
                    if (!response.ok) throw new Error('HTTP ' + response.status);
                    return response.json();
                })
                .then(function(data) {
                    if (!data.success || !data.rates) return;
                    var rates = data.rates;

                    // 各オプションを動的に更新（plan_type → percentage）
                    var planMap = {
                        'japan_normal': '日本 ノーマル',
                        'japan_guarantee': '日本 70%保証',
                        'usa_normal': 'アメリカ ノーマル',
                        'usa_guarantee': 'アメリカ 70%保証'
                    };
                    var regionMap = {
                        'japan_normal': 'japan',
                        'japan_guarantee': 'japan',
                        'usa_normal': 'usa',
                        'usa_guarantee': 'usa'
                    };

                    // 既存のオプションをクリア（先頭の「選択してください」は残す）
                    while (agencyPlanSelectEl.options.length > 1) {
                        agencyPlanSelectEl.remove(1);
                    }

                    // 4つのプランを追加（料率はAPIから取得した値）
                    Object.keys(planMap).forEach(function(planType) {
                        var rate = rates[planType];
                        if (rate === undefined || rate === null) return;
                        var percent = (Number(rate) * 100).toFixed(1);
                        var option = document.createElement('option');
                        option.value = percent;  // 例: "2.9"
                        option.setAttribute('data-region', regionMap[planType]);
                        option.textContent = planMap[planType];
                        agencyPlanSelectEl.appendChild(option);
                    });

                    console.log('[LP Estimate] Commission rates loaded from API:', rates);
                })
                .catch(function(error) {
                    console.warn('[LP Estimate] Failed to load commission rates from API, using fallback values:', error);
                    // フォールバック: HTMLにハードコードされた値をそのまま使用
                });
        }

        // 初期化時に料率を取得
        loadCommissionRatesFromAPI();

        // PSAプランのデータ
        const psaPlans = {
            japan: [
                { value: '3980', label: 'バリューバルク' },
                { value: '4980', label: 'バリュー' },
                { value: '7980', label: 'バリュー・プラス' },
                { value: '10980', label: 'レギュラー' }
            ],
            usa: [
                { value: '4700', label: 'バリューバルク' },
                { value: '5700', label: 'バリュー' },
                { value: '8400', label: 'バリュー・プラス' },
                { value: '25300', label: 'レギュラー' }
            ]
        };

        // 代行プラン選択時にPSAプランを更新
        const agencyPlanSelect = document.getElementById('agencyPlan');
        const psaPlanSelect = document.getElementById('psaPlan');

        if (agencyPlanSelect && psaPlanSelect) {
            agencyPlanSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const region = selectedOption.getAttribute('data-region');

                // PSAプランをリセット
                psaPlanSelect.innerHTML = '';

                if (region && psaPlans[region]) {
                    // プランを追加
                    const defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = '選択してください';
                    psaPlanSelect.appendChild(defaultOption);

                    psaPlans[region].forEach(function(plan) {
                        const option = document.createElement('option');
                        option.value = plan.value;
                        option.textContent = plan.label;
                        psaPlanSelect.appendChild(option);
                    });

                    psaPlanSelect.disabled = false;
                } else {
                    const defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = '先に代行プランを選択してください';
                    psaPlanSelect.appendChild(defaultOption);
                    psaPlanSelect.disabled = true;
                }
            });
        }

        // モーダルを開く
        function openModal() {
            modal.classList.add('active');
            lockScroll();
        }

        if (openBtn) {
            openBtn.addEventListener('click', openModal);
        }
        if (openBtnHero) {
            openBtnHero.addEventListener('click', openModal);
        }
        // クラスベースの見積もりボタン対応
        document.querySelectorAll('.open-estimate-modal').forEach(function(btn) {
            btn.addEventListener('click', openModal);
        });

        // モーダルを閉じる
        function closeModal() {
            modal.classList.remove('active');
            unlockScroll();
            // フォームと結果をリセット
            if (form) form.reset();
            if (resultDiv) resultDiv.style.display = 'none';
            // PSAプランをリセット
            if (psaPlanSelect) {
                psaPlanSelect.innerHTML = '<option value="">先に代行プランを選択してください</option>';
                psaPlanSelect.disabled = true;
            }
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                closeModal();
            });
        }

        if (overlay) {
            overlay.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                closeModal();
            });
        }

        // ESCキーで閉じる
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('active')) {
                closeModal();
            }
        });

        // 数字のみ許可（カンマは自動付与するため入力時は除外）
        var cardCountInput = document.getElementById('cardCount');
        var cardValueInput = document.getElementById('cardValue');

        if (cardCountInput) {
            cardCountInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        }

        if (cardValueInput) {
            cardValueInput.addEventListener('input', function() {
                var raw = this.value.replace(/[^0-9]/g, '');
                if (raw) {
                    this.value = Number(raw).toLocaleString('ja-JP');
                } else {
                    this.value = '';
                }
            });
        }

        // 見積もり計算
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const agencyPlanEl = document.getElementById('agencyPlan');
                const agencyPlan = parseFloat(agencyPlanEl.value);
                const psaPlan = parseFloat(document.getElementById('psaPlan').value);
                const cardCount = parseInt(document.getElementById('cardCount').value.replace(/,/g, ''));
                const cardValue = parseFloat(document.getElementById('cardValue').value.replace(/,/g, ''));

                if (!agencyPlan || !psaPlan || !cardCount || !cardValue) {
                    alert('すべての項目を入力してください');
                    return;
                }

                // 選択されたプランの地域（japan/usa）を取得
                const selectedOption = agencyPlanEl.options[agencyPlanEl.selectedIndex];
                const region = selectedOption ? selectedOption.getAttribute('data-region') : null;
                const isUSA = region === 'usa';

                // PSA鑑定料（円/枚 × 枚数）
                const psaFee = psaPlan * cardCount;

                // 代行手数料（カード申告額 × %）
                const agencyFee = cardValue * (agencyPlan / 100);

                // 見込み関税額（アメリカのみ、申告額の10％）
                const customsTax = isUSA ? cardValue * 0.10 : 0;

                // 合計
                const total = psaFee + agencyFee + customsTax;

                // 結果を表示
                document.getElementById('resultPsaFee').textContent = formatCurrency(psaFee);
                document.getElementById('resultAgencyFee').textContent = formatCurrency(agencyFee);
                document.getElementById('resultTotal').textContent = formatCurrency(total);

                // 関税額の表示制御（アメリカのみ表示）
                const customsTaxRow = document.getElementById('resultCustomsTaxRow');
                const customsTaxValue = document.getElementById('resultCustomsTax');
                if (isUSA && customsTaxRow && customsTaxValue) {
                    customsTaxValue.textContent = formatCurrency(customsTax);
                    customsTaxRow.style.display = '';
                } else if (customsTaxRow) {
                    customsTaxRow.style.display = 'none';
                }

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

    /**
     * アクセスボタン（ドロップダウン）- 複数対応
     */
    function initAccessButton() {
        var wrappers = document.querySelectorAll('.access-button-wrapper');

        if (!wrappers.length) return;

        wrappers.forEach(function(wrapper) {
            var accessButton = wrapper.querySelector('.access-button');

            if (!accessButton) return;

            // ボタンクリックでドロップダウン表示/非表示
            accessButton.addEventListener('click', function(e) {
                e.stopPropagation();
                // 他のドロップダウンを閉じる
                wrappers.forEach(function(w) {
                    if (w !== wrapper) w.classList.remove('open');
                });
                wrapper.classList.toggle('open');
            });

            // ドロップダウン内のリンククリック時も閉じる
            var dropdownLinks = wrapper.querySelectorAll('.access-button-dropdown a');
            dropdownLinks.forEach(function(link) {
                link.addEventListener('click', function() {
                    wrapper.classList.remove('open');
                });
            });

            // 口コミセクションへのスムーズスクロール
            var goToReviewBtn = wrapper.querySelector('.go-to-review-section');
            if (goToReviewBtn) {
                goToReviewBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    wrapper.classList.remove('open');
                    var reviewSection = document.getElementById('review');
                    if (reviewSection) {
                        reviewSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            }
        });

        // ドロップダウン外クリックで閉じる
        document.addEventListener('click', function(e) {
            wrappers.forEach(function(wrapper) {
                if (!wrapper.contains(e.target)) {
                    wrapper.classList.remove('open');
                }
            });
        });
    }

    /**
     * お問い合わせモーダル
     */
    function initContactModal() {
        var modal = document.getElementById('contactModal');
        var openBtn = document.getElementById('openContactModal');
        var closeBtn = document.getElementById('closeContactModal');
        var overlay = modal ? modal.querySelector('.contact-modal-overlay') : null;
        var wrappers = document.querySelectorAll('.access-button-wrapper');

        if (!modal) return;

        function openContactModalFunc(e) {
            e.preventDefault();
            modal.classList.add('active');
            lockScroll();
            // 全てのドロップダウンを閉じる
            wrappers.forEach(function(w) {
                w.classList.remove('open');
            });
        }

        // 開くボタン（ID）
        if (openBtn) {
            openBtn.addEventListener('click', openContactModalFunc);
        }

        // 開くボタン（クラス）
        document.querySelectorAll('.open-contact-modal').forEach(function(btn) {
            btn.addEventListener('click', openContactModalFunc);
        });

        // 閉じるボタン
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                modal.classList.remove('active');
                unlockScroll();
            });
        }

        // オーバーレイクリックで閉じる
        if (overlay) {
            overlay.addEventListener('click', function() {
                modal.classList.remove('active');
                unlockScroll();
            });
        }

        // ESCキーで閉じる
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('active')) {
                modal.classList.remove('active');
                unlockScroll();
            }
        });

        // フォーム送信後にモーダルを開く（エラーまたは成功時）
        var hasError = modal.querySelector('.contact-error-message');
        var hasSuccess = modal.querySelector('.contact-success-message');
        if (hasError || hasSuccess) {
            modal.classList.add('active');
            lockScroll();
        }
    }

})();