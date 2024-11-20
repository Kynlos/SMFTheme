import { utils } from '../js/utils';

describe('Array Utils', () => {
    describe('chunk', () => {
        it('should split array into chunks of specified size', () => {
            const array = [1, 2, 3, 4, 5, 6, 7, 8];
            expect(utils.array.chunk(array, 3)).toEqual([[1, 2, 3], [4, 5, 6], [7, 8]]);
            expect(utils.array.chunk(array, 2)).toEqual([[1, 2], [3, 4], [5, 6], [7, 8]]);
        });

        it('should handle arrays smaller than chunk size', () => {
            const array = [1, 2, 3];
            expect(utils.array.chunk(array, 5)).toEqual([[1, 2, 3]]);
        });

        it('should handle empty arrays', () => {
            expect(utils.array.chunk([], 3)).toEqual([]);
        });

        it('should handle invalid chunk sizes', () => {
            const array = [1, 2, 3, 4];
            expect(utils.array.chunk(array, 0)).toEqual([]);
            expect(utils.array.chunk(array, -1)).toEqual([]);
        });

        it('should handle non-array inputs', () => {
            expect(utils.array.chunk(null, 3)).toEqual([]);
            expect(utils.array.chunk(undefined, 3)).toEqual([]);
            expect(utils.array.chunk('string', 3)).toEqual([]);
            expect(utils.array.chunk({}, 3)).toEqual([]);
        });

        it('should handle non-numeric chunk sizes', () => {
            const array = [1, 2, 3, 4];
            expect(utils.array.chunk(array, '2')).toEqual([[1, 2], [3, 4]]);
            expect(utils.array.chunk(array, 'invalid')).toEqual([]);
            expect(utils.array.chunk(array, null)).toEqual([]);
            expect(utils.array.chunk(array, undefined)).toEqual([]);
        });
    });

    describe('shuffle', () => {
        it('should maintain the same array length', () => {
            const array = [1, 2, 3, 4, 5];
            const shuffled = utils.array.shuffle([...array]);
            expect(shuffled.length).toBe(array.length);
        });

        it('should contain all original elements', () => {
            const array = [1, 2, 3, 4, 5];
            const shuffled = utils.array.shuffle([...array]);
            expect(shuffled.sort()).toEqual(array.sort());
        });

        it('should handle empty arrays', () => {
            expect(utils.array.shuffle([])).toEqual([]);
        });

        it('should handle single-element arrays', () => {
            expect(utils.array.shuffle([1])).toEqual([1]);
        });

        it('should handle non-array inputs', () => {
            expect(utils.array.shuffle(null)).toEqual([]);
            expect(utils.array.shuffle(undefined)).toEqual([]);
            expect(utils.array.shuffle('string')).toEqual([]);
            expect(utils.array.shuffle(123)).toEqual([]);
        });
    });

    describe('unique', () => {
        it('should remove duplicate elements', () => {
            expect(utils.array.unique([1, 2, 2, 3, 3, 4])).toEqual([1, 2, 3, 4]);
            expect(utils.array.unique(['a', 'b', 'b', 'c'])).toEqual(['a', 'b', 'c']);
        });

        it('should handle arrays with no duplicates', () => {
            expect(utils.array.unique([1, 2, 3])).toEqual([1, 2, 3]);
        });

        it('should handle empty arrays', () => {
            expect(utils.array.unique([])).toEqual([]);
        });

        it('should handle arrays with mixed types', () => {
            expect(utils.array.unique([1, '1', true, 1, true])).toEqual([1, '1', true]);
        });

        it('should handle arrays with object references', () => {
            const obj = { id: 1 };
            const arr = [obj, obj, { id: 2 }, { id: 2 }];
            const result = utils.array.unique(arr);
            expect(result.length).toBe(3);
            expect(result[0]).toBe(obj);
        });

        it('should handle non-array inputs', () => {
            expect(utils.array.unique(null)).toEqual([]);
            expect(utils.array.unique(undefined)).toEqual([]);
            expect(utils.array.unique('string')).toEqual([]);
            expect(utils.array.unique(123)).toEqual([]);
        });

        it('should handle arrays with null and undefined values', () => {
            expect(utils.array.unique([null, null, undefined, undefined, 1])).toEqual([null, undefined, 1]);
        });
    });
});
