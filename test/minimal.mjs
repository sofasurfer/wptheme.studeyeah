import assert from 'assert';
import {isEmail} from '../src/scripts/modules/minimal.mjs';

describe('Function isEmail()', function () {
    it('should return true if a correct email syntax (string) is passed', function () {
        assert.equal(isEmail('erin@neofluxe.com'), true);
    });
    it('should return false if a wrong email syntax (string) is passed', function () {
        assert.equal(isEmail('erin(at)neofluxe.com'), false);
    });
    it('should return false if a number is passed', function () {
        assert.equal(isEmail(123), false);
    });
});