import Comparator from '../Comparator';

export default class NotBetween extends Comparator
{
    constructor(type) {
        super(type);
    }

    static supportedTypes() {
        return ['number', 'currency', 'numeric_b10', 'numeric_b26', 'numeric_b36', 'date', 'time', 'datetime'];
    }

    static identifier(type) {
        type = type.filter((t => ~this.supportedTypes().indexOf(t)).bind(this));
        switch (type[0]) {
        default:
            return 'IS NOT BETWEEN';
        }
    }
    
    getField() {
        let type = this.type.filter((t => ~this.constructor.supportedTypes().indexOf(t)).bind(this));
        switch (type[0]) {
        case 'currency':
        case 'number':
        case 'numeric_b10':
            return 'NumberX2';
        case 'numeric_b26':
            return 'NumberBase26X2';
        case 'numeric_b36':
            return 'NumberBase36X2';
        case 'time':
            return 'TimeX2';
        default:
            return 'TextX2';
        }
    }

    toJSON() {
        let obj = super.toJSON();
        obj.key = 'NotBetween';
        return obj;
    }
}