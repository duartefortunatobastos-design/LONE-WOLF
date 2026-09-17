document.addEventListener("DOMContentLoaded", () => {
    const allItems = window.galeriaData || [];
    const mount = document.getElementById("galeria-conteudo");
    const filtersNav = document.querySelector(".galeria-filtros");
    const filterButtons = [...document.querySelectorAll(".galeria-filtros .filtro-btn")];

    if (!mount) return;

    let activeFilter = window.galeriaFiltroInicial || "todos";
    let isAnimating = false;

    const getLang = () => localStorage.getItem("siteLanguage") || localStorage.getItem("lang") || "pt";

    const t = (key) => window.pageTranslations?.[getLang()]?.[key] || window.pageTranslations?.pt?.[key] || "";

    const applyTranslations = () => {
        if (typeof window.setLanguage === "function") {
            window.setLanguage(getLang());
        }
    };

    const filterItems = (categoria) => {
        if (categoria === "todos") return [...allItems];
        return allItems.filter((item) => item.categoria === categoria);
    };

    const getCardSizes = (className) => {
        if (className.includes("foto-destaque")) {
            return "(min-width: 900px) 50vw, 100vw";
        }

        if (className.includes("foto-card")) {
            return "(min-width: 900px) 25vw, 100vw";
        }

        if (className.includes("galeria-bento-card--1") || className.includes("galeria-bento-card--4")) {
            return "(min-width: 900px) 58vw, 100vw";
        }

        if (className.includes("galeria-bento-card--2") || className.includes("galeria-bento-card--3")) {
            return "(min-width: 900px) 42vw, 100vw";
        }

        return "(min-width: 900px) 50vw, 100vw";
    };

    const buildSrcSet = (src) => `${src} 1400w, ${src} 900w, ${src} 600w`;

    const preloadedImages = new Set();

    const preloadImage = (src) => {
        if (!src || preloadedImages.has(src)) return;
        preloadedImages.add(src);

        const link = document.createElement("link");
        link.rel = "preload";
        link.as = "image";
        link.href = src;
        document.head.appendChild(link);
    };

    const preloadAdjacentLightboxImages = (index) => {
        if (!items.length) return;

        const prevItem = items[(index - 1 + items.length) % items.length];
        const nextItem = items[(index + 1) % items.length];

        preloadImage(prevItem?.img);
        preloadImage(nextItem?.img);
    };

    const createTrigger = (item, className, eager = false) => {
        const btn = document.createElement("button");
        btn.type = "button";
        const orientacao = item.orientacao || "portrait";
        btn.className = `galeria-lightbox-trigger album-shot album-shot--${orientacao} ${className}`.trim();
        btn.dataset.img = encodeURI(item.imagem);
        btn.dataset.title = item.titulo;
        btn.dataset.desc = item.descricao;

        const media = document.createElement("picture");
        media.className = "galeria-picture";

        if (item.imagem_webp) {
            const source = document.createElement("source");
            source.type = "image/webp";
            source.srcset = buildSrcSet(encodeURI(item.imagem_webp));
            source.sizes = getCardSizes(className);
            media.appendChild(source);
        }

        const img = document.createElement("img");
        img.alt = item.titulo || item.tag;
        img.decoding = "async";
        img.sizes = getCardSizes(className);
        img.src = encodeURI(item.imagem);
        img.srcset = buildSrcSet(encodeURI(item.imagem));
        img.loading = eager ? "eager" : "lazy";

        if (eager && "fetchPriority" in img) {
            img.fetchPriority = "high";
        }

        media.appendChild(img);

        btn.appendChild(media);

        return btn;
    };

    const buildLayout = (categoria) => {
        const fragment = document.createDocumentFragment();
        const items = filterItems(categoria);

        if (!items.length) {
            const empty = document.createElement("p");
            empty.className = "galeria-vazia";
            empty.dataset.i18n = "galeriaVazia";
            empty.textContent = t("galeriaVazia");
            fragment.appendChild(empty);
            return fragment;
        }

        const grid = document.createElement("section");
        grid.className = "galeria-album page-block";
        grid.setAttribute("aria-label", "Álbum de fotografias");

        items.forEach((item, index) => {
            grid.appendChild(createTrigger(item, "galeria-card", index < 2));
        });

        fragment.appendChild(grid);
        return fragment;
    };

    const updateUrl = (categoria) => {
        const url = categoria === "todos"
            ? `${window.location.pathname}`
            : `${window.location.pathname}?categoria=${encodeURIComponent(categoria)}`;
        window.history.replaceState({ categoria }, "", url);
    };

    const setActiveFilterButton = (categoria) => {
        filterButtons.forEach((btn) => {
            const isActive = btn.dataset.categoria === categoria;
            btn.classList.toggle("activo", isActive);
            btn.setAttribute("aria-selected", isActive ? "true" : "false");
        });
    };

    // —— Lightbox ——
    const lightbox = document.getElementById("galeria-lightbox");
    const img = document.getElementById("galeria-lightbox-img");
    const counter = document.getElementById("galeria-lightbox-counter");
    const thumbsWrap = document.getElementById("galeria-lightbox-thumbs");
    const closeBtn = lightbox?.querySelector(".galeria-lightbox-close");
    const prevBtn = lightbox?.querySelector(".galeria-lightbox-prev");
    const nextBtn = lightbox?.querySelector(".galeria-lightbox-next");
    const stage = lightbox?.querySelector(".galeria-lightbox-stage");

    let items = [];
    let currentIndex = 0;
    let touchStartX = 0;

    const syncItemsFromDom = () => {
        const triggers = [...mount.querySelectorAll(".galeria-lightbox-trigger")];
        items = triggers.map((trigger) => ({
            img: trigger.dataset.img || "",
            title: trigger.dataset.title || "",
            desc: trigger.dataset.desc || "",
        }));
        return triggers;
    };

    const buildThumbs = () => {
        if (!thumbsWrap) return;
        thumbsWrap.innerHTML = "";

        items.forEach((item, index) => {
            const btn = document.createElement("button");
            btn.type = "button";
            btn.className = "galeria-lightbox-thumb";
            btn.setAttribute("aria-label", `${index + 1}`);
            if (index === currentIndex) btn.classList.add("activo");

            const thumbImg = document.createElement("img");
            thumbImg.src = item.img;
            thumbImg.alt = "";
            thumbImg.loading = "lazy";
            thumbImg.decoding = "async";

            btn.appendChild(thumbImg);
            btn.addEventListener("click", () => show(index));
            thumbsWrap.appendChild(btn);
        });
    };

    const updateThumbs = () => {
        thumbsWrap?.querySelectorAll(".galeria-lightbox-thumb").forEach((thumb, index) => {
            thumb.classList.toggle("activo", index === currentIndex);
        });
    };

    const updateMeta = () => {
        const item = items[currentIndex];
        if (!item) return;

        if (counter) counter.textContent = `${currentIndex + 1} / ${items.length}`;

        if (prevBtn) prevBtn.disabled = items.length <= 1;
        if (nextBtn) nextBtn.disabled = items.length <= 1;
    };

    const showImage = (src, alt) => {
        preloadImage(src);
        img.classList.add("is-fading");

        const onReady = () => {
            img.classList.remove("is-fading");
            img.removeEventListener("load", onReady);
        };

        img.addEventListener("load", onReady);

        window.setTimeout(() => {
            img.src = src;
            img.alt = alt;
            if (img.complete) onReady();
        }, 120);
    };

    const show = (index) => {
        if (!items.length) return;

        currentIndex = (index + items.length) % items.length;
        const item = items[currentIndex];

        showImage(item.img, item.title);
        updateMeta();
        updateThumbs();
        preloadAdjacentLightboxImages(currentIndex);
    };

    const open = (index) => {
        if (!lightbox || !items.length) return;

        currentIndex = index;
        lightbox.hidden = false;
        document.body.style.overflow = "hidden";
        buildThumbs();
        show(currentIndex);
    };

    const close = () => {
        if (!lightbox) return;

        lightbox.hidden = true;
        img.src = "";
        img.classList.remove("is-fading");
        document.body.style.overflow = "";
    };

    const prev = () => show(currentIndex - 1);
    const next = () => show(currentIndex + 1);

    const bindLightboxTriggers = () => {
        const triggers = syncItemsFromDom();
        triggers.forEach((trigger, index) => {
            trigger.addEventListener("click", () => open(index));
        });
    };

    closeBtn?.addEventListener("click", close);
    prevBtn?.addEventListener("click", prev);
    nextBtn?.addEventListener("click", next);

    lightbox?.addEventListener("click", (event) => {
        if (event.target === lightbox) close();
    });

    document.addEventListener("keydown", (event) => {
        if (!lightbox || lightbox.hidden) return;

        if (event.key === "Escape") close();
        if (event.key === "ArrowLeft") prev();
        if (event.key === "ArrowRight") next();
    });

    stage?.addEventListener("touchstart", (event) => {
        touchStartX = event.changedTouches[0]?.screenX || 0;
    }, { passive: true });

    stage?.addEventListener("touchend", (event) => {
        const touchEndX = event.changedTouches[0]?.screenX || 0;
        const diff = touchEndX - touchStartX;

        if (Math.abs(diff) < 48) return;
        if (diff > 0) prev();
        else next();
    }, { passive: true });

    // —— Scroll, parallax & micro-animações ——
    const getHeaderOffset = () => {
        const raw = getComputedStyle(document.documentElement).getPropertyValue("--lw-header-height");
        return (parseInt(raw, 10) || 80) + 16;
    };

    const scrollToSection = (selector) => {
        const target = document.querySelector(selector);
        if (!target) return;

        const top = target.getBoundingClientRect().top + window.scrollY - getHeaderOffset();
        window.scrollTo({ top: Math.max(0, top), behavior: "smooth" });
    };

    const initSmoothScroll = () => {
        document.querySelectorAll('a[href^="#galeria-"]').forEach((link) => {
            link.addEventListener("click", (event) => {
                const hash = link.getAttribute("href");
                if (!hash || hash === "#") return;

                const target = document.querySelector(hash);
                if (!target) return;

                event.preventDefault();
                scrollToSection(hash);
            });
        });
    };

    const initHeroParallax = () => {
        const hero = document.querySelector(".pagina-galeria .hero-galeria");
        if (!hero || window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

        let ticking = false;

        const updateParallax = () => {
            const rect = hero.getBoundingClientRect();
            if (rect.bottom <= 0 || rect.top >= window.innerHeight) {
                ticking = false;
                return;
            }

            const progress = Math.max(-1, Math.min(1, -rect.top / Math.max(rect.height, 1)));
            hero.style.setProperty("--hero-parallax", String(progress * 48));
            ticking = false;
        };

        window.addEventListener("scroll", () => {
            if (ticking) return;
            ticking = true;
            requestAnimationFrame(updateParallax);
        }, { passive: true });

        updateParallax();
    };

    const animateCards = () => {
        mount.querySelectorAll(".galeria-lightbox-trigger").forEach((card, index) => {
            card.classList.remove("galeria-card-enter");
            card.style.animationDelay = `${Math.min(index * 0.045, 0.36)}s`;
            void card.offsetWidth;
            card.classList.add("galeria-card-enter");
        });
    };

    // —— Render & filtros ——
    const renderGallery = (categoria, animate = true, scrollToContent = false) => {
        if (isAnimating) return;

        const paint = () => {
            try {
                mount.innerHTML = "";
                mount.appendChild(buildLayout(categoria));
                applyTranslations();
                bindLightboxTriggers();
                animateCards();
                activeFilter = categoria;
                setActiveFilterButton(categoria);
                updateUrl(categoria);

                if (scrollToContent) {
                    window.setTimeout(() => scrollToSection("#galeria-conteudo"), animate ? 260 : 0);
                }

                if (animate) {
                    mount.classList.remove("is-leaving");
                    mount.classList.add("is-entering");
                    requestAnimationFrame(() => {
                        mount.classList.remove("is-entering");
                    });
                }
            } finally {
                isAnimating = false;
            }
        };

        if (!animate) {
            paint();
            return;
        }

        isAnimating = true;
        mount.classList.add("is-leaving");

        window.setTimeout(paint, 240);
    };

    const onFilterClick = (event) => {
        const btn = event.target.closest(".filtro-btn");
        if (!btn || !filtersNav?.contains(btn)) return;

        event.preventDefault();
        const categoria = btn.dataset.categoria || "todos";
        if (categoria === activeFilter) return;
        renderGallery(categoria, true, true);
    };

    filtersNav?.addEventListener("click", onFilterClick);

    initSmoothScroll();
    initHeroParallax();

    if (mount.querySelector(".galeria-lightbox-trigger")) {
        applyTranslations();
        bindLightboxTriggers();
        animateCards();
        setActiveFilterButton(activeFilter);
    } else {
        renderGallery(activeFilter, false);
    }
});
