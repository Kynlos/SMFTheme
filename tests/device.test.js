import { utils } from '../js/utils';

describe('Device Utils', () => {
    let originalUserAgent;
    let originalMatchMedia;

    beforeEach(() => {
        originalUserAgent = navigator.userAgent;
        originalMatchMedia = window.matchMedia;
    });

    afterEach(() => {
        Object.defineProperty(navigator, 'userAgent', {
            value: originalUserAgent,
            configurable: true
        });
        window.matchMedia = originalMatchMedia;
    });

    describe('isMobile', () => {
        it('should detect mobile devices', () => {
            const mobileUserAgents = [
                'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X)',
                'Mozilla/5.0 (Linux; Android 11; SM-G991B)',
                'Mozilla/5.0 (iPad; CPU OS 13_2_3 like Mac OS X)'
            ];

            mobileUserAgents.forEach(ua => {
                Object.defineProperty(navigator, 'userAgent', {
                    value: ua,
                    configurable: true
                });
                expect(utils.device.isMobile()).toBe(true);
            });
        });

        it('should not detect desktop as mobile', () => {
            const desktopUserAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)';
            Object.defineProperty(navigator, 'userAgent', {
                value: desktopUserAgent,
                configurable: true
            });
            expect(utils.device.isMobile()).toBe(false);
        });
    });

    describe('isTablet', () => {
        it('should detect tablet devices', () => {
            const tabletUserAgents = [
                'Mozilla/5.0 (iPad; CPU OS 13_2_3 like Mac OS X)',
                'Mozilla/5.0 (Linux; Android 11; SM-T500)'
            ];

            tabletUserAgents.forEach(ua => {
                Object.defineProperty(navigator, 'userAgent', {
                    value: ua,
                    configurable: true
                });
                expect(utils.device.isTablet()).toBe(true);
            });
        });

        it('should not detect phones as tablets', () => {
            const phoneUserAgent = 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X)';
            Object.defineProperty(navigator, 'userAgent', {
                value: phoneUserAgent,
                configurable: true
            });
            expect(utils.device.isTablet()).toBe(false);
        });
    });

    describe('isDesktop', () => {
        it('should detect desktop devices', () => {
            const desktopUserAgents = [
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)',
                'Mozilla/5.0 (X11; Linux x86_64)'
            ];

            desktopUserAgents.forEach(ua => {
                Object.defineProperty(navigator, 'userAgent', {
                    value: ua,
                    configurable: true
                });
                expect(utils.device.isDesktop()).toBe(true);
            });
        });

        it('should not detect mobile devices as desktop', () => {
            const mobileUserAgent = 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X)';
            Object.defineProperty(navigator, 'userAgent', {
                value: mobileUserAgent,
                configurable: true
            });
            expect(utils.device.isDesktop()).toBe(false);
        });
    });

    describe('getBrowser', () => {
        it('should detect Chrome', () => {
            const chromeUA = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36';
            Object.defineProperty(navigator, 'userAgent', {
                value: chromeUA,
                configurable: true
            });
            expect(utils.device.getBrowser()).toBe('Chrome');
        });

        it('should detect Firefox', () => {
            const firefoxUA = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0';
            Object.defineProperty(navigator, 'userAgent', {
                value: firefoxUA,
                configurable: true
            });
            expect(utils.device.getBrowser()).toBe('Firefox');
        });

        it('should detect Safari', () => {
            const safariUA = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.1.1 Safari/605.1.15';
            Object.defineProperty(navigator, 'userAgent', {
                value: safariUA,
                configurable: true
            });
            expect(utils.device.getBrowser()).toBe('Safari');
        });

        it('should detect Edge', () => {
            const edgeUA = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36 Edg/91.0.864.59';
            Object.defineProperty(navigator, 'userAgent', {
                value: edgeUA,
                configurable: true
            });
            expect(utils.device.getBrowser()).toBe('Edge');
        });
    });
});
