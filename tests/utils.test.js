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
            const testData = { test: 'data' };
            utils.storage.set('test-key', testData);
            expect(localStorage.setItem).toHaveBeenCalledWith('test-key', JSON.stringify(testData));
            
            localStorage.getItem.mockReturnValue(JSON.stringify(testData));
            const result = utils.storage.get('test-key');
            expect(result).toEqual(testData);
        });

        it('should return default value when item does not exist', () => {
            localStorage.getItem.mockReturnValue(null);
            const defaultValue = 'default';
            const result = utils.storage.get('non-existent', defaultValue);
            expect(result).toBe(defaultValue);
        });

        it('should remove items from localStorage', () => {
            utils.storage.remove('test-key');
            expect(localStorage.removeItem).toHaveBeenCalledWith('test-key');
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

    describe('url', () => {
        beforeEach(() => {
            delete window.location;
            window.location = new URL('https://example.com?test=value');
        });

        it('should get query parameters', () => {
            const params = utils.url.getQueryParams();
            expect(params).toEqual({ test: 'value' });
        });

        it('should update query parameters', () => {
            utils.url.updateQueryParam('test', 'new-value');
            expect(window.location.search).toContain('test=new-value');
        });

        it('should remove query parameters', () => {
            utils.url.removeQueryParam('test');
            expect(window.location.search).not.toContain('test=');
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
