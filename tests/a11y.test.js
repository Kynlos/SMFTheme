import { jest } from '@jest/globals';
import { utils } from '../js/utils';

describe('Accessibility Utils', () => {
    describe('handleEscapeKey', () => {
        it('should call callback when Escape key is pressed', () => {
            const callback = jest.fn();
            utils.a11y.handleEscapeKey(callback);

            const event = new KeyboardEvent('keydown', { key: 'Escape' });
            document.dispatchEvent(event);

            expect(callback).toHaveBeenCalled();
        });

        it('should not call callback for other keys', () => {
            const callback = jest.fn();
            utils.a11y.handleEscapeKey(callback);

            const event = new KeyboardEvent('keydown', { key: 'Enter' });
            document.dispatchEvent(event);

            expect(callback).not.toHaveBeenCalled();
        });
    });

    describe('trapFocus', () => {
        let container;
        let firstButton;
        let middleButton;
        let lastButton;

        beforeEach(() => {
            container = document.createElement('div');
            firstButton = document.createElement('button');
            middleButton = document.createElement('button');
            lastButton = document.createElement('button');

            container.appendChild(firstButton);
            container.appendChild(middleButton);
            container.appendChild(lastButton);

            document.body.appendChild(container);
        });

        afterEach(() => {
            document.body.removeChild(container);
        });

        it('should trap focus within container', () => {
            utils.a11y.trapFocus(container);

            // Simulate Tab key on last element
            lastButton.focus();
            const tabEvent = new KeyboardEvent('keydown', {
                key: 'Tab',
                bubbles: true,
                cancelable: true
            });
            lastButton.dispatchEvent(tabEvent);

            // Focus should move to first element
            expect(document.activeElement).toBe(firstButton);
        });

        it('should handle shift+tab at start of container', () => {
            utils.a11y.trapFocus(container);

            // Simulate Shift+Tab on first element
            firstButton.focus();
            const shiftTabEvent = new KeyboardEvent('keydown', {
                key: 'Tab',
                shiftKey: true,
                bubbles: true,
                cancelable: true
            });
            firstButton.dispatchEvent(shiftTabEvent);

            // Focus should move to last element
            expect(document.activeElement).toBe(lastButton);
        });
    });

    describe('announceMessage', () => {
        let originalAriaLive;

        beforeEach(() => {
            // Save any existing aria-live region
            originalAriaLive = document.querySelector('[aria-live="polite"]');
        });

        afterEach(() => {
            // Clean up any announcement elements
            const announcer = document.querySelector('[aria-live="polite"]');
            if (announcer) {
                document.body.removeChild(announcer);
            }
            // Restore original aria-live region if it existed
            if (originalAriaLive) {
                document.body.appendChild(originalAriaLive);
            }
        });

        it('should create aria-live region and announce message', () => {
            const message = 'Test announcement';
            utils.a11y.announceMessage(message);

            const announcer = document.querySelector('[aria-live="polite"]');
            expect(announcer).toBeTruthy();
            expect(announcer.textContent).toBe(message);
        });

        it('should update existing aria-live region with new message', () => {
            const firstMessage = 'First announcement';
            const secondMessage = 'Second announcement';

            utils.a11y.announceMessage(firstMessage);
            utils.a11y.announceMessage(secondMessage);

            const announcers = document.querySelectorAll('[aria-live="polite"]');
            expect(announcers.length).toBe(1);
            expect(announcers[0].textContent).toBe(secondMessage);
        });

        it('should handle empty messages', () => {
            utils.a11y.announceMessage('');
            const announcer = document.querySelector('[aria-live="polite"]');
            expect(announcer).toBeTruthy();
            expect(announcer.textContent).toBe('');
        });
    });
});
