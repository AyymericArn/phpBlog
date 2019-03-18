export default class Header {
    constructor() {
        this.$closeButtons = document.querySelectorAll('.close');

        this.$closeButtons.forEach(($button) => {
            $button.addEventListener('click', (_e) => {
                $button.parentNode.remove();
            })
        })
    }
}