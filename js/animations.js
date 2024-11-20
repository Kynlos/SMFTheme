// Modern Animations and Transitions
class AnimationManager {
    constructor() {
        this.init();
    }

    init() {
        this.setupPageTransitions();
        this.setupScrollAnimations();
        this.setupHoverEffects();
        this.setupLoadingStates();
        this.setupModalAnimations();
        this.setupToastAnimations();
    }

    // Page Transitions
    setupPageTransitions() {
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a[href^="/"]');
            if (!link || e.ctrlKey || e.shiftKey || e.metaKey) return;

            e.preventDefault();
            this.transitionToPage(link.href);
        });
    }

    async transitionToPage(url) {
        const transition = document.createElement('div');
        transition.className = 'page-transition';
        document.body.appendChild(transition);

        await this.animate(transition, [
            { opacity: 0 },
            { opacity: 1 }
        ], {
            duration: 300,
            easing: 'ease-out'
        });

        window.location.href = url;
    }

    // Scroll Animations
    setupScrollAnimations() {
        const animatedElements = document.querySelectorAll('[data-animate]');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    const animation = element.getAttribute('data-animate');
                    this.playAnimation(element, animation);
                    observer.unobserve(element);
                }
            });
        }, {
            threshold: 0.2
        });

        animatedElements.forEach(element => observer.observe(element));
    }

    playAnimation(element, animation) {
        const animations = {
            fadeIn: [
                { opacity: 0, transform: 'translateY(20px)' },
                { opacity: 1, transform: 'translateY(0)' }
            ],
            slideIn: [
                { transform: 'translateX(-100%)' },
                { transform: 'translateX(0)' }
            ],
            scaleIn: [
                { transform: 'scale(0.8)', opacity: 0 },
                { transform: 'scale(1)', opacity: 1 }
            ]
        };

        const timing = {
            duration: 600,
            easing: 'cubic-bezier(0.4, 0, 0.2, 1)',
            fill: 'forwards'
        };

        element.animate(animations[animation] || animations.fadeIn, timing);
    }

    // Hover Effects
    setupHoverEffects() {
        const hoverElements = document.querySelectorAll('[data-hover]');

        hoverElements.forEach(element => {
            element.addEventListener('mouseenter', () => {
                const effect = element.getAttribute('data-hover');
                this.playHoverEffect(element, effect, 'enter');
            });

            element.addEventListener('mouseleave', () => {
                const effect = element.getAttribute('data-hover');
                this.playHoverEffect(element, effect, 'leave');
            });
        });
    }

    playHoverEffect(element, effect, state) {
        const effects = {
            lift: {
                enter: { transform: 'translateY(-5px)' },
                leave: { transform: 'translateY(0)' }
            },
            glow: {
                enter: { boxShadow: '0 0 20px rgba(var(--primary-rgb), 0.3)' },
                leave: { boxShadow: 'none' }
            },
            scale: {
                enter: { transform: 'scale(1.05)' },
                leave: { transform: 'scale(1)' }
            }
        };

        const timing = {
            duration: 200,
            easing: 'ease-out',
            fill: 'forwards'
        };

        element.animate([effects[effect][state]], timing);
    }

    // Loading States
    setupLoadingStates() {
        const buttons = document.querySelectorAll('button[type="submit"]');
        
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                if (button.form?.checkValidity()) {
                    this.showLoadingState(button);
                }
            });
        });
    }

    showLoadingState(button) {
        const originalContent = button.innerHTML;
        const spinner = document.createElement('div');
        spinner.className = 'spinner';
        
        button.innerHTML = '';
        button.appendChild(spinner);
        button.disabled = true;

        // Restore button state after form submission
        const form = button.form;
        if (form) {
            const submitHandler = async (e) => {
                try {
                    await new Promise(resolve => setTimeout(resolve, 1000)); // Simulated delay
                    button.innerHTML = originalContent;
                    button.disabled = false;
                } catch (error) {
                    console.error('Form submission error:', error);
                } finally {
                    form.removeEventListener('submit', submitHandler);
                }
            };

            form.addEventListener('submit', submitHandler);
        }
    }

    // Modal Animations
    setupModalAnimations() {
        document.addEventListener('click', (e) => {
            const modalTrigger = e.target.closest('[data-modal-trigger]');
            if (!modalTrigger) return;

            const modalId = modalTrigger.getAttribute('data-modal-trigger');
            const modal = document.getElementById(modalId);
            if (modal) {
                this.animateModal(modal, 'open');
            }
        });

        // Close modal animations
        document.addEventListener('click', (e) => {
            const closeButton = e.target.closest('.modal-close');
            if (closeButton) {
                const modal = closeButton.closest('.modal');
                this.animateModal(modal, 'close');
            }
        });
    }

    async animateModal(modal, action) {
        const overlay = modal.querySelector('.modal-overlay');
        const content = modal.querySelector('.modal-content');

        const animations = {
            open: {
                overlay: [
                    { opacity: 0 },
                    { opacity: 1 }
                ],
                content: [
                    { opacity: 0, transform: 'scale(0.95)' },
                    { opacity: 1, transform: 'scale(1)' }
                ]
            },
            close: {
                overlay: [
                    { opacity: 1 },
                    { opacity: 0 }
                ],
                content: [
                    { opacity: 1, transform: 'scale(1)' },
                    { opacity: 0, transform: 'scale(0.95)' }
                ]
            }
        };

        const timing = {
            duration: 200,
            easing: 'ease-out',
            fill: 'forwards'
        };

        if (action === 'open') {
            modal.style.display = 'flex';
            await Promise.all([
                overlay.animate(animations.open.overlay, timing).finished,
                content.animate(animations.open.content, timing).finished
            ]);
        } else {
            await Promise.all([
                overlay.animate(animations.close.overlay, timing).finished,
                content.animate(animations.close.content, timing).finished
            ]);
            modal.style.display = 'none';
        }
    }

    // Toast Notifications
    setupToastAnimations() {
        const toastContainer = document.createElement('div');
        toastContainer.className = 'toast-container';
        document.body.appendChild(toastContainer);

        // Listen for custom toast events
        document.addEventListener('showToast', (e) => {
            this.showToast(e.detail.message, e.detail.type);
        });
    }

    async showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.textContent = message;

        const container = document.querySelector('.toast-container');
        container.appendChild(toast);

        await this.animate(toast, [
            { transform: 'translateX(100%)', opacity: 0 },
            { transform: 'translateX(0)', opacity: 1 }
        ], {
            duration: 300,
            easing: 'ease-out'
        });

        await new Promise(resolve => setTimeout(resolve, 3000));

        await this.animate(toast, [
            { transform: 'translateX(0)', opacity: 1 },
            { transform: 'translateX(100%)', opacity: 0 }
        ], {
            duration: 300,
            easing: 'ease-in'
        });

        toast.remove();
    }

    // Utility Methods
    async animate(element, keyframes, options) {
        const animation = element.animate(keyframes, options);
        await animation.finished;
        return animation;
    }
}

// Initialize Animation Manager
document.addEventListener('DOMContentLoaded', () => {
    window.animationManager = new AnimationManager();
});
