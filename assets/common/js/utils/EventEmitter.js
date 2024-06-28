import EventEmitter from 'eventemitter3';

const EE = new EventEmitter();

window.EE = EE;

export default EE;
