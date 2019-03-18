class Dashboard {
    constructor(rootPath) {
        this.$modButtons = document.querySelectorAll('button.js-modify');
        this.$delButtons = document.querySelectorAll('button.js-delete');

        this.$searchBar = document.querySelector('.search-bar');
        this.$titles = document.querySelectorAll('.article .title');

        this.rootPath = rootPath;

        this.bindDeletion();
        this.bindSearch();
    }

    bindDeletion() {
        this.$delButtons.forEach((_button) => {
            const articleId = _button.parentNode.parentNode.dataset.id;
            _button.addEventListener('click', (_e) => {
                fetch(`${this.rootPath}model/async/api.php`,
                {
                    method: 'delete',
                    body: `id=${articleId}`
                })
                .then(_res => _res.json())
                .then(_result => {
                    console.log(_result);
                });

                _e.target.parentNode.parentNode.remove();
            })
        })
    }

    bindSearch() {
        this.$searchBar.addEventListener('input', (_e) => {

            // this.$titles.forEach(title => {
            //     title.parentNode.style.display = 'flex';
            // })

            const query = _e.target.value;

            if (query !== '') {

                fetch(`${this.rootPath}model/async/api?query=${query}`)
                .then(_res => _res.json())
                .then(_result => {
                    console.log(_result);
                    this.$titles.forEach(title => {
                        if (!_result[0].some(result => result.title === title.textContent)) {
                            title.parentNode.style.display = 'none';
                        } else {
                            title.parentNode.style.display = 'flex';
                        }
                    });
                });
            } else {
                this.$titles.forEach(title => {
                    title.parentNode.style.display = 'flex';
                });
            }
        });
    }
}

const rootLoc = window.location.pathname;
const rootPath = 'http://localhost' +  rootLoc.substring(0, rootLoc.lastIndexOf('/blog')) + '/blog/';

const dashboardHandler = new Dashboard(rootPath);