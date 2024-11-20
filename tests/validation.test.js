import { utils } from '../js/utils';

describe('Validation Utils', () => {
    describe('type checking', () => {
        it('should handle null and undefined values gracefully', () => {
            expect(utils.string.truncate(null)).toBe('');
            expect(utils.string.truncate(undefined)).toBe('');
            expect(utils.string.slugify(null)).toBe('');
            expect(utils.string.slugify(undefined)).toBe('');
            expect(utils.string.escapeHTML(null)).toBe('');
            expect(utils.string.escapeHTML(undefined)).toBe('');
        });

        it('should convert non-string inputs to strings', () => {
            expect(utils.string.truncate(123)).toBe('123');
            expect(utils.string.slugify(123)).toBe('123');
            expect(utils.string.escapeHTML(123)).toBe('123');
        });
    });

    describe('array validation', () => {
        it('should handle non-array inputs gracefully', () => {
            expect(utils.array.chunk(null, 2)).toEqual([]);
            expect(utils.array.chunk(undefined, 2)).toEqual([]);
            expect(utils.array.chunk('string', 2)).toEqual([]);
            expect(utils.array.chunk(123, 2)).toEqual([]);
        });

        it('should handle invalid chunk sizes', () => {
            const arr = [1, 2, 3, 4];
            expect(utils.array.chunk(arr, 0)).toEqual([]);
            expect(utils.array.chunk(arr, -1)).toEqual([]);
            expect(utils.array.chunk(arr, null)).toEqual([]);
        });

        it('should handle empty arrays', () => {
            expect(utils.array.shuffle([])).toEqual([]);
            expect(utils.array.unique([])).toEqual([]);
            expect(utils.array.chunk([], 2)).toEqual([]);
        });
    });

    describe('form validation', () => {
        it('should validate email formats', () => {
            expect(utils.form.isValidEmail('test@example.com')).toBe(true);
            expect(utils.form.isValidEmail('test.name@example.co.uk')).toBe(true);
            expect(utils.form.isValidEmail('test+label@example.com')).toBe(true);
            expect(utils.form.isValidEmail('invalid-email')).toBe(false);
            expect(utils.form.isValidEmail('@example.com')).toBe(false);
            expect(utils.form.isValidEmail('test@')).toBe(false);
            expect(utils.form.isValidEmail('')).toBe(false);
            expect(utils.form.isValidEmail(null)).toBe(false);
        });

        it('should handle invalid form data', () => {
            const invalidForm = document.createElement('form');
            expect(utils.form.serializeForm(invalidForm)).toEqual({});
            expect(utils.form.validate(invalidForm)).toEqual([]);
        });
    });

    describe('date validation', () => {
        it('should handle invalid date inputs', () => {
            expect(utils.date.format('invalid-date')).toBe('');
            expect(utils.date.format(null)).toBe('');
            expect(utils.date.format(undefined)).toBe('');
        });

        it('should validate date formats', () => {
            const date = new Date('2024-01-01T12:00:00');
            expect(utils.date.format(date, 'YYYY-MM-DD')).toBe('2024-01-01');
            expect(utils.date.format(date, 'DD/MM/YYYY')).toBe('01/01/2024');
            expect(utils.date.format(date, 'HH:mm')).toBe('12:00');
        });

        it('should handle time ago edge cases', () => {
            const now = new Date();
            expect(utils.date.timeAgo(now)).toBe('just now');
            expect(utils.date.timeAgo(null)).toBe('');
            expect(utils.date.timeAgo('invalid-date')).toBe('');
        });
    });

    describe('storage validation', () => {
        beforeEach(() => {
            localStorage.clear();
        });

        it('should handle storage errors gracefully', () => {
            const mockStorage = {
                setItem: function(key, value) {
                    throw new Error('Storage full');
                },
                getItem: function(key) { return null; },
                removeItem: function(key) {}
            };
            const originalStorage = global.localStorage;
            Object.defineProperty(global, 'localStorage', {
                value: mockStorage,
                writable: true
            });
            
            expect(utils.storage.set('test', 'value')).toBe(false);
            expect(utils.storage.get('test')).toBe(null);
            
            // Restore original localStorage
            Object.defineProperty(global, 'localStorage', {
                value: originalStorage,
                writable: true
            });
        });

        it('should handle invalid JSON in storage', () => {
            localStorage.setItem('invalid-json', '{invalid-json}');
            expect(utils.storage.get('invalid-json', 'default')).toBe('default');
        });
    });
});
