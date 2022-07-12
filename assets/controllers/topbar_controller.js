import {Controller} from '@hotwired/stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {

    static values = {
        scroll: {type: Number, default: 100}
    }

    connect() {
        window.addEventListener('scroll', (e) => {
            window.scrollY > this.scrollValue
                ? this.element.classList.add('scrolled')
                : this.element.classList.remove('scrolled');
        });
    }
}