(function () {
    const footerTranslations = {
        pt: {
            footerText: "A ultrapassar os limites do desempenho humano. Cada quilómetro é um passo mais perto da excelência.",
            quickLinks: "Ligações Rápidas",
            home: "Início",
            history: "História",
            competitions: "Competições",
            partners: "Parceiros",
            shop: "Loja",
            athlete: "Atleta",
            training: "Treinos",
            gallery: "Galeria",
            faq: "FAQ",
            contact: "Contacto",
            followMe: "Segue-me",
            copyright: "© 2026 Lone Wolf. Todos os direitos reservados.",
            privacy: "Política de Privacidade",
            cookies: "Política de Cookies"
        },
        en: {
            footerText: "Pushing the limits of human performance. Every kilometre is one step closer to excellence.",
            quickLinks: "Quick Links",
            home: "Home",
            history: "History",
            competitions: "Competitions",
            partners: "Partners",
            shop: "Shop",
            athlete: "Athlete",
            training: "Training",
            gallery: "Gallery",
            faq: "FAQ",
            contact: "Contact",
            followMe: "Follow Me",
            copyright: "© 2026 Lone Wolf. All rights reserved.",
            privacy: "Privacy Policy",
            cookies: "Cookie Policy"
        }
    };

    const cookieTranslations = {
        pt: {
            title: "Privacidade e cookies",
            close: "Fechar",
            accept: "Aceitar",
            textHtml:
                'Utilizamos cookies essenciais para melhorar a tua experiência no site. Consulta a <a href="politica-de-privacidade.php">Política de Privacidade</a> e a <a href="politica-de-cookies.php">Política de Cookies</a>.'
        },
        en: {
            title: "Privacy and cookies",
            close: "Close",
            accept: "Accept",
            textHtml:
                'We use essential cookies to improve your experience on this site. See our <a href="politica-de-privacidade.php">Privacy Policy</a> and <a href="politica-de-cookies.php">Cookie Policy</a>.'
        }
    };

    function getSavedLanguage() {
        return localStorage.getItem("siteLanguage") || localStorage.getItem("lang") || "pt";
    }

    function applyHeaderTranslations(lang) {
        document.querySelectorAll("[data-pt][data-en]").forEach((element) => {
            if (element.dataset[lang]) {
                element.textContent = element.dataset[lang];
            }
        });
    }

    function applyFooterTranslations(lang) {
        if (!footerTranslations[lang]) return;

        document.querySelectorAll("[data-footer-i18n]").forEach((element) => {
            const key = element.getAttribute("data-footer-i18n");
            if (footerTranslations[lang][key]) {
                element.textContent = footerTranslations[lang][key];
            }
        });
    }

    function applyCookieTranslations(lang) {
        if (!cookieTranslations[lang]) return;

        document.querySelectorAll("[data-cookie-i18n]").forEach((element) => {
            const key = element.getAttribute("data-cookie-i18n");
            if (!cookieTranslations[lang][key]) return;

            if (key === "text") {
                element.innerHTML = cookieTranslations[lang].textHtml;
            } else {
                element.textContent = cookieTranslations[lang][key];
            }
        });
    }

    function applyPageTranslations(lang) {
        const dictionary = window.pageTranslations?.[lang];
        if (!dictionary) return;

        document.querySelectorAll("[data-i18n]").forEach((element) => {
            const key = element.getAttribute("data-i18n");
            if (!dictionary[key]) return;

            const value = dictionary[key];
            if (value.includes("\n") || value.includes("<br")) {
                element.innerHTML = value.replace(/\n/g, "<br>");
            } else {
                element.textContent = value;
            }
        });

        document.querySelectorAll("[data-i18n-alt]").forEach((element) => {
            const key = element.getAttribute("data-i18n-alt");
            if (dictionary[key]) {
                element.setAttribute("alt", dictionary[key]);
            }
        });

        document.querySelectorAll("[data-label-key]").forEach((element) => {
            const key = element.getAttribute("data-label-key");
            if (dictionary[key]) {
                element.setAttribute("data-label", dictionary[key]);
            }
        });

        document.querySelectorAll("[data-i18n-placeholder]").forEach((element) => {
            const key = element.getAttribute("data-i18n-placeholder");
            if (dictionary[key]) {
                element.setAttribute("placeholder", dictionary[key]);
            }
        });

        if (dictionary.pageTitle) {
            document.title = dictionary.pageTitle;
        }
    }

    window.setLanguage = function setLanguage(lang) {
        if (!lang) return;

        document.documentElement.lang = lang === "pt" ? "pt-pt" : "en";
        localStorage.setItem("siteLanguage", lang);
        localStorage.setItem("lang", lang);

        applyHeaderTranslations(lang);
        applyFooterTranslations(lang);
        applyCookieTranslations(lang);
        applyPageTranslations(lang);

        document.querySelectorAll("[data-lang]").forEach((button) => {
            button.classList.toggle("active", button.getAttribute("data-lang") === lang);
        });
    };

    function initLanguage() {
        const savedLanguage = getSavedLanguage();
        window.setLanguage(savedLanguage);

        document.querySelectorAll("[data-lang]").forEach((button) => {
            button.addEventListener("click", (event) => {
                event.preventDefault();
                window.setLanguage(button.getAttribute("data-lang"));
            });
        });
    }

    function initNavDropdown() {
        document.querySelectorAll(".lw-nav-dropdown-toggle").forEach((button) => {
            button.addEventListener("click", (event) => {
                event.preventDefault();
                event.stopPropagation();

                const dropdown = button.closest(".lw-nav-dropdown");
                if (!dropdown) return;

                const willOpen = !dropdown.classList.contains("is-open");

                document.querySelectorAll(".lw-nav-dropdown.is-open").forEach((item) => {
                    if (item !== dropdown) {
                        item.classList.remove("is-open");
                        item.querySelector(".lw-nav-dropdown-toggle")?.setAttribute("aria-expanded", "false");
                    }
                });

                dropdown.classList.toggle("is-open", willOpen);
                button.setAttribute("aria-expanded", willOpen ? "true" : "false");
            });
        });

        document.addEventListener("click", () => {
            document.querySelectorAll(".lw-nav-dropdown.is-open").forEach((dropdown) => {
                dropdown.classList.remove("is-open");
                dropdown.querySelector(".lw-nav-dropdown-toggle")?.setAttribute("aria-expanded", "false");
            });
        });
    }

    function initMobileMenu() {
        const header = document.querySelector(".lw-header");
        const toggle = document.querySelector(".lw-nav-toggle");
        const menuLinks = document.querySelectorAll(".lw-nav-link:not(.lw-nav-dropdown-toggle), .lw-nav-dropdown-menu a");

        if (!header || !toggle) return;

        toggle.addEventListener("click", () => {
            const isOpen = header.classList.toggle("menu-open");
            toggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
        });

        menuLinks.forEach((link) => {
            link.addEventListener("click", () => {
                header.classList.remove("menu-open");
                toggle.setAttribute("aria-expanded", "false");
            });
        });
    }

    function initHeaderScroll() {
        const header = document.querySelector(".lw-header");
        if (!header) return;

        const sync = () => header.classList.toggle("is-scrolled", window.scrollY > 10);
        sync();
        window.addEventListener("scroll", sync, { passive: true });
    }

    function initReveal() {
        const revealElements = document.querySelectorAll(".reveal-page");

        revealElements.forEach((element, index) => {
            element.style.transitionDelay = `${index * 0.03}s`;
        });

        const revealObserver = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    entry.target.classList.toggle("reveal-visible", entry.isIntersecting);
                });
            },
            { threshold: 0.15 }
        );

        revealElements.forEach((element) => revealObserver.observe(element));
    }

    function initCookieBanner() {
        const banner = document.getElementById("cookie-banner");
        const btnFechar = document.getElementById("cookie-fechar");
        const btnAceitar = document.getElementById("cookie-aceitar");
        const storageKey = "lonewolfCookieConsent";

        if (!banner) return;

        function hideBanner() {
            banner.classList.remove("is-visible");
            banner.hidden = true;
        }

        function showBanner() {
            banner.hidden = false;
            requestAnimationFrame(() => banner.classList.add("is-visible"));
        }

        let jaAceitou = false;

        try {
            jaAceitou = localStorage.getItem(storageKey) === "accepted";
        } catch (error) {
            jaAceitou = false;
        }

        if (jaAceitou) {
            hideBanner();
        } else {
            showBanner();
        }

        btnFechar?.addEventListener("click", hideBanner);

        btnAceitar?.addEventListener("click", () => {
            try {
                localStorage.setItem(storageKey, "accepted");
            } catch (error) {
                /* navegador sem suporte ou modo privado */
            }
            hideBanner();
        });
    }

    window.abrirWhatsappFooter = function abrirWhatsappFooter() {
        const numero = "351969758699";
        const mensagem = "Olá, vim através do site Lone Wolf e gostava de obter mais informações.";
        window.open(`https://wa.me/${numero}?text=${encodeURIComponent(mensagem)}`, "_blank");
    };

    document.addEventListener("DOMContentLoaded", () => {
        initLanguage();
        initNavDropdown();
        initMobileMenu();
        initHeaderScroll();
        initReveal();
        initCookieBanner();
    });
})();
