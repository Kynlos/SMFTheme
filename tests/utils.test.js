import { jest } from '@jest/globals';
import { utils } from '../js/utils';

describe('Utils', () => {
    describe('createElement', () => {
        it('should create an element with the specified tag', () => {
            const element = utils.createElement('div');
            expect(element.tagName).toBe('DIV');
        });

        it('should add attributes to the element', () => {
            const element = utils.createElement('div', {
                class: 'test-class',
                id: 'test-id'
            });
            expect(element.className).toBe('test-class');
            expect(element.id).toBe('test-id');
        });

        it('should add children to the element', () => {
            const element = utils.createElement('div', {}, [
                'Test Text',
                utils.createElement('span')
            ]);
            expect(element.childNodes.length).toBe(2);
            expect(element.firstChild.textContent).toBe('Test Text');
            expect(element.lastChild.tagName).toBe('SPAN');
        });
    });

    describe('storage', () => {
        beforeEach(() => {
            localStorage.clear();
            jest.clearAllMocks();
        });

        it('should set and get items from localStorage', () => {
            utils.storage.set('test', 'value');
            expect(utils.storage.get('test')).toBe('value');
        });

        it('should return default value when item does not exist', () => {
            expect(utils.storage.get('nonexistent', 'default')).toBe('default');
        });

        it('should remove items from localStorage', () => {
            utils.storage.set('test', 'value');
            utils.storage.remove('test');
            expect(utils.storage.get('test')).toBeNull();
        });
    });

    describe('url', () => {
        let originalLocation;

        beforeEach(() => {
            originalLocation = window.location;
            delete window.location;
            window.location = {
                ...originalLocation,
                search: '?test=value',
                href: 'http://localhost/?test=value'
            };
        });

        afterEach(() => {
            window.location = originalLocation;
        });

        it('should get query parameters', () => {
            const params = utils.url.getQueryParams();
            expect(params.test).toBe('value');
        });

        it('should update query parameters', () => {
            const spy = jest.spyOn(window.history, 'pushState');
            utils.url.updateQueryParam('test', 'new-value');
            expect(spy).toHaveBeenCalled();
            spy.mockRestore();
        });

        it('should remove query parameters', () => {
            const spy = jest.spyOn(window.history, 'pushState');
            utils.url.removeQueryParam('test');
            expect(spy).toHaveBeenCalled();
            spy.mockRestore();
        });
    });

    describe('form', () => {
        it('should validate required fields', () => {
            document.body.innerHTML = `
                <form>
                    <input type="text" required>
                    <input type="email" required>
                </form>
            `;
            const form = document.querySelector('form');
            const errors = utils.form.validate(form);
            expect(errors.length).toBe(2);
        });

        it('should validate email format', () => {
            expect(utils.form.isValidEmail('test@example.com')).toBe(true);
            expect(utils.form.isValidEmail('invalid-email')).toBe(false);
        });

        it('should serialize form data', () => {
            document.body.innerHTML = `
                <form>
                    <input name="text" value="test">
                    <input name="email" value="test@example.com">
                </form>
            `;
            const form = document.querySelector('form');
            const data = utils.form.serializeForm(form);
            expect(data).toEqual({
                text: 'test',
                email: 'test@example.com'
            });
        });
    });

    describe('date', () => {
        it('should format dates correctly', () => {
            const date = new Date('2024-01-01T12:30:00');
            expect(utils.date.format(date, 'YYYY-MM-DD')).toBe('2024-01-01');
            expect(utils.date.format(date, 'HH:mm')).toBe('12:30');
        });

        it('should calculate time ago', () => {
            const now = new Date();
            const hourAgo = new Date(now - 3600000);
            expect(utils.date.timeAgo(hourAgo)).toContain('hour');
        });
    });
});
