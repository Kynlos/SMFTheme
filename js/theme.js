// Theme Management and Modern Interactions
class ThemeManager {
    constructor() {
        this.init();
    }

    init() {
        this.setupThemeToggle();
        this.setupSidebar();
        this.setupBackToTop();
        this.setupDropdowns();
        this.setupMobileMenu();
        this.setupSearchBar();
        this.setupTooltips();
        this.setupModals();
        this.setupScrollEffects();
    }

    // Theme Toggle Functionality
    setupThemeToggle() {
        const themeToggle = document.getElementById('theme-toggle');
        if (!themeToggle) return;

        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            // Update toggle button state
            themeToggle.setAttribute('aria-label', `Switch to ${currentTheme} mode`);
        });

        // Set initial theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
    }

    // Sidebar Functionality
    setupSidebar() {
        const sidebar = document.querySelector('.sidebar');
        const collapseBtn = document.querySelector('.sidebar-collapse');
        const overlay = document.querySelector('.sidebar-overlay');

        if (!sidebar) return;

        // Collapse button functionality
        if (collapseBtn) {
            collapseBtn.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                localStorage.setItem('sidebar-collapsed', sidebar.classList.contains('collapsed'));
            });
        }

        // Mobile menu functionality
        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('mobile-open');
                overlay.classList.remove('mobile-open');
            });
        }

        // Restore sidebar state
        const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
        if (isCollapsed) {
            sidebar.classList.add('collapsed');
        }
    }

    // Back to Top Button
    setupBackToTop() {
        const backToTop = document.querySelector('.footer-back-to-top');
        if (!backToTop) return;

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 100) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });

        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Dropdown Menus
    setupDropdowns() {
        const dropdowns = document.querySelectorAll('.dropdown-toggle');
        
        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('click', (e) => {
                e.preventDefault();
                const menu = dropdown.nextElementSibling;
                
                // Close other dropdowns
                dropdowns.forEach(other => {
                    if (other !== dropdown) {
                        other.nextElementSibling.classList.remove('show');
                    }
                });

                menu.classList.toggle('show');
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.matches('.dropdown-toggle')) {
                document.querySelectorAll('.dropdown-menu.show')
                    .forEach(menu => menu.classList.remove('show'));
            }
        });
    }

    // Mobile Menu Toggle
    setupMobileMenu() {
        const menuToggle = document.querySelector('.mobile-menu-toggle');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.sidebar-overlay');

        if (!menuToggle || !sidebar || !overlay) return;

        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('mobile-open');
            overlay.classList.toggle('mobile-open');
        });
    }

    // Search Bar Functionality
    setupSearchBar() {
        const searchInput = document.querySelector('.search-input');
        const searchResults = document.querySelector('.search-results');
        
        if (!searchInput || !searchResults) return;

        let debounceTimer;

        searchInput.addEventListener('input', (e) => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                const query = e.target.value.trim();
                if (query.length >= 2) {
                    // Implement your search logic here
                    this.performSearch(query);
                } else {
                    searchResults.style.display = 'none';
                }
            }, 300);
        });
    }

    // Tooltip Implementation
    setupTooltips() {
        const tooltips = document.querySelectorAll('[data-tooltip]');
        
        tooltips.forEach(element => {
            element.addEventListener('mouseenter', (e) => {
                const tooltip = document.createElement('div');
                tooltip.className = 'tooltip';
                tooltip.textContent = element.getAttribute('data-tooltip');
                document.body.appendChild(tooltip);

                const rect = element.getBoundingClientRect();
                tooltip.style.top = `${rect.top - tooltip.offsetHeight - 10}px`;
                tooltip.style.left = `${rect.left + (rect.width - tooltip.offsetWidth) / 2}px`;
            });

            element.addEventListener('mouseleave', () => {
                document.querySelector('.tooltip')?.remove();
            });
        });
    }

    // Modal Functionality
    setupModals() {
        const modalTriggers = document.querySelectorAll('[data-modal]');
        
        modalTriggers.forEach(trigger => {
            trigger.addEventListener('click', () => {
                const modalId = trigger.getAttribute('data-modal');
                const modal = document.getElementById(modalId);
                
                if (modal) {
                    modal.classList.add('show');
                    document.body.style.overflow = 'hidden';
                }
            });
        });

        // Close modal functionality
        document.querySelectorAll('.modal-close, .modal-overlay').forEach(element => {
            element.addEventListener('click', () => {
                element.closest('.modal').classList.remove('show');
                document.body.style.overflow = '';
            });
        });
    }

    // Scroll Effects
    setupScrollEffects() {
        const scrollElements = document.querySelectorAll('.scroll-reveal');
        
        const elementInView = (el, offset = 0) => {
            const elementTop = el.getBoundingClientRect().top;
            return (elementTop <= window.innerHeight - offset);
        };

        const displayScrollElement = (element) => {
            element.classList.add('scrolled');
        };

        const handleScrollAnimation = () => {
            scrollElements.forEach((el) => {
                if (elementInView(el, 100)) {
                    displayScrollElement(el);
                }
            });
        };

        window.addEventListener('scroll', () => {
            handleScrollAnimation();
        });
    }

    // Search Implementation
    async performSearch(query) {
        // Implement your search logic here
        // This is a placeholder for the actual search implementation
        const searchResults = document.querySelector('.search-results');
        searchResults.style.display = 'block';
        searchResults.innerHTML = '<div class="loading">Searching...</div>';

        try {
            // Replace this with your actual search API call
            const results = await this.searchAPI(query);
            this.displaySearchResults(results);
        } catch (error) {
            searchResults.innerHTML = '<div class="error">Error performing search</div>';
        }
    }

    // API Search Method (placeholder)
    async searchAPI(query) {
        // Implement your actual API call here
        return new Promise(resolve => {
            setTimeout(() => {
                resolve([
                    { title: 'Result 1', url: '#' },
                    { title: 'Result 2', url: '#' }
                ]);
            }, 500);
        });
    }

    // Display Search Results
    displaySearchResults(results) {
        const searchResults = document.querySelector('.search-results');
        if (!results.length) {
            searchResults.innerHTML = '<div class="no-results">No results found</div>';
            return;
        }

        const html = results.map(result => `
            <a href="${result.url}" class="search-result-item">
                <div class="search-result-title">${result.title}</div>
            </a>
        `).join('');

        searchResults.innerHTML = html;
    }
}

// Initialize Theme Manager
document.addEventListener('DOMContentLoaded', () => {
    window.themeManager = new ThemeManager();
});
