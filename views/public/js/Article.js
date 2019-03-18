export default class Article {
    constructor() {
        this.$likeButtons = document.querySelectorAll('js-like');
        this.location = window.location;
    }

    // setLikeSystem() {
    //     this.$likeButtons.forEach(($_button) => {
    //         $_button.addEventListener('click', () => {
    //             fetch(``)
    //         })
    //     })
    // }
}