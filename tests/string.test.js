import { utils } from '../js/utils';

describe('String Utils', () => {
    describe('truncate', () => {
        it('should truncate string to specified length', () => {
            const longString = 'This is a very long string that needs to be truncated';
            expect(utils.string.truncate(longString, 10)).toBe('This is a...');
            expect(utils.string.truncate(longString, 20)).toBe('This is a very long...');
        });

        it('should not truncate if string is shorter than length', () => {
            const shortString = 'Short string';
            expect(utils.string.truncate(shortString, 20)).toBe(shortString);
        });

        it('should use custom ending if provided', () => {
            const string = 'This needs a custom ending';
            expect(utils.string.truncate(string, 10, '---')).toBe('This is a---');
        });
    });

    describe('slugify', () => {
        it('should convert string to slug format', () => {
            expect(utils.string.slugify('Hello World!')).toBe('hello-world');
            expect(utils.string.slugify('This is a TEST')).toBe('this-is-a-test');
            expect(utils.string.slugify('Special@#$Characters')).toBe('special-characters');
        });

        it('should handle multiple spaces and special characters', () => {
            expect(utils.string.slugify('  Multiple   Spaces  ')).toBe('multiple-spaces');
            expect(utils.string.slugify('dots.and-dashes')).toBe('dots-and-dashes');
        });

        it('should handle non-English characters', () => {
            expect(utils.string.slugify('Café & Résumé')).toBe('cafe-resume');
        });
    });

    describe('escapeHTML', () => {
        it('should escape HTML special characters', () => {
            expect(utils.string.escapeHTML('<div>Test</div>')).toBe('&lt;div&gt;Test&lt;/div&gt;');
            expect(utils.string.escapeHTML('"quoted" & \'text\'')).toBe('&quot;quoted&quot; &amp; &#39;text&#39;');
        });

        it('should handle empty strings', () => {
            expect(utils.string.escapeHTML('')).toBe('');
        });

        it('should handle strings with no special characters', () => {
            expect(utils.string.escapeHTML('Normal text')).toBe('Normal text');
        });
    });
});
